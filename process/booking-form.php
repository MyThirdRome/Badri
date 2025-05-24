<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        set_alert('Une erreur de sécurité est survenue. Veuillez réessayer.', 'danger');
        redirect('../booking.php');
        exit;
    }
    
    // Récupérer et nettoyer les données du formulaire
    $service_id = isset($_POST['service']) ? (int)$_POST['service'] : 0;
    $service_name = '';
    foreach ($services as $service) {
        if ($service['id'] == $service_id) {
            $service_name = $service['name'];
            break;
        }
    }
    
    $zone = isset($_POST['delivery_zone']) ? clean_string($_POST['delivery_zone']) : '';
    $address = isset($_POST['address']) ? clean_string($_POST['address']) : '';
    $city = isset($_POST['city']) ? clean_string($_POST['city']) : '';
    $zipcode = isset($_POST['zipcode']) ? clean_string($_POST['zipcode']) : '';
    
    $pickup_address = isset($_POST['pickup_address']) ? clean_string($_POST['pickup_address']) : '';
    $pickup_city = isset($_POST['pickup_city']) ? clean_string($_POST['pickup_city']) : '';
    $pickup_zipcode = isset($_POST['pickup_zipcode']) ? clean_string($_POST['pickup_zipcode']) : '';
    
    $delivery_date = isset($_POST['delivery_date']) ? clean_string($_POST['delivery_date']) : '';
    $delivery_time = isset($_POST['delivery_time']) ? clean_string($_POST['delivery_time']) : '';
    
    $name = isset($_POST['name']) ? clean_string($_POST['name']) : '';
    $email = isset($_POST['email']) ? clean_string($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? clean_string($_POST['phone']) : '';
    $company = isset($_POST['company']) ? clean_string($_POST['company']) : '';
    
    $notes = isset($_POST['notes']) ? clean_string($_POST['notes']) : '';
    $payment_method = isset($_POST['payment_method']) ? clean_string($_POST['payment_method']) : '';
    
    // Options supplémentaires
    $options = [];
    $total_options_price = 0;
    
    if (isset($_POST['express_delivery']) && $_POST['express_delivery'] == '1') {
        $options[] = [
            'name' => 'Livraison express',
            'price' => 5.00
        ];
        $total_options_price += 5.00;
    }
    
    if (isset($_POST['insurance']) && $_POST['insurance'] == '1') {
        $options[] = [
            'name' => 'Assurance',
            'price' => 3.50
        ];
        $total_options_price += 3.50;
    }
    
    if (isset($_POST['signature_required']) && $_POST['signature_required'] == '1') {
        $options[] = [
            'name' => 'Signature à la livraison',
            'price' => 2.00
        ];
        $total_options_price += 2.00;
    }
    
    // Valider les données
    $errors = [];
    
    if ($service_id <= 0) {
        $errors[] = 'Le service est obligatoire';
    }
    
    if (is_empty($zone)) {
        $errors[] = 'La zone de livraison est obligatoire';
    }
    
    if (is_empty($address)) {
        $errors[] = 'L\'adresse de livraison est obligatoire';
    }
    
    if (is_empty($city)) {
        $errors[] = 'La ville de livraison est obligatoire';
    }
    
    if (is_empty($zipcode)) {
        $errors[] = 'Le code postal de livraison est obligatoire';
    }
    
    // Si c'est un service de livraison (service_id 3 ou 4), vérifier l'adresse de ramassage
    if (in_array($service_id, [3, 4])) {
        if (is_empty($pickup_address)) {
            $errors[] = 'L\'adresse de ramassage est obligatoire';
        }
        
        if (is_empty($pickup_city)) {
            $errors[] = 'La ville de ramassage est obligatoire';
        }
        
        if (is_empty($pickup_zipcode)) {
            $errors[] = 'Le code postal de ramassage est obligatoire';
        }
    }
    
    if (is_empty($delivery_date)) {
        $errors[] = 'La date de livraison est obligatoire';
    } else {
        // Vérifier que la date est dans le futur
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        $delivery_date_obj = new DateTime($delivery_date);
        
        if ($delivery_date_obj < $today) {
            $errors[] = 'La date de livraison doit être dans le futur';
        }
    }
    
    if (is_empty($delivery_time)) {
        $errors[] = 'L\'heure de livraison est obligatoire';
    }
    
    if (is_empty($name)) {
        $errors[] = 'Le nom est obligatoire';
    }
    
    if (is_empty($email)) {
        $errors[] = 'L\'adresse email est obligatoire';
    } elseif (!is_valid_email($email)) {
        $errors[] = 'L\'adresse email n\'est pas valide';
    }
    
    if (is_empty($phone)) {
        $errors[] = 'Le numéro de téléphone est obligatoire';
    } elseif (!is_valid_phone($phone)) {
        $errors[] = 'Le numéro de téléphone n\'est pas valide';
    }
    
    if (is_empty($payment_method)) {
        $errors[] = 'Le mode de paiement est obligatoire';
    }
    
    // S'il y a des erreurs, rediriger vers le formulaire avec les erreurs
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        set_alert('Veuillez corriger les erreurs dans le formulaire.', 'danger');
        redirect('../booking.php');
        exit;
    }
    
    // Calculer le prix total
    $base_price = calculate_delivery_price($zone, $service_id);
    $total_price = $base_price + $total_options_price;
    
    // Générer un identifiant unique pour la commande
    $order_id = generate_order_id();
    
    // Construire le message email
    $email_subject = "Nouvelle réservation: " . $order_id;
    
    $email_body = "
    <html>
    <head>
        <title>Nouvelle réservation</title>
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Nouvelle réservation</h2>
        <p><strong>Numéro de commande:</strong> {$order_id}</p>
        
        <h3>Détails du service</h3>
        <table>
            <tr>
                <th>Service</th>
                <td>{$service_name}</td>
            </tr>
            <tr>
                <th>Zone de livraison</th>
                <td>{$zone}</td>
            </tr>
            <tr>
                <th>Date de livraison</th>
                <td>{$delivery_date}</td>
            </tr>
            <tr>
                <th>Heure de livraison</th>
                <td>{$delivery_time}</td>
            </tr>
        </table>
        
        <h3>Adresse de livraison</h3>
        <p>{$address}<br>{$zipcode} {$city}</p>
        
        ";
    
    // Ajouter l'adresse de ramassage si nécessaire
    if (in_array($service_id, [3, 4])) {
        $email_body .= "
        <h3>Adresse de ramassage</h3>
        <p>{$pickup_address}<br>{$pickup_zipcode} {$pickup_city}</p>
        ";
    }
    
    $email_body .= "
        <h3>Informations client</h3>
        <table>
            <tr>
                <th>Nom</th>
                <td>{$name}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{$email}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{$phone}</td>
            </tr>";
    
    if (!is_empty($company)) {
        $email_body .= "
            <tr>
                <th>Entreprise</th>
                <td>{$company}</td>
            </tr>";
    }
    
    $email_body .= "
        </table>
        
        <h3>Options supplémentaires</h3>";
    
    if (!empty($options)) {
        $email_body .= "<ul>";
        foreach ($options as $option) {
            $email_body .= "<li>{$option['name']} - " . format_price($option['price']) . "</li>";
        }
        $email_body .= "</ul>";
    } else {
        $email_body .= "<p>Aucune option sélectionnée</p>";
    }
    
    $email_body .= "
        <h3>Récapitulatif des prix</h3>
        <table>
            <tr>
                <th>Prix de base</th>
                <td>" . format_price($base_price) . "</td>
            </tr>
            <tr>
                <th>Options</th>
                <td>" . format_price($total_options_price) . "</td>
            </tr>
            <tr>
                <th>Total</th>
                <td><strong>" . format_price($total_price) . "</strong></td>
            </tr>
        </table>
        
        <h3>Mode de paiement</h3>
        <p>{$payment_method}</p>";
    
    if (!is_empty($notes)) {
        $email_body .= "
        <h3>Notes</h3>
        <p>" . nl2br($notes) . "</p>";
    }
    
    $email_body .= "
    </body>
    </html>
    ";
    
    // Envoyer l'email
    $sent = send_email(EMAIL_ADMIN, $email_subject, $email_body, $email);
    
    if ($sent) {
        // Message de succès
        set_alert('Votre réservation a été enregistrée avec succès. Vous recevrez un email de confirmation.', 'success');
        
        // Envoyer un email de confirmation au client
        $confirmation_subject = "Confirmation de votre réservation - " . COMPANY_NAME;
        
        $confirmation_body = "
        <html>
        <head>
            <title>Confirmation de votre réservation</title>
            <style>
                table { border-collapse: collapse; width: 100%; }
                th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h2>Confirmation de votre réservation</h2>
            <p>Bonjour {$name},</p>
            <p>Nous avons bien reçu votre réservation et nous vous en remercions.</p>
            <p>Votre numéro de commande est: <strong>{$order_id}</strong></p>
            
            <h3>Détails du service</h3>
            <table>
                <tr>
                    <th>Service</th>
                    <td>{$service_name}</td>
                </tr>
                <tr>
                    <th>Zone de livraison</th>
                    <td>{$zone}</td>
                </tr>
                <tr>
                    <th>Date de livraison</th>
                    <td>{$delivery_date}</td>
                </tr>
                <tr>
                    <th>Heure de livraison</th>
                    <td>{$delivery_time}</td>
                </tr>
            </table>
            
            <h3>Récapitulatif des prix</h3>
            <table>
                <tr>
                    <th>Prix de base</th>
                    <td>" . format_price($base_price) . "</td>
                </tr>
                <tr>
                    <th>Options</th>
                    <td>" . format_price($total_options_price) . "</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><strong>" . format_price($total_price) . "</strong></td>
                </tr>
            </table>
            
            <p>Si vous avez des questions concernant votre réservation, n'hésitez pas à nous contacter.</p>
            <p>Cordialement,</p>
            <p>L'équipe " . COMPANY_NAME . "</p>
        </body>
        </html>
        ";
        
        send_email($email, $confirmation_subject, $confirmation_body);
    } else {
        // Message d'erreur
        set_alert('Une erreur est survenue lors de l\'enregistrement de votre réservation. Veuillez réessayer plus tard.', 'danger');
    }
    
    // Rediriger vers la page de réservation
    redirect('../booking.php');
    exit;
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de réservation
    redirect('../booking.php');
    exit;
}
?>
