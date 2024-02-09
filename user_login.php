<?php
// This is all placeholder code for now until it's covered in class
// Placeholder for login logic
if (isset($_POST['login'])) {
    // TODO: Logic to check credentials

    // Redirect to the home page for now
    header('Location: index.html');
    exit();
}

// If the form wasn't submitted, redirect to the login form
header('Location: login.html');
exit();
?>