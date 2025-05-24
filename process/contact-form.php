<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        set_alert('Une erreur de sécurité est survenue. Veuillez réessayer.', 'danger');
        redirect('../contact.php');
        exit;
    }
    
    // Récupérer et nettoyer les données du formulaire
    $name = isset($_POST['name']) ? clean_string($_POST['name']) : '';
    $email = isset($_POST['email']) ? clean_string($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? clean_string($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? clean_string($_POST['subject']) : '';
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
    
    if (!is_empty($phone) && !is_valid_phone($phone)) {
        $errors[] = 'Le numéro de téléphone n\'est pas valide';
    }
    
    if (is_empty($subject)) {
        $errors[] = 'Le sujet est obligatoire';
    }
    
    if (is_empty($message)) {
        $errors[] = 'Le message est obligatoire';
    }
    
    // S'il y a des erreurs, rediriger vers le formulaire avec les erreurs
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        set_alert('Veuillez corriger les erreurs dans le formulaire.', 'danger');
        redirect('../contact.php');
        exit;
    }
    
    // Construire le message email
    $email_subject = "Nouveau message de contact: " . $subject;
    
    $email_body = "
    <html>
    <head>
        <title>Nouveau message de contact</title>
    </head>
    <body>
        <h2>Nouveau message de contact</h2>
        <p><strong>Nom:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Téléphone:</strong> {$phone}</p>
        <p><strong>Sujet:</strong> {$subject}</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br($message) . "</p>
    </body>
    </html>
    ";
    
    // Envoyer l'email
    $sent = send_email(EMAIL_ADMIN, $email_subject, $email_body, $email);
    
    if ($sent) {
        // Message de succès
        set_alert('Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.', 'success');
        
        // Envoyer un email de confirmation au client
        $confirmation_subject = "Confirmation de votre message - " . COMPANY_NAME;
        
        $confirmation_body = "
        <html>
        <head>
            <title>Confirmation de votre message</title>
        </head>
        <body>
            <h2>Confirmation de votre message</h2>
            <p>Bonjour {$name},</p>
            <p>Nous avons bien reçu votre message et nous vous en remercions.</p>
            <p>Nous vous répondrons dans les plus brefs délais.</p>
            <p>Voici un récapitulatif de votre message :</p>
            <p><strong>Sujet:</strong> {$subject}</p>
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
        set_alert('Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.', 'danger');
    }
    
    // Rediriger vers la page de contact
    redirect('../contact.php');
    exit;
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de contact
    redirect('../contact.php');
    exit;
}
?>
