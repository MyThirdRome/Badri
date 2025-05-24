<?php
$page_title = "FAQ";
include 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Questions Fréquentes</h1>
            <p class="section-subtitle">Trouvez des réponses aux questions les plus courantes sur nos services</p>
        </div>
        
        <div class="faq-container">
            <?php foreach ($faq_categories as $category_key => $category): ?>
            <div class="faq-category">
                <h2 class="faq-category-title"><?php echo $category['title']; ?></h2>
                
                <?php foreach ($category['questions'] as $index => $item): ?>
                <div class="faq-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                    <div class="faq-question"><?php echo $item['question']; ?></div>
                    <div class="faq-answer"><?php echo $item['answer']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            
            <!-- Catégorie supplémentaire: Transport de produits alimentaires -->
            <div class="faq-category">
                <h2 class="faq-category-title">Transport de produits alimentaires</h2>
                
                <div class="faq-item">
                    <div class="faq-question">Comment assurez-vous le respect de la chaîne du froid ?</div>
                    <div class="faq-answer">Nous utilisons des équipements spécialisés (sacs isothermes, conteneurs réfrigérés) pour maintenir la température adéquate pendant tout le transport. Nos véhicules sont également équipés de compartiments à température contrôlée pour les produits qui nécessitent une réfrigération.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Quels types de produits alimentaires pouvez-vous transporter ?</div>
                    <div class="faq-answer">Nous transportons une large gamme de produits alimentaires : plats préparés, produits frais (fruits, légumes, viandes, poissons), produits laitiers, pâtisseries, et boissons. Nous adaptons notre mode de transport en fonction de la nature des produits.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Proposez-vous des livraisons régulières pour les restaurants ?</div>
                    <div class="faq-answer">Oui, nous proposons des contrats de livraison régulière pour les restaurants et commerces alimentaires. Vous pouvez établir un planning hebdomadaire ou mensuel selon vos besoins, avec des tarifs préférentiels pour les livraisons récurrentes.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Êtes-vous en conformité avec les normes d'hygiène alimentaire ?</div>
                    <div class="faq-answer">Absolument. Nous respectons strictement les normes HACCP et autres réglementations relatives à l'hygiène alimentaire. Notre personnel est formé aux bonnes pratiques de manipulation des denrées alimentaires et nos équipements sont régulièrement nettoyés et désinfectés.</div>
                </div>
            </div>
            
            <!-- Catégorie supplémentaire: Livraison de courses -->
            <div class="faq-category">
                <h2 class="faq-category-title">Livraison de courses</h2>
                
                <div class="faq-item">
                    <div class="faq-question">Comment fonctionne votre service de livraison de courses ?</div>
                    <div class="faq-answer">Vous pouvez soit nous confier votre liste de courses et nous nous chargeons de les faire pour vous, soit nous récupérons vos courses déjà préparées (Click & Collect) et nous vous les livrons à domicile. Le service inclut le transport jusqu'à votre domicile et la remise en main propre.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Dans quels magasins pouvez-vous faire ou récupérer mes courses ?</div>
                    <div class="faq-answer">Nous intervenons dans la plupart des supermarchés et hypermarchés de la métropole lilloise (Carrefour, Auchan, Leclerc, Intermarché, etc.), ainsi que dans les commerces de proximité et les marchés locaux.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Comment se passe le paiement des courses ?</div>
                    <div class="faq-answer">Si nous faisons vos courses, vous pouvez soit nous fournir une avance, soit nous rembourser à la livraison sur présentation du ticket de caisse. Pour les courses déjà payées (Click & Collect), vous ne payez que les frais de livraison.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Puis-je programmer des livraisons récurrentes ?</div>
                    <div class="faq-answer">Oui, nous proposons des formules d'abonnement hebdomadaire ou mensuel pour la livraison régulière de vos courses. Ces formules bénéficient de tarifs préférentiels et d'une priorité de créneau horaire.</div>
                </div>
            </div>
            
            <!-- Catégorie supplémentaire: Tarifs et paiement -->
            <div class="faq-category">
                <h2 class="faq-category-title">Tarifs et paiement</h2>
                
                <div class="faq-item">
                    <div class="faq-question">Comment sont calculés vos tarifs de livraison ?</div>
                    <div class="faq-answer">Nos tarifs sont calculés en fonction de plusieurs critères : le type de service, la zone de livraison, le poids/volume des marchandises, et les éventuelles options supplémentaires (livraison express, assurance, etc.). Vous pouvez obtenir un devis précis en quelques clics sur notre site.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Quels modes de paiement acceptez-vous ?</div>
                    <div class="faq-answer">Nous acceptons les paiements par carte bancaire, espèces et virement bancaire. Le paiement en ligne sera bientôt disponible sur notre site. Pour les clients professionnels, nous proposons également le paiement sur facture avec des délais négociés.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Proposez-vous des tarifs spéciaux pour les entreprises ?</div>
                    <div class="faq-answer">Oui, nous proposons des tarifs professionnels adaptés aux besoins des entreprises, notamment pour les livraisons régulières ou les volumes importants. N'hésitez pas à nous contacter pour établir un devis personnalisé.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Y a-t-il des frais supplémentaires pour certaines zones de livraison ?</div>
                    <div class="faq-answer">Nos tarifs varient en fonction de trois zones de livraison : Zone 1 (Lille Centre et quartiers proches), Zone 2 (première couronne), et Zone 3 (deuxième couronne). Les tarifs précis pour chaque zone sont indiqués sur notre page Services.</div>
                </div>
            </div>
            
            <!-- Catégorie supplémentaire: Réservations et délais -->
            <div class="faq-category">
                <h2 class="faq-category-title">Réservations et délais</h2>
                
                <div class="faq-item">
                    <div class="faq-question">Comment puis-je réserver une livraison ?</div>
                    <div class="faq-answer">Vous pouvez réserver une livraison directement sur notre site web via le formulaire de réservation, par téléphone au <?php echo COMPANY_PHONE; ?>, ou par email à <?php echo COMPANY_EMAIL; ?>. Pour les demandes urgentes, nous vous recommandons de nous appeler directement.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Quel est le délai minimum pour réserver une livraison ?</div>
                    <div class="faq-answer">Pour les services standard, nous recommandons de réserver au moins 2 heures à l'avance. Pour les livraisons express, nous pouvons intervenir dans un délai de 30 minutes à 1 heure selon votre localisation et notre disponibilité. Les réservations anticipées sont privilégiées pour garantir votre créneau horaire.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Puis-je annuler ou modifier ma réservation ?</div>
                    <div class="faq-answer">Oui, vous pouvez annuler ou modifier votre réservation jusqu'à 1 heure avant l'heure prévue sans frais. Pour les annulations tardives (moins d'une heure avant), des frais d'annulation de 50% du montant de la prestation peuvent s'appliquer.</div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Comment puis-je suivre ma livraison ?</div>
                    <div class="faq-answer">Une fois votre commande confirmée, vous recevrez un SMS avec un lien pour suivre votre livraison en temps réel. Vous pouvez également nous contacter par téléphone pour obtenir des informations sur l'état de votre livraison.</div>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <h3>Vous n'avez pas trouvé de réponse à votre question ?</h3>
            <p>N'hésitez pas à nous contacter directement. Notre équipe se fera un plaisir de vous répondre.</p>
            <a href="contact.php" class="btn btn-primary">Contactez-nous</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
