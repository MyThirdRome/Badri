document.addEventListener('DOMContentLoaded', function() {
    // Contact Form Validation
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateForm(contactForm)) {
                e.preventDefault();
            }
        });
    }
    
    // Quote Form Validation
    const quoteForm = document.getElementById('quote-form');
    if (quoteForm) {
        quoteForm.addEventListener('submit', function(e) {
            if (!validateForm(quoteForm)) {
                e.preventDefault();
            }
        });
    }
    
    // Booking Form Validation
    const bookingForm = document.getElementById('booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            if (!validateForm(bookingForm)) {
                e.preventDefault();
            }
        });
    }
    
    // Validate individual form fields on blur
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(input);
        });
        
        // Clear error on input
        input.addEventListener('input', function() {
            const errorMessage = this.nextElementSibling;
            if (errorMessage && errorMessage.classList.contains('error-message')) {
                errorMessage.remove();
                this.classList.remove('invalid');
            }
        });
    });
    
    // Function to validate entire form
    function validateForm(form) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });
        
        // Validate email format
        const emailField = form.querySelector('input[type="email"]');
        if (emailField && emailField.value.trim() !== '') {
            if (!isValidEmail(emailField.value.trim())) {
                showError(emailField, 'Veuillez entrer une adresse email valide');
                isValid = false;
            }
        }
        
        // Validate phone format (if present)
        const phoneField = form.querySelector('input[name="phone"]');
        if (phoneField && phoneField.value.trim() !== '') {
            if (!isValidPhone(phoneField.value.trim())) {
                showError(phoneField, 'Veuillez entrer un numéro de téléphone valide');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    // Function to validate individual field
    function validateField(field) {
        // Check if field is required and empty
        if (field.hasAttribute('required') && !field.value.trim()) {
            showError(field, 'Ce champ est obligatoire');
            return false;
        }
        
        // Check email format
        if (field.type === 'email' && field.value.trim() !== '') {
            if (!isValidEmail(field.value.trim())) {
                showError(field, 'Veuillez entrer une adresse email valide');
                return false;
            }
        }
        
        // Check phone format
        if (field.name === 'phone' && field.value.trim() !== '') {
            if (!isValidPhone(field.value.trim())) {
                showError(field, 'Veuillez entrer un numéro de téléphone valide');
                return false;
            }
        }
        
        // Remove error message if field is valid
        const errorMessage = field.nextElementSibling;
        if (errorMessage && errorMessage.classList.contains('error-message')) {
            errorMessage.remove();
        }
        
        field.classList.remove('invalid');
        return true;
    }
    
    // Function to display error message
    function showError(field, message) {
        field.classList.add('invalid');
        
        // Remove existing error message if any
        const existingError = field.nextElementSibling;
        if (existingError && existingError.classList.contains('error-message')) {
            existingError.remove();
        }
        
        // Create and append error message
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('error-message');
        errorMessage.textContent = message;
        
        field.parentNode.insertBefore(errorMessage, field.nextSibling);
    }
    
    // Function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }
    
    // Function to validate phone format (French format)
    function isValidPhone(phone) {
        // Remove spaces and dashes
        const cleanPhone = phone.replace(/[\s-]/g, '');
        
        // French phone number: starts with 0 or +33 followed by 9 digits
        const phoneRegex = /^(0|\+33)[1-9][0-9]{8}$/;
        return phoneRegex.test(cleanPhone);
    }
});
