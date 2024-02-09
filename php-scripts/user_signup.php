<?php
// This is all placeholder code for now until it's covered in class
// Placeholder for signup logic
if (isset($_POST['signup'])) {
    // TODO: Logic to handle signup

    // Redirect to the login page for now
    header('Location: login.html');
    exit();
}

// If the form wasn't submitted, redirect to the signup form
header('Location: signup.html');
exit();
?>
