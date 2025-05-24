<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/mollie-config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        set_alert('Une erreur de sécurité est survenue. Veuillez réessayer.', 'danger');
        redirect('../booking.php');
        exit;
    }
    
    // Récupérer les données de la commande
    $service_id = isset($_POST['service']) ? (int)$_POST['service'] : 0;
    $service_name = '';
    foreach ($services as $service) {
        if ($service['id'] == $service_id) {
            $service_name = $service['name'];
            break;
        }
    }
    
    $zone = isset($_POST['delivery_zone']) ? clean_string($_POST['delivery_zone']) : '';
    $name = isset($_POST['name']) ? clean_string($_POST['name']) : '';
    $email = isset($_POST['email']) ? clean_string($_POST['email']) : '';
    
    // Calculer le prix total
    $base_price = calculate_delivery_price($zone, $service_id);
    $total_options_price = 0;
    
    if (isset($_POST['express_delivery']) && $_POST['express_delivery'] == '1') {
        $total_options_price += 5.00;
    }
    
    if (isset($_POST['insurance']) && $_POST['insurance'] == '1') {
        $total_options_price += 3.50;
    }
    
    if (isset($_POST['signature_required']) && $_POST['signature_required'] == '1') {
        $total_options_price += 2.00;
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
        
        // Créer le paiement Mollie
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($total_price, 2, '.', '') // Format 10.00
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