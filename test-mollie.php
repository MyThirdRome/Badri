<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/mollie-config.php';

try {
    // Initialiser l'API Mollie
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey(MOLLIE_API_KEY);
    
    // Générer un ID de commande unique
    $order_id = 'TEST-' . time();
    
    // Créer un paiement test
    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "10.00" // Format requis par Mollie
        ],
        "description" => "Test de paiement - " . $order_id,
        "redirectUrl" => "http://" . $_SERVER['HTTP_HOST'] . "/payment-success.php?order_id=" . $order_id,
        "webhookUrl" => "http://" . $_SERVER['HTTP_HOST'] . "/payment-webhook.php",
        "metadata" => [
            "order_id" => $order_id
        ]
    ]);
    
    // Rediriger vers la page de paiement Mollie
    header("Location: " . $payment->getCheckoutUrl(), true, 303);
    exit;
    
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    // Afficher les détails de l'erreur
    echo "<h1>Erreur lors du test de paiement</h1>";
    echo "<p>Message: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Code: " . htmlspecialchars($e->getCode()) . "</p>";
    echo "<pre>" . htmlspecialchars(print_r($e->getTrace(), true)) . "</pre>";
}
?>