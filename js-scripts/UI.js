document.querySelector('.cart-icon-container').addEventListener('click', function() {
    var cartDropdown = document.querySelector('.cart-dropdown');
    cartDropdown.style.display = cartDropdown.style.display === 'none' ? 'block' : 'none';
});
document.querySelector('.profile-icon-container').addEventListener('click', function() {
var accountDropdown = document.querySelector('.account-dropdown');
accountDropdown.style.display = accountDropdown.style.display === 'none' ? 'block' : 'none';
});