<?php
// Start the session
session_start();

require_once 'pdo.php'; 

$user_id = $_SESSION['id']; // The user's ID
$item_id = $_POST['item_id']; // The ID of the item being added to the cart
$quantity = $_POST['quantity']; // The quantity of the item being added to the cart

try {
    // Begin a transaction
    $pdo->beginTransaction();
    
    // Fetch the item's price from the database using the item ID
    $stmt = $pdo->prepare("SELECT cost FROM item WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Check if the item already exists in the user's cart
        $stmt = $pdo->prepare("SELECT * FROM cart_item WHERE user_id = ? AND item_id = ?");
        $stmt->execute([$user_id, $item_id]);
        $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCartItem) {
            // Calculate the new quantity and total price
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $newTotalPrice = $item['cost'] * $newQuantity;

            // Update the existing cart item
            $stmt = $pdo->prepare("UPDATE cart_item SET quantity = ?, total_price = ? WHERE user_id = ? AND item_id = ?");
            $stmt->execute([$newQuantity, $newTotalPrice, $user_id, $item_id]);
        } else {
            // Calculate the total price
            $totalPrice = $item['cost'] * $quantity;

            // Insert the new cart item
            $stmt = $pdo->prepare("INSERT INTO cart_item (user_id, item_id, quantity, total_price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $item_id, $quantity, $totalPrice]);
        }

        // Commit the transaction
        $pdo->commit();

        echo "Cart updated successfully.";
    } else {
        echo "Item not found.";
    }
} catch (PDOException $e) {
    // If we catch an error, roll back the transaction
    $pdo->rollback();

    // Log the exception message
    error_log("Error: " . $e->getMessage());

    // Display a user-friendly message
    echo "An error occurred while updating the cart.";
}
?>