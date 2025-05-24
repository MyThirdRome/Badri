<?php
$page_title = "Contact";
$additional_css = ['js/form-validation.js'];
$additional_js = ['js/form-validation.js'];
include 'includes/header.php';

// Récupérer les données du formulaire en cas d'erreur
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$form_errors = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];

// Supprimer les données de session après les avoir récupérées
unset($_SESSION['form_data']);
unset($_SESSION['form_errors']);
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Contactez-nous</h1>
            <p class="section-subtitle">Nous sommes à votre écoute pour répondre à toutes vos questions</p>
        </div>
        
        <div class="contact-cards">
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="contact-card-title">Notre Adresse</h3>
                <div class="contact-card-content">
                    <p><?php echo COMPANY_ADDRESS; ?></p>
                </div>
            </div>
            
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3 class="contact-card-title">Téléphone</h3>
                <div class="contact-card-content">
                    <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>"><?php echo COMPANY_PHONE; ?></a>
                    <p>Du lundi au samedi: 9h-20h<br>Dimanche: 10h-16h</p>
                </div>
            </div>
            
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="contact-card-title">Email</h3>
                <div class="contact-card-content">
                    <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a>
                    <p>Nous répondons généralement sous 24h</p>
                </div>
            </div>
        </div>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2530.939191417978!2d3.0615365!3d50.627958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2d5880a1f4a3b%3A0xba87cce4dbe2d7ac!2s41%20Rue%20Jacquemars%20Gi%C3%A9l%C3%A9e%2C%2059000%20Lille%2C%20France!5e0!3m2!1sfr!2sfr!4v1657288765012!5m2!1sfr!2sfr" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        <div class="section-header" style="margin-top: 50px;">
            <h2 class="section-title">Envoyez-nous un message</h2>
            <p class="section-subtitle">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>
        </div>
        
        <div class="form-container">
            <form id="contact-form" action="process/contact-form.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <div class="form-group">
                    <label for="name" class="form-label">Nom complet*</label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($form_data['name']) ? htmlspecialchars($form_data['name']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" id="email" name="email" class="form-control" required value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="06 XX XX XX XX" value="<?php echo isset($form_data['phone']) ? htmlspecialchars($form_data['phone']) : ''; ?>">
                    <div class="form-hint">Format: 06 XX XX XX XX ou +33 6 XX XX XX XX</div>
                </div>
                
                <div class="form-group">
                    <label for="subject" class="form-label">Sujet*</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="">Sélectionnez un sujet</option>
                        <option value="Demande d'information" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Demande d\'information') ? 'selected' : ''; ?>>Demande d'information</option>
                        <option value="Réservation" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Réservation') ? 'selected' : ''; ?>>Réservation</option>
                        <option value="Devis" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Devis') ? 'selected' : ''; ?>>Devis</option>
                        <option value="Réclamation" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Réclamation') ? 'selected' : ''; ?>>Réclamation</option>
                        <option value="Partenariat" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Partenariat') ? 'selected' : ''; ?>>Partenariat</option>
                        <option value="Autre" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Autre') ? 'selected' : ''; ?>>Autre</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Message*</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required><?php echo isset($form_data['message']) ? htmlspecialchars($form_data['message']) : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="privacy" name="privacy" class="form-check-input" required <?php echo (isset($form_data['privacy'])) ? 'checked' : ''; ?>>
                        <label for="privacy" class="form-check-label">J'accepte que mes données soient traitées conformément à la <a href="privacy.php" target="_blank">politique de confidentialité</a>*</label>
                    </div>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Envoyer le message</button>
                </div>
                
                <?php if (!empty($form_errors)): ?>
                <div class="alert alert-danger" style="margin-top: 20px;">
                    <strong>Erreurs dans le formulaire :</strong>
                    <ul>
                        <?php foreach ($form_errors as $error): ?>
                        <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="section-header" style="margin-top: 80px;">
            <h2 class="section-title">Horaires d'ouverture</h2>
        </div>
        
        <div style="max-width: 600px; margin: 0 auto 50px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Jour</th>
                    <th style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">Horaires</th>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Lundi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Mardi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Mercredi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Jeudi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Vendredi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Samedi</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">9h - 20h</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">Dimanche</td>
                    <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">10h - 16h</td>
                </tr>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
