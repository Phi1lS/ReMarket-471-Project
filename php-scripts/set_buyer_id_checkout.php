<?php
// Start session
session_start();
require_once 'pdo.php';

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Select id from user where id == $user_id
$stmt = $pdo->prepare('SELECT id FROM user WHERE id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$selected_id = $stmt->fetchColumn();

// Go through the cart_item table and find where the id that is stored in a variable is equal to user_id in cart_item
$stmt = $pdo->prepare('SELECT id FROM cart_item WHERE user_id = :user_id');
$stmt->execute(array(':user_id' => $user_id));
$cart_item_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Insert the id from user into buyer_id in the item table for each cart item
foreach ($cart_item_ids as $cart_item_id) {
    $stmt = $pdo->prepare('UPDATE item SET buyer_id = :user_id WHERE id = :cart_item_id');
    $stmt->execute(array(':user_id' => $user_id, ':cart_item_id' => $cart_item_id));
}

// Redirect to purchases.html
header('Location: ../purchases.html');
?>
