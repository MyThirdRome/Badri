<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        set_alert('Une erreur de sécurité est survenue. Veuillez réessayer.', 'danger');
        redirect('../request-quote.php');
        exit;
    }
    
    // Récupérer et nettoyer les données du formulaire
    $name = isset($_POST['name']) ? clean_string($_POST['name']) : '';
    $email = isset($_POST['email']) ? clean_string($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? clean_string($_POST['phone']) : '';
    $company = isset($_POST['company']) ? clean_string($_POST['company']) : '';
    $service = isset($_POST['service']) ? clean_string($_POST['service']) : '';
    $service_id = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
    $zone = isset($_POST['zone']) ? clean_string($_POST['zone']) : '';
    $message = isset($_POST['message']) ? clean_string($_POST['message']) : '';
    
    // Valider les données
    $errors = [];
    
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
    
    if (is_empty($service)) {
        $errors[] = 'Le service est obligatoire';
    }
    
    if (is_empty($zone)) {
        $errors[] = 'La zone de livraison est obligatoire';
    }
    
    // S'il y a des erreurs, rediriger vers le formulaire avec les erreurs
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        set_alert('Veuillez corriger les erreurs dans le formulaire.', 'danger');
        redirect('../request-quote.php');
        exit;
    }
    
    // Générer un identifiant unique pour le devis
    $quote_id = 'Q-' . date('Ymd') . '-' . substr(uniqid(), -6);
    
    // Calculer un prix estimatif
    $estimated_price = 0;
    if ($service_id > 0 && !empty($zone)) {
        $estimated_price = calculate_delivery_price($zone, $service_id);
    }
    
    // Construire le message email
    $email_subject = "Nouvelle demande de devis: " . $quote_id;
    
    $email_body = "
    <html>
    <head>
        <title>Nouvelle demande de devis</title>
    </head>
    <body>
        <h2>Nouvelle demande de devis</h2>
        <p><strong>Numéro de devis:</strong> {$quote_id}</p>
        <p><strong>Nom:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Téléphone:</strong> {$phone}</p>
        <p><strong>Entreprise:</strong> {$company}</p>
        <p><strong>Service demandé:</strong> {$service}</p>
        <p><strong>Zone de livraison:</strong> {$zone}</p>
        <p><strong>Prix estimatif:</strong> " . format_price($estimated_price) . "</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br($message) . "</p>
    </body>
    </html>
    ";
    
    // Envoyer l'email
    $sent = send_email(EMAIL_ADMIN, $email_subject, $email_body, $email);
    
    if ($sent) {
        // Message de succès
        set_alert('Votre demande de devis a été envoyée avec succès. Nous vous contacterons dans les plus brefs délais.', 'success');
        
        // Envoyer un email de confirmation au client
        $confirmation_subject = "Confirmation de votre demande de devis - " . COMPANY_NAME;
        
        $confirmation_body = "
        <html>
        <head>
            <title>Confirmation de votre demande de devis</title>
        </head>
        <body>
            <h2>Confirmation de votre demande de devis</h2>
            <p>Bonjour {$name},</p>
            <p>Nous avons bien reçu votre demande de devis et nous vous en remercions.</p>
            <p>Votre numéro de devis est: <strong>{$quote_id}</strong></p>
            <p>Nous vous contacterons dans les plus brefs délais pour vous fournir un devis personnalisé.</p>
            <p>Voici un récapitulatif de votre demande :</p>
            <p><strong>Service demandé:</strong> {$service}</p>
            <p><strong>Zone de livraison:</strong> {$zone}</p>
            <p><strong>Prix estimatif:</strong> " . format_price($estimated_price) . "</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br($message) . "</p>
            <p>Cordialement,</p>
            <p>L'équipe " . COMPANY_NAME . "</p>
        </body>
        </html>
        ";
        
        send_email($email, $confirmation_subject, $confirmation_body);
    } else {
        // Message d'erreur
        set_alert('Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer plus tard.', 'danger');
    }
    
    // Rediriger vers la page de demande de devis
    redirect('../request-quote.php');
    exit;
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de demande de devis
    redirect('../request-quote.php');
    exit;
}
?>
