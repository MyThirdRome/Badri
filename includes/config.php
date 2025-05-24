<?php
// Configuration du site
define('SITE_TITLE', 'Badri Livraison & Transport Marchandises');
define('SITE_DESCRIPTION', 'Services de livraison de repas et transport de marchandises à Lille et ses environs');
define('COMPANY_NAME', 'Badri Livraison & Transport Marchandises');
define('COMPANY_ADDRESS', '41 RUE Jacquemars Giélée, 59800 Lille, FRANCE');
define('COMPANY_PHONE', ''); // Removed as requested
define('COMPANY_EMAIL', 'bonjour@badrilivraison.com');
define('COMPANY_SIRET', '92902956900019');
define('COMPANY_SIREN', '929 029 569');

// Réglages de l'application
define('SITE_ROOT', '/');
define('INCLUDES_PATH', __DIR__ . '/');
define('PROCESS_PATH', __DIR__ . '/../process/');

// Fuseau horaire
date_default_timezone_set('Europe/Paris');

// Encodage
mb_internal_encoding('UTF-8');

// Configuration des emails
define('EMAIL_FROM', 'noreply@badri-transport.fr');
define('EMAIL_ADMIN', 'admin@badri-transport.fr');

// Services
$services = [
    [
        'id' => 1,
        'name' => 'Livraison de repas',
        'description' => 'Service de livraison rapide de repas à domicile ou au bureau.',
        'short_description' => 'Livraison rapide et fiable de repas à domicile',
        'price' => 'À partir de 5,90€',
        'icon' => 'fas fa-utensils'
    ],
    [
        'id' => 2,
        'name' => 'Transport de produits alimentaires',
        'description' => 'Transport sécurisé de produits alimentaires pour les restaurants et les commerces de proximité.',
        'short_description' => 'Transport sécurisé de produits alimentaires',
        'price' => 'À partir de 19,90€',
        'icon' => 'fas fa-truck'
    ],
    [
        'id' => 3,
        'name' => 'Livraison de colis',
        'description' => 'Service de livraison de colis pour les particuliers et les entreprises.',
        'short_description' => 'Livraison rapide et sécurisée de vos colis',
        'price' => 'À partir de 8,90€',
        'icon' => 'fas fa-box'
    ],
    [
        'id' => 4,
        'name' => 'Transport express',
        'description' => 'Service de transport express pour les envois urgents dans la région de Lille.',
        'short_description' => 'Transport express pour vos envois urgents',
        'price' => 'À partir de 24,90€',
        'icon' => 'fas fa-shipping-fast'
    ],
    [
        'id' => 5,
        'name' => 'Livraison de courses',
        'description' => 'Nous récupérons vos courses et les livrons à votre domicile.',
        'short_description' => 'Livraison de vos courses à domicile',
        'price' => 'À partir de 14,90€',
        'icon' => 'fas fa-shopping-basket'
    ]
];

// Zones de livraison
$delivery_zones = [
    'Zone 1' => ['Lille Centre', 'Vieux-Lille', 'Wazemmes', 'Moulins'],
    'Zone 2' => ['La Madeleine', 'Lambersart', 'Lomme', 'Hellemmes', 'Fives'],
    'Zone 3' => ['Villeneuve d\'Ascq', 'Roubaix', 'Tourcoing', 'Marcq-en-Barœul']
];

// FAQ
$faq_categories = [
    'general' => [
        'title' => 'Questions générales',
        'questions' => [
            [
                'question' => 'Quelles sont vos horaires d\'ouverture ?',
                'answer' => 'Nous sommes disponibles du lundi au samedi de 9h à 20h, et le dimanche de 10h à 16h.'
            ],
            [
                'question' => 'Dans quelles zones intervenez-vous ?',
                'answer' => 'Nous intervenons principalement à Lille et ses environs (La Madeleine, Lambersart, Lomme, Hellemmes, Villeneuve d\'Ascq, Roubaix, Tourcoing, etc.).'
            ],
            [
                'question' => 'Comment puis-je payer pour vos services ?',
                'answer' => 'Nous acceptons les paiements par carte bancaire, espèces et virement bancaire. Le paiement en ligne sera bientôt disponible.'
            ]
        ]
    ],
    'food_delivery' => [
        'title' => 'Livraison de repas',
        'questions' => [
            [
                'question' => 'Quel est le délai de livraison pour un repas ?',
                'answer' => 'Notre objectif est de livrer votre repas dans un délai de 30 minutes à 1 heure selon votre localisation.'
            ],
            [
                'question' => 'Comment puis-je suivre ma commande ?',
                'answer' => 'Une fois votre commande confirmée, vous recevrez un SMS avec un lien pour suivre votre livraison en temps réel.'
            ],
            [
                'question' => 'Livrez-vous les repas chauds ?',
                'answer' => 'Oui, nous utilisons des sacs isothermes spéciaux pour maintenir vos repas à la température optimale pendant le transport.'
            ]
        ]
    ],
    'package_delivery' => [
        'title' => 'Livraison de colis',
        'questions' => [
            [
                'question' => 'Quel est le poids maximum pour un colis ?',
                'answer' => 'Nous acceptons les colis jusqu\'à 30 kg. Pour des envois plus lourds, veuillez nous contacter pour une solution adaptée.'
            ],
            [
                'question' => 'Comment emballer mon colis ?',
                'answer' => 'Assurez-vous que votre colis est bien emballé dans un carton solide avec un rembourrage suffisant pour protéger son contenu.'
            ],
            [
                'question' => 'Pouvez-vous livrer des objets fragiles ?',
                'answer' => 'Oui, nous pouvons livrer des objets fragiles. Veuillez nous informer de la nature fragile de votre envoi lors de la réservation pour que nous prenions les précautions nécessaires.'
            ]
        ]
    ]
];
?>
