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


let lastScrollTop = 0;
let scrollUpDistance = 0;

// Apply smooth transition
header.style.transition = 'top 0.3s';

window.addEventListener('scroll', function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  // Check for mobile view
  if (window.innerWidth <= 768) {
    // Always show the header when at the top of the page
    if (scrollTop <= 0) {
      header.style.top = '0'; // Show the header
      return;
    }

    if (scrollTop > lastScrollTop) {
      // Scrolling down
      header.style.top = `-${header.offsetHeight}px`; // Hide the header
      scrollUpDistance = 0; // Reset scroll up distance
    } else {
      // Scrolling up
      scrollUpDistance += lastScrollTop - scrollTop;
      if (scrollUpDistance > 50) { // The user has scrolled up 50px
        header.style.top = '0'; // Show the header
      }
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
  } else {
    // For desktop, always show the header
    header.style.top = '0';
  }
}, false);




