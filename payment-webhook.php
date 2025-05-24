<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/mollie-config.php';

try {
    // Initialiser l'API Mollie
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey(MOLLIE_API_KEY);
    
    // Récupérer l'ID de paiement depuis Mollie
    $payment_id = isset($_POST["id"]) ? $_POST["id"] : null;
    
    if (empty($payment_id)) {
        http_response_code(400);
        exit("Aucun ID de paiement fourni");
    }
    
    // Récupérer les informations du paiement
    $payment = $mollie->payments->get($payment_id);
    $order_id = $payment->metadata->order_id;
    
    // Vérifier si le paiement est réussi
    if ($payment->isPaid()) {
        // Le paiement a été effectué avec succès
        // Ici, vous pouvez mettre à jour votre base de données pour marquer la commande comme payée
        
        // Enregistrer les informations dans un fichier de log pour le debug
        $log_file = __DIR__ . '/mollie_payments.log';
        $log_message = date('Y-m-d H:i:s') . " - Paiement réussi pour la commande " . $order_id . " - ID de paiement: " . $payment_id . "\n";
        file_put_contents($log_file, $log_message, FILE_APPEND);
        
        http_response_code(200);
        exit("Paiement traité avec succès");
    } else {
        // Le paiement n'est pas réussi ou a été annulé
        $log_file = __DIR__ . '/mollie_payments.log';
        $log_message = date('Y-m-d H:i:s') . " - Paiement non réussi pour la commande " . $order_id . " - ID de paiement: " . $payment_id . " - Statut: " . $payment->status . "\n";
        file_put_contents($log_file, $log_message, FILE_APPEND);
        
        http_response_code(200);
        exit("Paiement non réussi");
    }
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    // En cas d'erreur, enregistrer l'erreur dans un fichier de log
    $log_file = __DIR__ . '/mollie_errors.log';
    $log_message = date('Y-m-d H:i:s') . " - Erreur API Mollie: " . $e->getMessage() . "\n";
    file_put_contents($log_file, $log_message, FILE_APPEND);
    
    http_response_code(500);
    exit("Une erreur est survenue: " . $e->getMessage());
}
?>