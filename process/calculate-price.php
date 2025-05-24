<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si la requête est une requête AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données
    $service_id = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
    $zone = isset($_POST['zone']) ? clean_string($_POST['zone']) : '';
    
    // Vérifier que les données sont valides
    if ($service_id <= 0 || empty($zone)) {
        echo json_encode([
            'success' => false,
            'message' => 'Données invalides'
        ]);
        exit;
    }
    
    // Calculer le prix
    $price = calculate_delivery_price($zone, $service_id);
    
    // Renvoyer le prix formaté
    echo json_encode([
        'success' => true,
        'price' => format_price($price),
        'raw_price' => $price
    ]);
} else {
    // Si ce n'est pas une requête AJAX, rediriger vers la page de réservation
    header('Location: ../booking.php');
    exit;
}
?>