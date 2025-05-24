<?php
/**
 * Fonctions utilitaires pour le site
 */

/**
 * Nettoie une chaîne de caractères
 *
 * @param string $string La chaîne à nettoyer
 * @return string La chaîne nettoyée
 */
function clean_string($string) {
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}

/**
 * Vérifie si une chaîne est vide
 *
 * @param string $string La chaîne à vérifier
 * @return bool True si la chaîne est vide, false sinon
 */
function is_empty($string) {
    return empty(trim($string));
}

/**
 * Vérifie si une adresse email est valide
 *
 * @param string $email L'adresse email à vérifier
 * @return bool True si l'adresse email est valide, false sinon
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Vérifie si un numéro de téléphone est valide (format français)
 *
 * @param string $phone Le numéro de téléphone à vérifier
 * @return bool True si le numéro de téléphone est valide, false sinon
 */
function is_valid_phone($phone) {
    // Format français: 0X XX XX XX XX ou +33 X XX XX XX XX
    $phone = preg_replace('/\s+/', '', $phone); // Supprime les espaces
    return preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/', $phone) === 1;
}

/**
 * Génère un jeton CSRF
 *
 * @return string Le jeton CSRF
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie si un jeton CSRF est valide
 *
 * @param string $token Le jeton à vérifier
 * @return bool True si le jeton est valide, false sinon
 */
function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

/**
 * Redirige vers une URL
 *
 * @param string $url L'URL de redirection
 * @return void
 */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/**
 * Affiche un message d'alerte
 *
 * @param string $message Le message à afficher
 * @param string $type Le type d'alerte (success, danger, warning, info)
 * @return void
 */
function set_alert($message, $type = 'info') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
 * Récupère et supprime le message d'alerte
 *
 * @return array|null Le message d'alerte ou null s'il n'y en a pas
 */
function get_alert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
        return $alert;
    }
    return null;
}

/**
 * Affiche les messages d'alerte
 *
 * @return void
 */
function display_alert() {
    $alert = get_alert();
    if ($alert) {
        echo '<div class="alert alert-' . $alert['type'] . '">' . $alert['message'] . '</div>';
    }
}

/**
 * Vérifie si la page actuelle correspond à l'URL donnée
 *
 * @param string $url L'URL à vérifier
 * @return bool True si la page actuelle correspond à l'URL, false sinon
 */
function is_current_page($url) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page === $url;
}

/**
 * Génère un identifiant unique pour une commande
 *
 * @return string L'identifiant unique
 */
function generate_order_id() {
    return 'BDR-' . date('Ymd') . '-' . substr(uniqid(), -6);
}

/**
 * Calcule le prix de livraison en fonction de la zone et du service
 *
 * @param string $zone La zone de livraison
 * @param int $service_id L'identifiant du service
 * @return float Le prix de livraison
 */
function calculate_delivery_price($zone, $service_id) {
    $base_prices = [
        1 => 5.90, // Livraison de repas
        2 => 19.90, // Transport de produits alimentaires
        3 => 8.90, // Livraison de colis
        4 => 24.90, // Transport express
        5 => 14.90 // Livraison de courses
    ];
    
    $zone_multipliers = [
        'Zone 1' => 1.0,
        'Zone 2' => 1.3,
        'Zone 3' => 1.6
    ];
    
    if (!isset($base_prices[$service_id]) || !isset($zone_multipliers[$zone])) {
        return 0;
    }
    
    return round($base_prices[$service_id] * $zone_multipliers[$zone], 2);
}

/**
 * Formate un prix en euros
 *
 * @param float $price Le prix à formater
 * @return string Le prix formaté
 */
function format_price($price) {
    return number_format($price, 2, ',', ' ') . ' €';
}

/**
 * Envoie un email
 *
 * @param string $to L'adresse email du destinataire
 * @param string $subject Le sujet de l'email
 * @param string $message Le contenu de l'email
 * @param string $from L'adresse email de l'expéditeur
 * @return bool True si l'email a été envoyé, false sinon
 */
function send_email($to, $subject, $message, $from = EMAIL_FROM) {
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $message, $headers);
}

/**
 * Tronque un texte à une longueur donnée
 *
 * @param string $text Le texte à tronquer
 * @param int $length La longueur maximale
 * @param string $suffix Le suffixe à ajouter si le texte est tronqué
 * @return string Le texte tronqué
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . $suffix;
}

/**
 * Calcule le prix total d'une commande
 *
 * @param float $base_price Le prix de base
 * @param array $options Les options supplémentaires
 * @return float Le prix total
 */
function calculate_total_price($base_price, $options = []) {
    $total = $base_price;
    
    foreach ($options as $option) {
        if (isset($option['price'])) {
            $total += $option['price'];
        }
    }
    
    return $total;
}
?>
