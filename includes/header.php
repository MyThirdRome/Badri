<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
    <title><?php echo isset($page_title) ? $page_title . ' | ' . SITE_TITLE : SITE_TITLE; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>css/style.css">
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo SITE_ROOT . $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header class="main-header">
        <div class="header-top">
            <div class="container">
                <div class="contact-info">
                    <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><i class="fas fa-envelope"></i> <?php echo COMPANY_EMAIL; ?></a>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo SITE_ROOT; ?>">
                        <img src="<?php echo SITE_ROOT; ?>assets/logo.svg" alt="<?php echo COMPANY_NAME; ?>" width="180" height="60">
                    </a>
                </div>
                <nav class="main-nav">
                    <button class="menu-toggle" aria-label="Menu">
                        <span class="hamburger"></span>
                    </button>
                    <ul class="nav-menu">
                        <li class="<?php echo is_current_page('index.php') ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_ROOT; ?>">Accueil</a>
                        </li>
                        <li class="<?php echo is_current_page('services.php') ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_ROOT; ?>services.php">Services</a>
                        </li>
                        <li class="<?php echo is_current_page('about.php') ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_ROOT; ?>about.php">À propos</a>
                        </li>
                        <li class="<?php echo is_current_page('contact.php') ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_ROOT; ?>contact.php">Contact</a>
                        </li>
                        <li class="<?php echo is_current_page('faq.php') ? 'active' : ''; ?>">
                            <a href="<?php echo SITE_ROOT; ?>faq.php">FAQ</a>
                        </li>
                        <li class="cta">
                            <a href="<?php echo SITE_ROOT; ?>request-quote.php" class="btn btn-primary">Demander un devis</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
<?php display_alert(); ?>
