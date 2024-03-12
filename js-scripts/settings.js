document.addEventListener('DOMContentLoaded', () => {
    // Adding click event listeners to all tabs
    document.querySelectorAll('.flex.border-b.border-gray-700.mb-6 a').forEach(tab => {
        tab.addEventListener('click', (event) => {
            event.preventDefault();  // Prevent default anchor link behavior

            // Get the href attribute of the clicked tab, which contains the ID of the content to show
            const contentId = tab.getAttribute('href').substring(1);  // Remove the '#' from the href value

            // Hide all content sections
            document.querySelectorAll('.settings-content').forEach(content => {
                content.style.display = 'none';
            });

            // Show the content section that corresponds to the clicked tab
            const contentToShow = document.getElementById(contentId);
            if (contentToShow) {
                contentToShow.style.display = 'block';
            }
            
            // Update tab active state if needed
            // Remove active class from all tabs
            document.querySelectorAll('.flex.border-b.border-gray-700.mb-6 a').forEach(t => {
                t.classList.remove('active');  // Assume 'active' class changes the appearance of the active tab
            });

            // Add active class to the clicked tab
            tab.classList.add('active');
        });
    });
});

function toggleEditPaymentMethodForm() {
    var form = document.getElementById("edit-payment-method-form");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function toggleAddPaymentMethodForm() {
    var form = document.getElementById("add-payment-method-form");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Function to toggle the display of the Add Address form
function toggleAddAddressForm() {
    const form = document.getElementById("add-address-form");
    form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
}

// Function to toggle the display of the Edit Address form with pre-filled data
function toggleEditAddressForm(addressId) {
    const form = document.getElementById("edit-address-form");
    if (form.style.display === 'block' && form.getAttribute('data-current-address-id') === addressId.toString()) {
        form.style.display = 'none';
        form.removeAttribute('data-current-address-id');
    } else {
        // Assume getAddressDetails is a function to get address details by ID
        const addressDetails = getAddressDetails(addressId);
        
        // Fill the form with the address details
        document.getElementById("edit-address-id").value = addressId;
        document.getElementById("edit-name").value = addressDetails.name;
        document.getElementById("edit-street").value = addressDetails.street;
        document.getElementById("edit-city").value = addressDetails.city;
        // Populate other fields...

        // Show the form
        form.style.display = 'block';
        form.setAttribute('data-current-address-id', addressId.toString());
    }
}

// Function to handle saving edited address (same as before)
function saveEditedAddress() {
    // Get form data
    const addressId = document.getElementById("edit-address-id").value;
    const name = document.getElementById("edit-name").value;
    const street = document.getElementById("edit-street").value;
    const city = document.getElementById("edit-city").value;
    // Retrieve other fields...

    // Assume updateAddress is a function to update the address details
    updateAddress(addressId, { name, street, city /*, other fields*/ });

    // Hide the form after saving
    document.getElementById("edit-address-form").style.display = 'none';
}

function toggleEditAddressForm(addressId) {
    const form = document.getElementById("edit-address-form");
    const currentAddressId = form.getAttribute('data-current-address-id');

    // Check if the form is already open for the same address
    if (form.style.display === 'block' && currentAddressId === addressId.toString()) {
        form.style.display = 'none';
        form.removeAttribute('data-current-address-id');
    } else {
        // Populate the form with details of the address to be edited
        const addressDetails = getAddressDetails(addressId); // Replace with actual function to fetch address details
        
        document.getElementById("edit-address-id").value = addressId;
        document.getElementById("edit-name").value = addressDetails.name;
        document.getElementById("edit-street").value = addressDetails.street;
        document.getElementById("edit-city").value = addressDetails.city;
        // Populate other fields as needed...

        form.style.display = 'block';
        form.setAttribute('data-current-address-id', addressId.toString());
    }
}

function getAddressDetails(addressId) {
    // This function should return the address details for a given address ID
    // Replace this with your actual logic to fetch address details (May need to be replaced by a PHP function)
    return {
        name: "John Doe",
        street: "123 Main St",
        city: "Anytown",
        // Include other fields as necessary
    };
}

function previewAvatar() {
    var file = document.getElementById('avatar-upload').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        document.getElementById('avatar-image').src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById('avatar-image').src = "";
    }
}