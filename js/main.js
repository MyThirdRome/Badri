document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle for mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            
            // Toggle hamburger menu animation
            const hamburger = this.querySelector('.hamburger');
            if (hamburger) {
                hamburger.classList.toggle('active');
            }
        });
    }
    
    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    
    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });
    }
    
    // Cookie Consent
    const cookieConsent = document.getElementById('cookie-consent');
    const cookieAccept = document.getElementById('cookie-accept');
    const cookieDecline = document.getElementById('cookie-decline');
    
    if (cookieConsent && cookieAccept && cookieDecline) {
        // Check if user has already made a choice
        const cookieChoice = localStorage.getItem('cookie-consent');
        
        if (!cookieChoice) {
            // Show cookie consent banner
            cookieConsent.style.display = 'block';
        }
        
        // Handle accept button
        cookieAccept.addEventListener('click', () => {
            localStorage.setItem('cookie-consent', 'accepted');
            cookieConsent.style.display = 'none';
        });
        
        // Handle decline button
        cookieDecline.addEventListener('click', () => {
            localStorage.setItem('cookie-consent', 'declined');
            cookieConsent.style.display = 'none';
        });
    }
    
    // Service price calculation on booking page
    const serviceSelect = document.getElementById('service');
    const zoneSelect = document.getElementById('delivery_zone');
    const priceDisplay = document.getElementById('price-display');
    
    if (serviceSelect && zoneSelect && priceDisplay) {
        const updatePrice = () => {
            const serviceId = serviceSelect.value;
            const zone = zoneSelect.value;
            
            // Make AJAX request to get price
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'process/calculate-price.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        priceDisplay.textContent = response.price;
                    }
                }
            };
            
            xhr.send(`service_id=${serviceId}&zone=${encodeURIComponent(zone)}`);
        };
        
        serviceSelect.addEventListener('change', updatePrice);
        zoneSelect.addEventListener('change', updatePrice);
        
        // Initial price calculation
        if (serviceSelect.value && zoneSelect.value) {
            updatePrice();
        }
    }
    
    // Booking form steps
    const nextButtons = document.querySelectorAll('.btn-next-step');
    const prevButtons = document.querySelectorAll('.btn-prev-step');
    const formSteps = document.querySelectorAll('.booking-form-step');
    const stepIndicators = document.querySelectorAll('.booking-step');
    
    if (nextButtons.length > 0 && formSteps.length > 0) {
        nextButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                
                const currentStep = parseInt(button.getAttribute('data-current-step'));
                const nextStep = currentStep + 1;
                
                // Validate current step
                if (validateStep(currentStep)) {
                    // Hide current step
                    formSteps[currentStep - 1].style.display = 'none';
                    
                    // Show next step
                    formSteps[nextStep - 1].style.display = 'block';
                    
                    // Update step indicators
                    if (stepIndicators.length > 0) {
                        stepIndicators[currentStep - 1].classList.remove('active');
                        stepIndicators[nextStep - 1].classList.add('active');
                    }
                }
            });
        });
        
        prevButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                
                const currentStep = parseInt(button.getAttribute('data-current-step'));
                const prevStep = currentStep - 1;
                
                // Hide current step
                formSteps[currentStep - 1].style.display = 'none';
                
                // Show previous step
                formSteps[prevStep - 1].style.display = 'block';
                
                // Update step indicators
                if (stepIndicators.length > 0) {
                    stepIndicators[currentStep - 1].classList.remove('active');
                    stepIndicators[prevStep - 1].classList.add('active');
                }
            });
        });
    }
    
    // Validate form step
    function validateStep(step) {
        const stepForm = document.querySelector(`.booking-form-step[data-step="${step}"]`);
        
        if (!stepForm) {
            return true;
        }
        
        const requiredFields = stepForm.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('invalid');
                
                // Add error message if not exists
                let errorMessage = field.nextElementSibling;
                if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                    errorMessage = document.createElement('div');
                    errorMessage.classList.add('error-message');
                    errorMessage.textContent = 'Ce champ est obligatoire';
                    field.parentNode.insertBefore(errorMessage, field.nextSibling);
                }
            } else {
                field.classList.remove('invalid');
                
                // Remove error message if exists
                const errorMessage = field.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('error-message')) {
                    errorMessage.remove();
                }
            }
        });
        
        return isValid;
    }
    
    // Count up animation for statistics
    const statNumbers = document.querySelectorAll('.stat-number');
    
    if (statNumbers.length > 0) {
        const options = {
            threshold: 0.5
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const count = parseInt(target.getAttribute('data-count'));
                    
                    let current = 0;
                    const increment = Math.ceil(count / 50);
                    const duration = 2000;
                    const interval = duration / (count / increment);
                    
                    const counter = setInterval(() => {
                        current += increment;
                        
                        if (current >= count) {
                            target.textContent = count.toLocaleString();
                            clearInterval(counter);
                        } else {
                            target.textContent = current.toLocaleString();
                        }
                    }, interval);
                    
                    observer.unobserve(target);
                }
            });
        }, options);
        
        statNumbers.forEach(stat => {
            observer.observe(stat);
        });
    }
});
