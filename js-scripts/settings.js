document.getElementById('payment-info-btn').addEventListener('click', function() {
    showSection('payment-info');
});

document.getElementById('address-info-btn').addEventListener('click', function() {
    showSection('address-info');
});

document.getElementById('delete-account-btn').addEventListener('click', function() {
    showSection('account-delete');
});

document.getElementById('confirm-delete-account-btn').addEventListener('click', function() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        // Redirect to PHP script to handle account deletion
        window.location.href = 'delete_account.php';
    }
});

function showSection(sectionId) {
    document.querySelectorAll('.content-section').forEach(function(section) {
        section.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';
}
document.getElementById('address-info-btn').addEventListener('click', function() {
    showSection('address-info');
});