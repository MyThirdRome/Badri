<?php
$page_title = "Demande de Devis";
$additional_js = ['js/form-validation.js'];
include 'includes/header.php';

// Récupérer les données du formulaire en cas d'erreur
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$form_errors = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];

// Vérifier si un service a été présélectionné dans l'URL
$selected_service_id = isset($_GET['service_id']) ? (int)$_GET['service_id'] : 0;

// Supprimer les données de session après les avoir récupérées
unset($_SESSION['form_data']);
unset($_SESSION['form_errors']);
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Demande de Devis</h1>
            <p class="section-subtitle">Remplissez le formulaire ci-dessous pour recevoir un devis personnalisé</p>
        </div>
        
        <div class="form-container">
            <form id="quote-form" action="process/quote-form.php" method="POST">
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
                    <label for="phone" class="form-label">Téléphone*</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="06 XX XX XX XX" required value="<?php echo isset($form_data['phone']) ? htmlspecialchars($form_data['phone']) : ''; ?>">
                    <div class="form-hint">Format: 06 XX XX XX XX ou +33 6 XX XX XX XX</div>
                </div>
                
                <div class="form-group">
                    <label for="company" class="form-label">Entreprise (optionnel)</label>
                    <input type="text" id="company" name="company" class="form-control" value="<?php echo isset($form_data['company']) ? htmlspecialchars($form_data['company']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="service" class="form-label">Service souhaité*</label>
                    <select id="service" name="service" class="form-control" required>
                        <option value="">Sélectionnez un service</option>
                        <?php foreach ($services as $service): ?>
                        <option value="<?php echo $service['name']; ?>" data-id="<?php echo $service['id']; ?>" <?php echo ($selected_service_id == $service['id'] || (isset($form_data['service']) && $form_data['service'] === $service['name'])) ? 'selected' : ''; ?>><?php echo $service['name']; ?></option>
                        <?php endforeach; ?>
                        <option value="Autre" <?php echo (isset($form_data['service']) && $form_data['service'] === 'Autre') ? 'selected' : ''; ?>>Autre (précisez dans le message)</option>
                    </select>
                    <input type="hidden" id="service_id" name="service_id" value="<?php echo $selected_service_id; ?>">
                </div>
                
                <div class="form-group">
                    <label for="zone" class="form-label">Zone de livraison*</label>
                    <select id="zone" name="zone" class="form-control" required>
                        <option value="">Sélectionnez une zone</option>
                        <?php foreach (array_keys($delivery_zones) as $zone): ?>
                        <option value="<?php echo $zone; ?>" <?php echo (isset($form_data['zone']) && $form_data['zone'] === $zone) ? 'selected' : ''; ?>><?php echo $zone; ?></option>
                        <?php endforeach; ?>
                        <option value="Autre" <?php echo (isset($form_data['zone']) && $form_data['zone'] === 'Autre') ? 'selected' : ''; ?>>Autre (précisez dans le message)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Détails de votre demande*</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required placeholder="Décrivez votre besoin en détail (nature des produits, quantités, fréquence, délais souhaités, etc.)"><?php echo isset($form_data['message']) ? htmlspecialchars($form_data['message']) : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="privacy" name="privacy" class="form-check-input" required <?php echo (isset($form_data['privacy'])) ? 'checked' : ''; ?>>
                        <label for="privacy" class="form-check-label">J'accepte que mes données soient traitées conformément à la <a href="privacy.php" target="_blank">politique de confidentialité</a>*</label>
                    </div>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Envoyer la demande de devis</button>
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
        
        <div style="max-width: 800px; margin: 50px auto 0; text-align: center;">
            <h3>Pourquoi demander un devis ?</h3>
            <p>Un devis personnalisé vous permet d'obtenir une tarification précise adaptée à vos besoins spécifiques. Nous prenons en compte de nombreux facteurs pour vous proposer la solution la plus avantageuse :</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; margin-top: 30px; text-align: left;">
                <div>
                    <h4><i class="fas fa-route" style="color: hsl(var(--primary)); margin-right: 10px;"></i> Distance</h4>
                    <p>La distance entre le point de départ et la destination finale influence le coût du transport.</p>
                </div>
                
                <div>
                    <h4><i class="fas fa-weight-hanging" style="color: hsl(var(--primary)); margin-right: 10px;"></i> Poids et volume</h4>
                    <p>Les dimensions et le poids de vos marchandises déterminent le type de véhicule nécessaire.</p>
                </div>
                
                <div>
                    <h4><i class="fas fa-calendar-alt" style="color: hsl(var(--primary)); margin-right: 10px;"></i> Fréquence</h4>
                    <p>Des livraisons régulières peuvent bénéficier de tarifs préférentiels et de plannings optimisés.</p>
                </div>
                
                <div>
                    <h4><i class="fas fa-clock" style="color: hsl(var(--primary)); margin-right: 10px;"></i> Urgence</h4>
                    <p>Les livraisons express ou à horaires précis peuvent nécessiter une tarification spécifique.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Besoin d'une réponse rapide ?</h2>
            <p class="cta-text">Appelez-nous directement au <?php echo COMPANY_PHONE; ?> pour discuter de vos besoins et obtenir un devis immédiat.</p>
            <div class="cta-buttons">
                <a href="tel:<?php echo str_replace(' ', '', COMPANY_PHONE); ?>" class="btn btn-primary btn-lg">Appeler maintenant</a>
                <a href="booking.php" class="btn btn-outline btn-lg">Réserver une livraison</a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mettre à jour l'ID du service lorsque la sélection change
    const serviceSelect = document.getElementById('service');
    const serviceIdInput = document.getElementById('service_id');
    
    if (serviceSelect && serviceIdInput) {
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const serviceId = selectedOption.getAttribute('data-id') || 0;
            serviceIdInput.value = serviceId;
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
