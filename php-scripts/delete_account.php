<?php
session_start();
require 'pdo.php';  // Make sure this points to your actual PDO connection setup

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: ../login.html');
    exit();
}

$user_id = $_SESSION['user_id'];


// Begin a transaction
$pdo->beginTransaction();


// 2. Delete the user's payment information
$pdo->prepare("DELETE FROM payment_info WHERE user_id = ?")
    ->execute([$user_id]);

// 3. Delete the user's shipping information
$pdo->prepare("DELETE FROM shipping_info WHERE user_id = ?")
    ->execute([$user_id]);

// 4. Remove user from active users
$pdo->prepare("DELETE FROM active_users WHERE user_id = ?")
    ->execute([$user_id]);


// Commit the transaction
$pdo->commit();

// Destroy the session and log the user out
session_destroy();

// Redirect to a confirmation page or home page
header('Location: ../login.html'); // Adjust the redirection URL as necessary
exit();
?>