<?php
$page_title = "Nos Services";
$additional_css = [];
include 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Nos Services de Livraison et Transport</h1>
            <p class="section-subtitle">Découvrez notre gamme complète de services de livraison et de transport adaptés à vos besoins à Lille et ses environs</p>
        </div>
        
        <?php foreach ($services as $service): ?>
        <div id="service-<?php echo $service['id']; ?>" class="service-detail">
            <div class="service-detail-image">
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
            <div class="service-detail-content">
                <h2><?php echo $service['name']; ?></h2>
                <p class="service-detail-price"><?php echo $service['price']; ?></p>
                <p><?php echo $service['description']; ?></p>
                
                <?php if ($service['id'] == 1): // Livraison de repas ?>
                    <ul class="service-detail-features">
                        <li>Livraison dans un délai de 30 minutes à 1 heure</li>
                        <li>Transport dans des sacs isothermes spéciaux</li>
                        <li>Suivi en temps réel de votre commande</li>
                        <li>Disponible pour les particuliers et les restaurants</li>
                        <li>Options de livraison express disponibles</li>
                    </ul>
                    
                    <div class="price-tables">
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 1</h3>
                                <div class="price-table-price">5,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Lille Centre</li>
                                    <li>Vieux-Lille</li>
                                    <li>Wazemmes</li>
                                    <li>Moulins</li>
                                    <li>Délai de livraison: 30 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=1&zone=Zone%201" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 2</h3>
                                <div class="price-table-price">7,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>La Madeleine</li>
                                    <li>Lambersart</li>
                                    <li>Lomme</li>
                                    <li>Hellemmes</li>
                                    <li>Délai de livraison: 45 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=1&zone=Zone%202" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 3</h3>
                                <div class="price-table-price">9,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Villeneuve d'Ascq</li>
                                    <li>Roubaix</li>
                                    <li>Tourcoing</li>
                                    <li>Marcq-en-Barœul</li>
                                    <li>Délai de livraison: 60 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=1&zone=Zone%203" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($service['id'] == 2): // Transport de produits alimentaires ?>
                    <ul class="service-detail-features">
                        <li>Transport sécurisé des produits alimentaires</li>
                        <li>Respect strict de la chaîne du froid</li>
                        <li>Véhicules équipés de compartiments réfrigérés</li>
                        <li>Livraison directe du fournisseur au client</li>
                        <li>Possibilité de livraisons régulières</li>
                    </ul>
                    
                    <div class="price-tables">
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 1</h3>
                                <div class="price-table-price">19,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Lille Centre</li>
                                    <li>Vieux-Lille</li>
                                    <li>Wazemmes</li>
                                    <li>Moulins</li>
                                    <li>Jusqu'à 25kg de marchandises</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=2&zone=Zone%201" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 2</h3>
                                <div class="price-table-price">25,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>La Madeleine</li>
                                    <li>Lambersart</li>
                                    <li>Lomme</li>
                                    <li>Hellemmes</li>
                                    <li>Jusqu'à 25kg de marchandises</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=2&zone=Zone%202" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 3</h3>
                                <div class="price-table-price">31,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Villeneuve d'Ascq</li>
                                    <li>Roubaix</li>
                                    <li>Tourcoing</li>
                                    <li>Marcq-en-Barœul</li>
                                    <li>Jusqu'à 25kg de marchandises</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=2&zone=Zone%203" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($service['id'] == 3): // Livraison de colis ?>
                    <ul class="service-detail-features">
                        <li>Livraison sécurisée de colis jusqu'à 30kg</li>
                        <li>Ramassage à domicile ou en entreprise</li>
                        <li>Traçabilité des colis en temps réel</li>
                        <li>Assurance disponible pour les objets de valeur</li>
                        <li>Option de livraison avec signature</li>
                    </ul>
                    
                    <div class="price-tables">
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 1</h3>
                                <div class="price-table-price">8,90€</div>
                                <div class="price-table-period">par colis</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Lille Centre</li>
                                    <li>Vieux-Lille</li>
                                    <li>Wazemmes</li>
                                    <li>Moulins</li>
                                    <li>Jusqu'à 5kg</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=3&zone=Zone%201" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 2</h3>
                                <div class="price-table-price">11,90€</div>
                                <div class="price-table-period">par colis</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>La Madeleine</li>
                                    <li>Lambersart</li>
                                    <li>Lomme</li>
                                    <li>Hellemmes</li>
                                    <li>Jusqu'à 5kg</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=3&zone=Zone%202" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 3</h3>
                                <div class="price-table-price">14,90€</div>
                                <div class="price-table-period">par colis</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Villeneuve d'Ascq</li>
                                    <li>Roubaix</li>
                                    <li>Tourcoing</li>
                                    <li>Marcq-en-Barœul</li>
                                    <li>Jusqu'à 5kg</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=3&zone=Zone%203" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($service['id'] == 4): // Transport express ?>
                    <ul class="service-detail-features">
                        <li>Livraison garantie en moins d'une heure</li>
                        <li>Service prioritaire avec traitement immédiat</li>
                        <li>Idéal pour les envois urgents</li>
                        <li>Disponible 7j/7</li>
                        <li>Confirmation de livraison par SMS</li>
                    </ul>
                    
                    <div class="price-tables">
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 1</h3>
                                <div class="price-table-price">24,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Lille Centre</li>
                                    <li>Vieux-Lille</li>
                                    <li>Wazemmes</li>
                                    <li>Moulins</li>
                                    <li>Délai: moins de 30 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=4&zone=Zone%201" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 2</h3>
                                <div class="price-table-price">32,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>La Madeleine</li>
                                    <li>Lambersart</li>
                                    <li>Lomme</li>
                                    <li>Hellemmes</li>
                                    <li>Délai: moins de 45 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=4&zone=Zone%202" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 3</h3>
                                <div class="price-table-price">39,90€</div>
                                <div class="price-table-period">par transport</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Villeneuve d'Ascq</li>
                                    <li>Roubaix</li>
                                    <li>Tourcoing</li>
                                    <li>Marcq-en-Barœul</li>
                                    <li>Délai: moins de 60 min</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=4&zone=Zone%203" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($service['id'] == 5): // Livraison de courses ?>
                    <ul class="service-detail-features">
                        <li>Nous récupérons vos courses et les livrons à votre domicile</li>
                        <li>Service disponible pour les particuliers et les professionnels</li>
                        <li>Respect de la chaîne du froid pour les produits frais</li>
                        <li>Possibilité de livraison à une heure précise</li>
                        <li>Option de livraison récurrente hebdomadaire</li>
                    </ul>
                    
                    <div class="price-tables">
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 1</h3>
                                <div class="price-table-price">14,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Lille Centre</li>
                                    <li>Vieux-Lille</li>
                                    <li>Wazemmes</li>
                                    <li>Moulins</li>
                                    <li>Jusqu'à 3 sacs de courses</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=5&zone=Zone%201" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 2</h3>
                                <div class="price-table-price">19,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>La Madeleine</li>
                                    <li>Lambersart</li>
                                    <li>Lomme</li>
                                    <li>Hellemmes</li>
                                    <li>Jusqu'à 3 sacs de courses</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=5&zone=Zone%202" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                        
                        <div class="price-table">
                            <div class="price-table-header">
                                <h3 class="price-table-title">Zone 3</h3>
                                <div class="price-table-price">24,90€</div>
                                <div class="price-table-period">par livraison</div>
                            </div>
                            <div class="price-table-content">
                                <ul class="price-table-features">
                                    <li>Villeneuve d'Ascq</li>
                                    <li>Roubaix</li>
                                    <li>Tourcoing</li>
                                    <li>Marcq-en-Barœul</li>
                                    <li>Jusqu'à 3 sacs de courses</li>
                                </ul>
                            </div>
                            <div class="price-table-footer">
                                <a href="booking.php?service=5&zone=Zone%203" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div style="margin-top: 30px;">
                    <a href="request-quote.php?service_id=<?php echo $service['id']; ?>" class="btn btn-secondary">Demander un devis personnalisé</a>
                    <a href="booking.php?service=<?php echo $service['id']; ?>" class="btn btn-primary">Réserver ce service</a>
                </div>
            </div>
        </div>
        
        <?php if ($service !== end($services)): ?>
            <hr style="margin: 50px 0;">
        <?php endif; ?>
        
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Besoin d'un service sur mesure ?</h2>
            <p class="cta-text">Nous pouvons adapter nos services à vos besoins spécifiques. Contactez-nous pour discuter de votre projet.</p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn btn-primary btn-lg">Contactez-nous</a>
                <a href="request-quote.php" class="btn btn-outline btn-lg">Demander un devis</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
