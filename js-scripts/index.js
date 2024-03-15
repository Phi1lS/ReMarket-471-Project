document.addEventListener('DOMContentLoaded', function() {
    const greetings = ["Welcome!", "Hello!", "Greetings!", "What's New?", "Discover!", "Explore!", "Welcome Back!"];
    const greeting = greetings[Math.floor(Math.random() * greetings.length)];
    document.getElementById('greeting').textContent = greeting;
  });