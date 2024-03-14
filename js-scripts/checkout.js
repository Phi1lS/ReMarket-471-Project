// Get the checkbox and billing address section
const billingAddressCheckbox = document.getElementById('billing-address');
const billingAddressSection = document.getElementById('billing-address-section');

// Add event listener for when the checkbox changes
billingAddressCheckbox.addEventListener('change', function() {
    // If the checkbox is checked, hide the billing address section
    if (this.checked) {
        billingAddressSection.classList.add('hidden');
    } else {
        // Otherwise, show it
        billingAddressSection.classList.remove('hidden');
    }
});