<?php
require 'pdo.php';

// Get the item ID from the query string
$itemId = $_GET['id'] ?? null;

if ($itemId) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM item WHERE id = :id");
        $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
        $stmt->execute();

        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $item['item_picture'] = base64_encode($item['item_picture']); // Convert BLOB to base64
            echo json_encode($item);
        } else {
            echo json_encode(['error' => 'Item not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No item ID provided']);
}