<?php
$page_title = "Accueil";
include 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Livraison & Transport de Marchandises à Lille</h1>
            <p class="hero-subtitle">Service rapide et fiable pour la livraison de repas, colis et produits alimentaires dans la métropole lilloise</p>
            <div class="hero-buttons">
                <a href="booking.php" class="btn btn-accent btn-lg">Réserver une livraison</a>
                <a href="request-quote.php" class="btn btn-outline btn-lg">Demander un devis</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nos Services</h2>
            <p class="section-subtitle">Découvrez notre gamme complète de services de livraison et de transport adaptés à vos besoins</p>
        </div>
        
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card">
                <div class="service-image">
                    <?php
                    $images = [
                        1 => 'https://pixabay.com/get/g220d0bf91f658f895ad83a9b8ffa322c57ce68d7778da6eadb870f0d913c44f2681cce5a542613acff88f1d42075c4457054e47c0e41c40d976ad58020cbb813_1280.jpg',
                        2 => 'https://pixabay.com/get/g2a48bbbae518b700e9a67068cbfe5e24b52a65e1ee5206e8b8449fbb702711ff038b2568301005ede4255328077ce445b76c7550500630a792479c66b9e0fc47_1280.jpg',
                        3 => 'https://pixabay.com/get/g87bfb9700c3b0e975b7a10e475fd125d677c1764b5face7da8bbd5106861aa14eb2a8cd49032f3f1a83606bd6e0fa44b723645341e3a399ca10aa8e093ff1bd2_1280.jpg',
                        4 => 'https://pixabay.com/get/gb5d4da3bbac904024be1e9770a19aff95cbe2cfbcc943fd6cfff3b94f153f9d533866bfc5de6f38419a64e8ff4d25d1cc3ce7a3abaf52f0d13e5114df4574616_1280.jpg',
                        5 => 'https://pixabay.com/get/g5512df8202516610423db4d0862d7e4640dcf895eec07911307f6297489017f8a6c4f107be148f29bfc1e08ba264a5e50dfe3f72bcb25f96a2fbbf60a3a8d6df_1280.jpg'
                    ];
                    $image = isset($images[$service['id']]) ? $images[$service['id']] : $images[1];
                    ?>
                    <img src="<?php echo $image; ?>" alt="<?php echo $service['name']; ?>">
                </div>
                <div class="service-content">
                    <div class="service-icon">
                        <i class="<?php echo $service['icon']; ?>"></i>
                    </div>
                    <h3 class="service-title"><?php echo $service['name']; ?></h3>
                    <p class="service-description"><?php echo $service['short_description']; ?></p>
                    <p class="service-price"><?php echo $service['price']; ?></p>
                    <a href="services.php#service-<?php echo $service['id']; ?>" class="btn btn-primary">En savoir plus</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center" style="margin-top: 40px;">
            <a href="services.php" class="btn btn-outline">Voir tous nos services</a>
        </div>
    </div>
</section>

<section class="section features">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Pourquoi nous choisir ?</h2>
            <p class="section-subtitle">Des avantages qui font la différence pour vos livraisons et transports</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3 class="feature-title">Livraison Rapide</h3>
                <p class="feature-description">Nous nous engageons à livrer vos commandes dans les meilleurs délais, avec un service express disponible.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Sécurité Garantie</h3>
                <p class="feature-description">Vos produits et colis sont manipulés avec soin et transportés en toute sécurité jusqu'à leur destination.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="feature-title">Couverture Locale</h3>
                <p class="feature-description">Nous desservons Lille et sa métropole avec une connaissance parfaite du territoire.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-temperature-low"></i>
                </div>
                <h3 class="feature-title">Chaîne du Froid</h3>
                <p class="feature-description">Transport de produits alimentaires dans le respect des normes d'hygiène et de température.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Disponibilité Étendue</h3>
                <p class="feature-description">Nous sommes à votre service 6j/7, avec des horaires adaptés à vos besoins.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="feature-title">Service Personnalisé</h3>
                <p class="feature-description">Nous adaptons nos services à vos besoins spécifiques pour une satisfaction garantie.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Zones de Livraison</h2>
            <p class="section-subtitle">Découvrez les zones que nous couvrons dans la métropole lilloise</p>
        </div>
        
        <div class="zones-grid">
            <?php foreach ($delivery_zones as $zone_name => $areas): ?>
            <div class="zone-card">
                <h3 class="zone-title"><?php echo $zone_name; ?></h3>
                <ul class="zone-areas">
                    <?php foreach ($areas as $area): ?>
                    <li><?php echo $area; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Notre Impact</h2>
            <p class="section-subtitle">Des chiffres qui témoignent de notre engagement et de notre expérience</p>
        </div>
        
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number" data-count="5000">0</div>
                <div class="stat-label">Livraisons réussies</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number" data-count="150">0</div>
                <div class="stat-label">Clients satisfaits</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number" data-count="25">0</div>
                <div class="stat-label">Restaurants partenaires</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number" data-count="98">0</div>
                <div class="stat-label">% de livraisons à l'heure</div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Prêt à faire appel à nos services ?</h2>
            <p class="cta-text">Contactez-nous dès maintenant pour discuter de vos besoins en livraison et transport. Nous vous proposerons une solution adaptée à vos exigences.</p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn btn-primary btn-lg">Contactez-nous</a>
                <a href="booking.php" class="btn btn-accent btn-lg">Réserver une livraison</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
