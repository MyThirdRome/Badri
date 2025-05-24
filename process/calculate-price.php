<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Log des données reçues pour le débogage
$input_data = file_get_contents('php://input');
$log_message = date('Y-m-d H:i:s') . " - Request: " . print_r($_POST, true) . " Raw input: " . $input_data . "\n";
file_put_contents('../price_calculation.log', $log_message, FILE_APPEND);

// Vérifier si la requête est une requête AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données
    $service_id = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
    $zone = isset($_POST['zone']) ? clean_string($_POST['zone']) : '';
    
    // Log des données extraites
    $debug_message = "Service ID: $service_id, Zone: $zone\n";
    file_put_contents('../price_calculation.log', $debug_message, FILE_APPEND);
    
    // Vérifier que les données sont valides
    if ($service_id <= 0 || empty($zone)) {
        $error_response = [
            'success' => false,
            'message' => 'Données invalides',
            'debug' => [
                'service_id' => $service_id,
                'zone' => $zone
            ]
        ];
        
        file_put_contents('../price_calculation.log', "Error: " . json_encode($error_response) . "\n", FILE_APPEND);
        echo json_encode($error_response);
        exit;
    }
    
    // Calculer le prix
    $price = calculate_delivery_price($zone, $service_id);
    
    // Si le prix est à 0, utiliser un prix par défaut
    if ($price <= 0) {
        $default_prices = [
            1 => 5.90,
            2 => 19.90,
            3 => 8.90, 
            4 => 24.90,
            5 => 14.90
        ];
        
        $price = isset($default_prices[$service_id]) ? $default_prices[$service_id] : 10.00;
        $debug_message = "Prix par défaut utilisé: $price\n";
        file_put_contents('../price_calculation.log', $debug_message, FILE_APPEND);
    }
    
    // Renvoyer le prix formaté
    $response = [
        'success' => true,
        'price' => format_price($price),
        'raw_price' => $price
    ];
    
    file_put_contents('../price_calculation.log', "Success: " . json_encode($response) . "\n", FILE_APPEND);
    echo json_encode($response);
} else {
    // Si ce n'est pas une requête AJAX, rediriger vers la page de réservation
    header('Location: ../booking.php');
    exit;
}
?>