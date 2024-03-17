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

let lastScrollY = window.scrollY;
let ticking = false;

function handleScroll() {
  const header = document.querySelector('nav');

  if (window.innerWidth <= 768) { // Adjust 768px according to your needs
    if (lastScrollY < window.scrollY) {
      header.classList.add('nav-hidden');
    } else {
      header.classList.remove('nav-hidden');
    }
  }

  lastScrollY = window.scrollY;
  ticking = false;
}

window.addEventListener('scroll', () => {
  if (!ticking) {
    window.requestAnimationFrame(handleScroll);
    ticking = true;
  }
});

document.addEventListener('DOMContentLoaded', function() {
  let lastScrollTop = 0;
  const header = document.querySelector('nav'); // Adjust this if your header has a different selector
  const breakpoint = 768; // Define mobile device width

  window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (window.innerWidth <= breakpoint) {
      if (scrollTop > lastScrollTop) {
        // Scroll Down
        header.classList.add("translate-up");
        header.classList.remove("translate-down");
      } else {
        // Scroll Up
        header.classList.add("translate-down");
        header.classList.remove("translate-up");
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    }
  }, false);
});
