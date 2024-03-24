<?php
require 'pdo.php';

try {
    $sql = "SELECT id, item_name, item_description, cost, contact_name, contact_number, post_date, item_picture FROM item";
    $stmt = $pdo->query($sql);
    
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convert the binary data of 'item_picture' to Base64 for each item
    foreach ($items as $key => $item) {
        if (isset($item['item_picture'])) {
            $items[$key]['item_picture'] = base64_encode($item['item_picture']);
        }
    }

    header('Content-Type: application/json');
    echo json_encode($items);
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Failed to fetch items.']);
}
?>
