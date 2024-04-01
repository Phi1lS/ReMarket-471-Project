<?php
// Start the session
session_start();

require_once 'pdo.php'; 

$user_id = $_SESSION['user_id']; // The user's ID
$item_id = $_POST['item_id']; // The ID of the item being removed from the cart

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['item_id'])) {
        $item_id = $_POST['item_id'];
        echo "Item ID: " . $item_id;
    } else {
        echo "Item ID is not set in the POST data.";
    }
}


try {
    // Begin a transaction
    $pdo->beginTransaction();
    
    // Check if the item exists in the user's cart
    $stmt = $pdo->prepare("SELECT * FROM cart_item WHERE user_id = ? AND item_id = ?");
    $stmt->execute([$user_id, $item_id]);
    $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingCartItem) {
        // Delete the item from the cart
        $stmt = $pdo->prepare("DELETE FROM cart_item WHERE user_id = ? AND item_id = ?");
        $stmt->execute([$user_id, $item_id]);

        // Commit the transaction
        $pdo->commit();

        echo "Item removed from cart successfully.";
        header('Location: ../index.html');
    } else {
        echo $item_id;
        echo "Item not found in the cart.";
    }
} catch (PDOException $e) {
    // If we catch an error, roll back the transaction
    $pdo->rollback();

    // Log the exception message
    error_log("Error: " . $e->getMessage());

    // Display a user-friendly message
    echo "An error occurred while removing the item from the cart.";
}
?>
