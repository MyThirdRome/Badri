<?php
$page_title = "À propos";
$additional_css = [];
include 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">À propos de Badri Livraison & Transport</h1>
            <p class="section-subtitle">Découvrez notre histoire, nos valeurs et notre engagement envers la qualité</p>
        </div>
        
        <div class="about-section">
            <div class="about-image">
                <img src="https://pixabay.com/get/gfcfa8cbaff4463ee4169fd85fdd37f7aadc082a00365d7af68508574cd2c0d34c49c9b6cbdcf3e2312db8ef9ff1e139791c434337df90b3957b99a40637ba3c6_1280.jpg" alt="Badri Livraison & Transport">
            </div>
            <div class="about-content">
                <h2>Notre Histoire</h2>
                <p>Fondée en juin 2024 par Marouen Badri, notre entreprise est née d'une vision simple : offrir un service de livraison et de transport fiable, rapide et personnalisé à Lille et ses environs.</p>
                
                <p>Fort d'une expérience dans le domaine de la logistique et de la livraison, M. Badri a identifié un besoin croissant pour des services de livraison de qualité, notamment pour les repas, les colis et les produits alimentaires.</p>
                
                <p>Aujourd'hui, Badri Livraison & Transport Marchandises s'est imposé comme un partenaire de confiance pour les particuliers et les entreprises de la métropole lilloise, en proposant des solutions adaptées à chaque besoin.</p>
                
                <h2 style="margin-top: 30px;">Notre Mission</h2>
                <p>Notre mission est de simplifier la vie de nos clients en leur offrant des services de livraison et de transport fiables, rapides et abordables. Nous nous engageons à:</p>
                
                <ul class="about-list">
                    <li>Garantir des délais de livraison rapides et respectés</li>
                    <li>Assurer la sécurité et l'intégrité des biens transportés</li>
                    <li>Offrir un service client réactif et à l'écoute</li>
                    <li>Proposer des tarifs transparents et compétitifs</li>
                    <li>S'adapter aux besoins spécifiques de chaque client</li>
                </ul>
            </div>
        </div>
        
        <div class="section-header" style="margin-top: 80px;">
            <h2 class="section-title">Nos Valeurs</h2>
            <p class="section-subtitle">Les principes qui guident nos actions au quotidien</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="feature-title">Excellence</h3>
                <p class="feature-description">Nous visons l'excellence dans chaque aspect de notre service, de la prise de commande à la livraison finale.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="feature-title">Fiabilité</h3>
                <p class="feature-description">Nous tenons nos promesses et respectons nos engagements envers nos clients, partenaires et collaborateurs.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="feature-title">Passion</h3>
                <p class="feature-description">Nous mettons notre passion au service de nos clients pour leur offrir une expérience exceptionnelle.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="feature-title">Responsabilité</h3>
                <p class="feature-description">Nous agissons de manière responsable envers l'environnement et la communauté locale.</p>
            </div>
        </div>
        
        <div class="section-header" style="margin-top: 80px;">
            <h2 class="section-title">Notre Équipe</h2>
            <p class="section-subtitle">Des professionnels passionnés à votre service</p>
        </div>
        
        <div class="about-section">
            <div class="about-content">
                <h2>Marouen Badri - Fondateur</h2>
                <p>Entrepreneur passionné et expert en logistique, Marouen Badri a fondé Badri Livraison & Transport Marchandises avec l'ambition de créer un service de livraison qui se démarque par sa qualité et sa fiabilité.</p>
                
                <p>Après plusieurs années d'expérience dans le secteur du transport et de la livraison, il a décidé de mettre son expertise au service des particuliers et des entreprises de la région lilloise.</p>
                
                <p>Son engagement personnel dans chaque aspect de l'entreprise garantit un service à la hauteur des attentes des clients les plus exigeants.</p>
                
                <h2 style="margin-top: 30px;">Notre Équipe de Livraison</h2>
                <p>Notre équipe de livreurs expérimentés est formée pour offrir un service professionnel, courtois et efficace. Chaque membre de notre équipe partage nos valeurs d'excellence et de fiabilité.</p>
                
                <p>Nos livreurs connaissent parfaitement la métropole lilloise, ce qui leur permet d'optimiser les itinéraires et de garantir des délais de livraison rapides.</p>
            </div>
            <div class="about-image">
                <img src="https://pixabay.com/get/ga6b2ab3fc6c8f965223771e422252e57de2b449722e051346fe0cc9e1fbeb144174f8e9455a3ed13bae80bf24c9804277cd4ae90bcfb11d81a8bfb3da56f88e1_1280.jpg" alt="Notre équipe">
            </div>
        </div>
        
        <div class="section-header" style="margin-top: 80px;">
            <h2 class="section-title">Informations Légales</h2>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px;">
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Nom de l'entreprise</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_NAME; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Forme juridique</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Entrepreneur individuel</td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Date de création</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">21 juin 2024</td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Siège social</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_ADDRESS; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">SIRET</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_SIRET; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">SIREN</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_SIREN; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Code APE</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">4941B - Transports routiers de fret de proximité</td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Téléphone</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_PHONE; ?></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Email</th>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo COMPANY_EMAIL; ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Prêt à travailler avec nous ?</h2>
            <p class="cta-text">Découvrez la différence d'un service de livraison professionnel et fiable.</p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn btn-primary btn-lg">Contactez-nous</a>
                <a href="services.php" class="btn btn-outline btn-lg">Nos services</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
