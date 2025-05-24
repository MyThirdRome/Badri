<?php
$page_title = "Confirmation de paiement";
include 'includes/header.php';

// Vérifier si l'ID de commande est présent
$order_id = isset($_GET['order_id']) ? clean_string($_GET['order_id']) : '';
$payment_successful = false;

// Vérifier si la commande existe dans la session
if (!empty($order_id) && isset($_SESSION['order']) && $_SESSION['order']['order_id'] === $order_id) {
    $order = $_SESSION['order'];
    $payment_successful = true;
    
    // Traitement supplémentaire si nécessaire, comme l'envoi d'un email de confirmation
    // Note: Dans un système de production, vous devriez vérifier l'état du paiement via l'API Mollie
    
    // Envoyer un email de confirmation
    if (isset($order['email']) && !empty($order['email'])) {
        $subject = "Confirmation de votre commande - " . COMPANY_NAME;
        
        $message = "
        <html>
        <head>
            <title>Confirmation de commande</title>
        </head>
        <body>
            <h2>Confirmation de votre commande</h2>
            <p>Bonjour " . htmlspecialchars($order['name']) . ",</p>
            <p>Nous avons bien reçu votre paiement et nous vous en remercions.</p>
            <p>Votre numéro de commande est: <strong>" . htmlspecialchars($order['order_id']) . "</strong></p>
            
            <h3>Détails de la commande</h3>
            <p><strong>Service:</strong> " . htmlspecialchars($order['service_name']) . "</p>
            <p><strong>Zone de livraison:</strong> " . htmlspecialchars($order['zone']) . "</p>
            <p><strong>Montant payé:</strong> " . format_price($order['total_price']) . "</p>
            
            <p>Un récapitulatif complet vous sera envoyé prochainement.</p>
            
            <p>Cordialement,</p>
            <p>L'équipe " . COMPANY_NAME . "</p>
        </body>
        </html>
        ";
        
        send_email($order['email'], $subject, $message);
    }
    
    // Effacer les données de commande et de paiement de la session
    unset($_SESSION['order']);
    unset($_SESSION['mollie_payment_id']);
}
?>

<section class="section">
    <div class="container">
        <?php if ($payment_successful): ?>
            <div class="payment-success">
                <div class="payment-success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="section-title">Paiement réussi</h2>
                <p class="section-subtitle">Votre paiement a été traité avec succès. Merci pour votre commande!</p>
                
                <div class="order-details">
                    <h3>Détails de la commande</h3>
                    <p><strong>Numéro de commande:</strong> <?php echo htmlspecialchars($order_id); ?></p>
                    <p><strong>Service:</strong> <?php echo htmlspecialchars($order['service_name']); ?></p>
                    <p><strong>Montant payé:</strong> <?php echo format_price($order['total_price']); ?></p>
                </div>
                
                <p>Un email de confirmation a été envoyé à l'adresse <?php echo htmlspecialchars($order['email']); ?>.</p>
                
                <div class="cta-buttons" style="margin-top: 30px;">
                    <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
                </div>
            </div>
        <?php else: ?>
            <div class="payment-error">
                <div class="payment-error-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2 class="section-title">Commande non trouvée</h2>
                <p class="section-subtitle">Nous n'avons pas pu trouver les détails de votre commande. Veuillez contacter notre service client pour obtenir de l'aide.</p>
                
                <div class="cta-buttons" style="margin-top: 30px;">
                    <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
                    <a href="contact.php" class="btn btn-outline">Contactez-nous</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.payment-success, .payment-error {
    text-align: center;
    padding: 50px 20px;
    max-width: 800px;
    margin: 0 auto;
}

.payment-success-icon, .payment-error-icon {
    font-size: 80px;
    margin-bottom: 30px;
}

.payment-success-icon {
    color: #2ecc71;
}

.payment-error-icon {
    color: #e74c3c;
}

.order-details {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin: 30px auto;
    max-width: 500px;
    text-align: left;
}
</style>

<?php include 'includes/footer.php'; ?>