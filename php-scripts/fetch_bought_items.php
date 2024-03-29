<?php
// Start the session and include your database connection script
session_start();
require_once 'pdo.php'; 

$user_id = $_SESSION['id']; 

try {
    // Query to fetch bought items
    $stmt = $pdo->prepare("SELECT id, item_name, item_picture, cost, contact_name, contact_number, post_date FROM item WHERE buyer_id = ?");
    $stmt->execute([$user_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convert image blob to base64
    foreach ($items as $key => $item) {
        if ($item['item_picture']) {
            $items[$key]['item_picture'] = base64_encode($item['item_picture']);
        }
    }

    echo json_encode($items); // Encode the result as JSON
} catch (Exception $e) {
    // Handle exception
    echo json_encode(['error' => 'Failed to fetch bought items']);
}
?>