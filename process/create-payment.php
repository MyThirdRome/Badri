<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/mollie-config.php';

// Forcer l'utilisation des données de test pour le débogage
if (true) {
    // Si les données de réservation ne sont pas en session, utiliser des valeurs par défaut
    if (!isset($_SESSION['reservation_form_data'])) {
        $_SESSION['reservation_form_data'] = [
            'service' => 1,
            'delivery_zone' => 'Zone 1',
            'name' => 'Client Test',
            'email' => 'test@example.com',
            'express_delivery' => '1',
            'insurance' => '1'
        ];
    }
    // Récupérer les données du formulaire depuis la session
    $form_data = $_SESSION['reservation_form_data'];
    
    // Log des données reçues pour le débogage
    $debug_data = "Données du formulaire (session): " . print_r($form_data, true);
    error_log($debug_data);
    file_put_contents('../payment_debug.log', $debug_data, FILE_APPEND);
    
    // Récupérer les données de la commande
    $service_id = isset($form_data['service']) ? (int)$form_data['service'] : 0;
    $service_name = '';
    foreach ($services as $service) {
        if ($service['id'] == $service_id) {
            $service_name = $service['name'];
            break;
        }
    }
    
    $zone = isset($form_data['delivery_zone']) ? clean_string($form_data['delivery_zone']) : '';
    $name = isset($form_data['name']) ? clean_string($form_data['name']) : '';
    $email = isset($form_data['email']) ? clean_string($form_data['email']) : '';
    
    // Calculer le prix total
    $base_price = calculate_delivery_price($zone, $service_id);
    $total_options_price = 0;
    
    // Vérification des prix pour le debug
    error_log("Service ID: " . $service_id . ", Zone: " . $zone . ", Base price: " . $base_price);
    
    if (isset($_POST['express_delivery']) && $_POST['express_delivery'] == '1') {
        $total_options_price += 5.00;
    }
    
    if (isset($_POST['insurance']) && $_POST['insurance'] == '1') {
        $total_options_price += 3.50;
    }
    
    if (isset($_POST['signature_required']) && $_POST['signature_required'] == '1') {
        $total_options_price += 2.00;
    }
    
    // Si le prix de base est 0 (calcul échoué), utiliser un prix par défaut basé sur le service
    if ($base_price <= 0) {
        $default_prices = [
            1 => 5.90,
            2 => 19.90,
            3 => 8.90, 
            4 => 24.90,
            5 => 14.90
        ];
        
        $base_price = isset($default_prices[$service_id]) ? $default_prices[$service_id] : 10.00;
        error_log("Utilisation du prix par défaut: " . $base_price);
    }
    
    $total_price = $base_price + $total_options_price;
    
    // Générer un identifiant unique pour la commande
    $order_id = generate_order_id();
    
    // Sauvegarder les détails de la commande en session pour une utilisation ultérieure
    $_SESSION['order'] = [
        'order_id' => $order_id,
        'service_id' => $service_id,
        'service_name' => $service_name,
        'zone' => $zone,
        'name' => $name,
        'email' => $email,
        'total_price' => $total_price,
        'form_data' => $_POST // Stocker toutes les données du formulaire
    ];
    
    try {
        // Initialiser l'API Mollie
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(MOLLIE_API_KEY);
        
        // Déboguer les informations avant de créer le paiement
        $amount_value = number_format($total_price, 2, '.', '');
        error_log("Montant à payer: " . $amount_value . " EUR");
        error_log("Description: Commande " . $order_id . " - " . $service_name);
        error_log("URL de redirection: " . MOLLIE_REDIRECT_URL . "?order_id=" . $order_id);
        
        // Créer le paiement Mollie
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $amount_value // Format 10.00
            ],
            "description" => "Commande " . $order_id . " - " . $service_name,
            "redirectUrl" => MOLLIE_REDIRECT_URL . "?order_id=" . $order_id,
            "webhookUrl" => MOLLIE_WEBHOOK_URL,
            "metadata" => [
                "order_id" => $order_id
            ]
        ]);
        
        // Stocker l'ID de paiement Mollie en session
        $_SESSION['mollie_payment_id'] = $payment->id;
        
        // Stocker les informations de commande en session pour la page de confirmation
        $_SESSION['order'] = [
            'order_id' => $order_id,
            'service_id' => $service_id,
            'service_name' => $service_name,
            'zone' => $zone,
            'name' => $name,
            'email' => $email,
            'total_price' => $total_price,
            'form_data' => $form_data
        ];
        
        // Rediriger vers la page de paiement Mollie
        header("Location: " . $payment->getCheckoutUrl(), true, 303);
        exit;
        
    } catch (\Mollie\Api\Exceptions\ApiException $e) {
        // En cas d'erreur, afficher un message et rediriger vers la page de réservation
        set_alert('Une erreur est survenue lors de l\'initialisation du paiement: ' . $e->getMessage(), 'danger');
        redirect('../booking.php');
        exit;
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de réservation
    redirect('../booking.php');
    exit;
}
?>