document.addEventListener('DOMContentLoaded', function () {
  // Toggle for profile dropdown
  const userMenuButton = document.querySelector('#user-menu-button');
  const userMenu = document.querySelector('#user-menu');

  userMenuButton.addEventListener('click', function () {
    userMenu.classList.toggle('hidden');
  });

  // Toggle for mobile menu
  const mobileMenuButton = document.querySelector('#mobile-menu-button');
  const mobileMenu = document.querySelector('#mobile-menu');

  mobileMenuButton.addEventListener('click', function () {
    mobileMenu.classList.toggle('hidden');
  });
});

document.addEventListener('click', function (event) {
  if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
    userMenu.classList.add('hidden');
  }
});

  // JavaScript for toggling the slide-over shopping cart
  document.addEventListener('DOMContentLoaded', function () {
      const cartIcon = document.querySelector('.fa-shopping-cart'); // Replace with the correct selector for your cart icon
      const shoppingCart = document.getElementById('shopping-cart');
      const closeButton = shoppingCart.querySelector('button'); // Assuming there is only one button inside the slide-over for closing it

      // Function to show the cart
      function showCart() {
          shoppingCart.classList.remove('hidden');
      }

      // Function to hide the cart
      function hideCart() {
          shoppingCart.classList.add('hidden');
      }

      // Show cart when cart icon is clicked
      cartIcon.addEventListener('click', showCart);

      // Hide cart when close button is clicked
      closeButton.addEventListener('click', hideCart);

      // Hide cart if clicked outside of the cart
      window.addEventListener('click', function (event) {
          if (!shoppingCart.contains(event.target) && event.target !== cartIcon) {
              hideCart();
          }
      });
  });
  function toggleDropdown() {
      var dropdown = document.getElementById("user-menu");
      dropdown.classList.toggle("hidden");
  }

  function toggleMobileMenu() {
      var menu = document.getElementById("mobile-menu");
      if (menu) {
          menu.classList.toggle("hidden");
          menu.classList.toggle("-translate-x-full");
      }
  }
  
  // Select the header element
const header = document.querySelector('nav');

// Function to prevent double-tap zoom
function preventDoubleTapZoom(event) {
if (event.touches.length > 1) {
  event.preventDefault();
}
}

// Add event listener to the header
header.addEventListener('touchstart', preventDoubleTapZoom, { passive: false });
