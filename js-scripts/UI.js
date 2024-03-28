document.addEventListener('DOMContentLoaded', function () {
  const userMenuButton = document.querySelector('#user-menu-button');
  const userMenu = document.querySelector('#user-menu');
  const mobileMenuButton = document.querySelector('#mobile-menu-button');
  const mobileMenu = document.querySelector('#mobile-menu');

  // Ensure that the user menu button and the user menu exist
  if (userMenuButton && userMenu) {
    // Toggle user menu on button click
    userMenuButton.addEventListener('click', function (event) {
      userMenu.classList.toggle('hidden');
      // Stop the click from propagating to the document
      event.stopPropagation();
    });
  }

  // Toggle mobile menu
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function () {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // Close the user menu when clicking outside
  document.addEventListener('click', function (event) {
    // If the click is outside the userMenu and not on the userMenuButton, hide the userMenu
    if (userMenu && !userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
      userMenu.classList.add('hidden');
    }
  });

  // Prevent menu from closing when clicking inside
  if (userMenu) {
    userMenu.addEventListener('click', function (event) {
      event.stopPropagation();
    });
  }
});


  // JavaScript for toggling the slide-over shopping cart
  document.addEventListener('DOMContentLoaded', function () {
    const cartIcon = document.querySelector('.fa-shopping-cart'); // Replace with the correct selector for your cart icon
    const shoppingCart = document.getElementById('shopping-cart');
    const closeButton = shoppingCart.querySelector('button'); // Adjust if there are multiple buttons
    const body = document.body;

    // Function to show the cart and disable body scroll
    function showCart() {
        shoppingCart.classList.remove('hidden');
        body.style.overflow = 'hidden'; // Disable scrolling
    }

    // Function to hide the cart and enable body scroll
    function hideCart() {
        shoppingCart.classList.add('hidden');
        body.style.overflow = ''; // Re-enable scrolling
    }

    // Show cart when cart icon is clicked
    cartIcon.addEventListener('click', showCart);

    // Hide cart when close button is clicked
    closeButton.addEventListener('click', hideCart);

    // Hide cart if clicked outside of the cart (optional)
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
  if (window.innerWidth <= 768 || window.innerHeight <= 768) {
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