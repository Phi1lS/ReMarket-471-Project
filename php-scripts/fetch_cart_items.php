<?php
// Import pdo.php to make a connection to the database:
require_once "pdo.php";

// Start a session at the beginning of your PHP script:
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Prepare SQL statement to fetch cart items for the user
$sql = "SELECT ci.quantity, i.item_name, i.item_description, i.item_picture, i.cost 
        FROM cart_item ci 
        INNER JOIN item i ON ci.item_id = i.id 
        WHERE ci.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$cart_items = $stmt->fetchAll();

// Convert the binary data of 'item_picture' to Base64 for each item
foreach ($cart_items as $key => $item) {
    if (isset($item['item_picture'])) {
        $cart_items[$key]['item_picture'] = base64_encode($item['item_picture']);
    }
}

// Output the selected items
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Cart Items</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; }";
echo ".item { border: 1px solid #ddd; margin-bottom: 20px; padding: 10px; }";
echo ".item img { max-width: 200px; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>Selected Items:</h1>";
foreach ($cart_items as $item) {
    echo "<div class='item'>";
    echo "<h2>" . $item['item_name'] . "</h2>";
    echo "<p>" . $item['item_description'] . "</p>";
    echo "<p><strong>Quantity:</strong> " . $item['quantity'] . "</p>";
    echo "<p><strong>Cost:</strong> $" . $item['cost'] . "</p>";
    // Check if item_picture exists
    if (!empty($item['item_picture'])) {
        // Encode the image data to Base64
        $imageData = base64_encode($item['item_picture']);
        // Display the image
        echo '<img src="data:image/png;base64,'.$imageData.'" alt="'.$item['item_name'].'">';
    }
    echo "</div>";
}
echo "</body>";
echo "</html>";
?>
