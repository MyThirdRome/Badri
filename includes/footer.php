    </main>
    <footer class="main-footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-col">
                        <h3>À propos de nous</h3>
                        <p>Badri Livraison & Transport Marchandises est une entreprise de livraison et de transport basée à Lille. Nous proposons des services de livraison de repas, de transport de produits alimentaires et de livraison de colis.</p>
                        <div class="payment-methods">
                            <h4>Modes de paiement</h4>
                            <div class="payment-icons">
                                <i class="fab fa-cc-visa" title="Visa"></i>
                                <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                                <i class="fab fa-cc-apple-pay" title="Apple Pay"></i>
                                <i class="fab fa-cc-paypal" title="PayPal"></i>
                                <i class="fas fa-money-bill-wave" title="Espèces"></i>
                            </div>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h3>Liens rapides</h3>
                        <ul class="footer-links">
                            <li><a href="<?php echo SITE_ROOT; ?>">Accueil</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>services.php">Services</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>about.php">À propos</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>contact.php">Contact</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>faq.php">FAQ</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>request-quote.php">Demander un devis</a></li>
                            <li><a href="<?php echo SITE_ROOT; ?>booking.php">Réserver une livraison</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h3>Services</h3>
                        <ul class="footer-links">
                            <?php foreach ($services as $service): ?>
                            <li><a href="<?php echo SITE_ROOT; ?>services.php#service-<?php echo $service['id']; ?>"><?php echo $service['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h3>Contactez-nous</h3>
                        <address class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo COMPANY_ADDRESS; ?></p>
                                <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a></p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php echo COMPANY_NAME; ?>. Tous droits réservés.</p>
                </div>
                <div class="legal-links">
                    <a href="<?php echo SITE_ROOT; ?>terms.php">Conditions générales</a>
                    <a href="<?php echo SITE_ROOT; ?>privacy.php">Politique de confidentialité</a>
                    <a href="<?php echo SITE_ROOT; ?>cookies.php">Politique de cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <?php include 'cookie-consent.php'; ?>

    <script src="<?php echo SITE_ROOT; ?>js/main.js"></script>
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo SITE_ROOT . $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
