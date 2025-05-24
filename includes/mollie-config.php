<?php
// Configuration de l'API Mollie
define('MOLLIE_API_KEY', 'test_gGa6CwgnggD3KKngR2PdhF5VnHJ38N'); // Clé API de test
define('MOLLIE_PROFILE_ID', 'pfl_iW5zHjyvZE'); // ID de profil

// Obtenir l'URL complète du site (en prenant en compte que nous sommes sur Replit)
$base_url = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && isset($_SERVER['HTTP_HOST'])
    ? $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST']
    : 'https://' . $_SERVER['HTTP_HOST'];

// URLs de redirection
define('MOLLIE_REDIRECT_URL', $base_url . '/payment-success.php');

// Pour les tests sur Replit, nous utilisons une URL de webhook qui sera toujours accessible par Mollie
// Dans un environnement de production, vous devriez utiliser votre propre URL de webhook
define('MOLLIE_WEBHOOK_URL', 'https://webhook.site/9c54eb7f-9a21-45c5-b64a-0d91f7bdfa99');
?>