<?php
// Configuration de l'API Mollie
define('MOLLIE_API_KEY', 'test_gGa6CwgnggD3KKngR2PdhF5VnHJ38N'); // Clé API de test
define('MOLLIE_PROFILE_ID', 'pfl_iW5zHjyvZE'); // ID de profil

// URLs de redirection
define('MOLLIE_REDIRECT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/payment-success.php');
define('MOLLIE_WEBHOOK_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/payment-webhook.php');
?>