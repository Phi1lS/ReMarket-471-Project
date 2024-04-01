<?php
session_start();
require_once 'pdo.php'; 

$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = $pdo->prepare("
    SELECT ci.item_id, ci.quantity, ci.total_price, i.item_name, i.item_picture 
    FROM cart_item ci 
    JOIN item i ON ci.item_id = i.id 
    WHERE ci.user_id = ?");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cartItems)) {
    echo json_encode(['message' => 'No items added to cart']);
} else {
    // Encode images in base64
    foreach ($cartItems as $key => $item) {
        if ($item['item_picture']) { // if there is an image
            $cartItems[$key]['item_picture'] = base64_encode($item['item_picture']);
        }
    }
    echo json_encode($cartItems);
}
?>