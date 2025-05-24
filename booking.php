<?php
$page_title = "Réservation";
$additional_css = [];
$additional_js = ['js/form-validation.js'];
include 'includes/header.php';

// Récupérer les données du formulaire en cas d'erreur
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$form_errors = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];

// Vérifier si un service a été présélectionné dans l'URL
$selected_service = isset($_GET['service']) ? (int)$_GET['service'] : 0;
$selected_zone = isset($_GET['zone']) ? $_GET['zone'] : '';

// Supprimer les données de session après les avoir récupérées
unset($_SESSION['form_data']);
unset($_SESSION['form_errors']);
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Réservation de livraison</h1>
            <p class="section-subtitle">Complétez les informations ci-dessous pour réserver votre service de livraison</p>
        </div>
        
        <div class="booking-steps">
            <div class="booking-step active">
                <div class="booking-step-number">1</div>
                <div class="booking-step-label">Service</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-number">2</div>
                <div class="booking-step-label">Adresses</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-number">3</div>
                <div class="booking-step-label">Date et heure</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-number">4</div>
                <div class="booking-step-label">Coordonnées</div>
            </div>
        </div>
        
        <div class="form-container">
            <form id="booking-form" action="process/booking-form.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <!-- Étape 1: Service -->
                <div class="booking-form-step" data-step="1" style="display: block;">
                    <h2>Sélectionnez votre service</h2>
                    
                    <div class="form-group">
                        <label for="service" class="form-label">Type de service*</label>
                        <select id="service" name="service" class="form-control" required>
                            <option value="">Sélectionnez un service</option>
                            <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo ($selected_service == $service['id'] || (isset($form_data['service']) && $form_data['service'] == $service['id'])) ? 'selected' : ''; ?>><?php echo $service['name']; ?> - <?php echo $service['price']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="delivery_zone" class="form-label">Zone de livraison*</label>
                        <select id="delivery_zone" name="delivery_zone" class="form-control" required>
                            <option value="">Sélectionnez une zone</option>
                            <?php foreach (array_keys($delivery_zones) as $zone): ?>
                            <option value="<?php echo $zone; ?>" <?php echo ($selected_zone == $zone || (isset($form_data['delivery_zone']) && $form_data['delivery_zone'] == $zone)) ? 'selected' : ''; ?>><?php echo $zone; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Prix estimé:</label>
                        <div id="price-display" class="service-detail-price">--,-- €</div>
                        <div class="form-hint">Le prix peut varier en fonction des options sélectionnées</div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-primary btn-next-step" data-current-step="1">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 2: Adresses -->
                <div class="booking-form-step" data-step="2" style="display: none;">
                    <h2>Adresses</h2>
                    
                    <div class="form-group">
                        <label for="address" class="form-label">Adresse de livraison*</label>
                        <input type="text" id="address" name="address" class="form-control" required value="<?php echo isset($form_data['address']) ? htmlspecialchars($form_data['address']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="city" class="form-label">Ville de livraison*</label>
                        <input type="text" id="city" name="city" class="form-control" required value="<?php echo isset($form_data['city']) ? htmlspecialchars($form_data['city']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="zipcode" class="form-label">Code postal de livraison*</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" required value="<?php echo isset($form_data['zipcode']) ? htmlspecialchars($form_data['zipcode']) : ''; ?>">
                    </div>
                    
                    <div id="pickup-address-container">
                        <h3>Adresse de ramassage</h3>
                        <p class="form-hint">(Uniquement pour les services de livraison de colis et transport express)</p>
                        
                        <div class="form-group">
                            <label for="pickup_address" class="form-label">Adresse de ramassage</label>
                            <input type="text" id="pickup_address" name="pickup_address" class="form-control" value="<?php echo isset($form_data['pickup_address']) ? htmlspecialchars($form_data['pickup_address']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="pickup_city" class="form-label">Ville de ramassage</label>
                            <input type="text" id="pickup_city" name="pickup_city" class="form-control" value="<?php echo isset($form_data['pickup_city']) ? htmlspecialchars($form_data['pickup_city']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="pickup_zipcode" class="form-label">Code postal de ramassage</label>
                            <input type="text" id="pickup_zipcode" name="pickup_zipcode" class="form-control" value="<?php echo isset($form_data['pickup_zipcode']) ? htmlspecialchars($form_data['pickup_zipcode']) : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline btn-prev-step" data-current-step="2">Précédent</button>
                        <button type="button" class="btn btn-primary btn-next-step" data-current-step="2">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 3: Date et heure -->
                <div class="booking-form-step" data-step="3" style="display: none;">
                    <h2>Date et heure de livraison</h2>
                    
                    <div class="form-group">
                        <label for="delivery_date" class="form-label">Date de livraison souhaitée*</label>
                        <?php 
                        // Définir la date minimale (aujourd'hui)
                        $min_date = date('Y-m-d');
                        // Définir la date maximale (30 jours à partir d'aujourd'hui)
                        $max_date = date('Y-m-d', strtotime('+30 days'));
                        ?>
                        <input type="date" id="delivery_date" name="delivery_date" class="form-control" min="<?php echo $min_date; ?>" max="<?php echo $max_date; ?>" required value="<?php echo isset($form_data['delivery_date']) ? htmlspecialchars($form_data['delivery_date']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="delivery_time" class="form-label">Heure de livraison souhaitée*</label>
                        <select id="delivery_time" name="delivery_time" class="form-control" required>
                            <option value="">Sélectionnez une heure</option>
                            <?php
                            // Générer les options de temps de 9h à 19h par tranches de 30 minutes
                            for ($hour = 9; $hour < 20; $hour++) {
                                for ($min = 0; $min < 60; $min += 30) {
                                    if ($hour == 19 && $min == 30) continue; // Exclure 19h30
                                    $time = sprintf('%02d:%02d', $hour, $min);
                                    $display_time = $time;
                                    $selected = (isset($form_data['delivery_time']) && $form_data['delivery_time'] === $time) ? 'selected' : '';
                                    echo "<option value=\"{$time}\" {$selected}>{$display_time}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Options supplémentaires</label>
                        
                        <div class="form-check">
                            <input type="checkbox" id="express_delivery" name="express_delivery" value="1" class="form-check-input" <?php echo (isset($form_data['express_delivery'])) ? 'checked' : ''; ?>>
                            <label for="express_delivery" class="form-check-label">Livraison express (+5,00€)</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" id="insurance" name="insurance" value="1" class="form-check-input" <?php echo (isset($form_data['insurance'])) ? 'checked' : ''; ?>>
                            <label for="insurance" class="form-check-label">Assurance supplémentaire (+3,50€)</label>
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" id="signature_required" name="signature_required" value="1" class="form-check-input" <?php echo (isset($form_data['signature_required'])) ? 'checked' : ''; ?>>
                            <label for="signature_required" class="form-check-label">Signature à la livraison (+2,00€)</label>
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline btn-prev-step" data-current-step="3">Précédent</button>
                        <button type="button" class="btn btn-primary btn-next-step" data-current-step="3">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 4: Coordonnées -->
                <div class="booking-form-step" data-step="4" style="display: none;">
                    <h2>Vos coordonnées</h2>
                    
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
                        <label for="notes" class="form-label">Instructions spéciales (optionnel)</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"><?php echo isset($form_data['notes']) ? htmlspecialchars($form_data['notes']) : ''; ?></textarea>
                        <div class="form-hint">Ex: code d'entrée, étage, instructions pour le livreur...</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment_method" class="form-label">Mode de paiement*</label>
                        <select id="payment_method" name="payment_method" class="form-control" required>
                            <option value="">Sélectionnez un mode de paiement</option>
                            <option value="Carte bancaire à la livraison" <?php echo (isset($form_data['payment_method']) && $form_data['payment_method'] === 'Carte bancaire à la livraison') ? 'selected' : ''; ?>>Carte bancaire à la livraison</option>
                            <option value="Espèces à la livraison" <?php echo (isset($form_data['payment_method']) && $form_data['payment_method'] === 'Espèces à la livraison') ? 'selected' : ''; ?>>Espèces à la livraison</option>
                            <option value="Virement bancaire" <?php echo (isset($form_data['payment_method']) && $form_data['payment_method'] === 'Virement bancaire') ? 'selected' : ''; ?>>Virement bancaire</option>
                        </select>
                        <div class="form-hint">Le paiement en ligne sera bientôt disponible</div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="terms" name="terms" class="form-check-input" required <?php echo (isset($form_data['terms'])) ? 'checked' : ''; ?>>
                            <label for="terms" class="form-check-label">J'accepte les <a href="terms.php" target="_blank">conditions générales</a>*</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="privacy" name="privacy" class="form-check-input" required <?php echo (isset($form_data['privacy'])) ? 'checked' : ''; ?>>
                            <label for="privacy" class="form-check-label">J'accepte que mes données soient traitées conformément à la <a href="privacy.php" target="_blank">politique de confidentialité</a>*</label>
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline btn-prev-step" data-current-step="4">Précédent</button>
                        <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
                    </div>
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
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Afficher/masquer les champs d'adresse de ramassage en fonction du service sélectionné
    const serviceSelect = document.getElementById('service');
    const pickupAddressContainer = document.getElementById('pickup-address-container');
    
    if (serviceSelect && pickupAddressContainer) {
        const updatePickupAddressVisibility = () => {
            const serviceId = parseInt(serviceSelect.value);
            // Services de livraison de colis (3) et transport express (4) nécessitent une adresse de ramassage
            if (serviceId === 3 || serviceId === 4) {
                pickupAddressContainer.style.display = 'block';
                // Rendre les champs d'adresse de ramassage obligatoires
                document.getElementById('pickup_address').setAttribute('required', '');
                document.getElementById('pickup_city').setAttribute('required', '');
                document.getElementById('pickup_zipcode').setAttribute('required', '');
            } else {
                pickupAddressContainer.style.display = 'none';
                // Rendre les champs d'adresse de ramassage optionnels
                document.getElementById('pickup_address').removeAttribute('required');
                document.getElementById('pickup_city').removeAttribute('required');
                document.getElementById('pickup_zipcode').removeAttribute('required');
            }
        };
        
        // Initialiser l'affichage
        updatePickupAddressVisibility();
        
        // Mettre à jour l'affichage lorsque le service change
        serviceSelect.addEventListener('change', updatePickupAddressVisibility);
    }
    
    // Calculer et afficher le prix en fonction du service et de la zone
    const calculatePrice = () => {
        const serviceId = parseInt(serviceSelect.value);
        const zoneSelect = document.getElementById('delivery_zone');
        const priceDisplay = document.getElementById('price-display');
        
        if (!serviceId || !zoneSelect.value || !priceDisplay) {
            return;
        }
        
        // Tarifs de base par service et zone
        const basePrices = {
            1: { // Livraison de repas
                'Zone 1': 5.90,
                'Zone 2': 7.90,
                'Zone 3': 9.90
            },
            2: { // Transport de produits alimentaires
                'Zone 1': 19.90,
                'Zone 2': 25.90,
                'Zone 3': 31.90
            },
            3: { // Livraison de colis
                'Zone 1': 8.90,
                'Zone 2': 11.90,
                'Zone 3': 14.90
            },
            4: { // Transport express
                'Zone 1': 24.90,
                'Zone 2': 32.90,
                'Zone 3': 39.90
            },
            5: { // Livraison de courses
                'Zone 1': 14.90,
                'Zone 2': 19.90,
                'Zone 3': 24.90
            }
        };
        
        if (basePrices[serviceId] && basePrices[serviceId][zoneSelect.value]) {
            const price = basePrices[serviceId][zoneSelect.value];
            priceDisplay.textContent = price.toFixed(2).replace('.', ',') + ' €';
        } else {
            priceDisplay.textContent = '--,-- €';
        }
    };
    
    if (serviceSelect) {
        serviceSelect.addEventListener('change', calculatePrice);
        document.getElementById('delivery_zone').addEventListener('change', calculatePrice);
        
        // Calculer le prix initial si les valeurs sont déjà sélectionnées
        if (serviceSelect.value && document.getElementById('delivery_zone').value) {
            calculatePrice();
        }
    }
});
</script>

<style>
/* Styles supplémentaires pour le formulaire de réservation */
.booking-form-step {
    background-color: #fff;
    padding: 30px;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
}

.booking-form-step h2 {
    margin-bottom: 25px;
    color: hsl(var(--primary));
    font-size: 24px;
    font-weight: 600;
}

.booking-form-step h3 {
    margin: 30px 0 15px;
    font-size: 20px;
    font-weight: 600;
}

#pickup-address-container {
    margin-top: 30px;
    padding-top: 10px;
    border-top: 1px solid hsl(var(--light));
}

.form-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.error-message {
    color: hsl(var(--danger));
    font-size: 14px;
    margin-top: 5px;
}

.form-control.invalid {
    border-color: hsl(var(--danger));
}

@media (max-width: 576px) {
    .form-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .form-buttons .btn {
        width: 100%;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
