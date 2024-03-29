<?php
require 'pdo.php';

// Retrieve the search term from the form submission
$searchTerm = $_POST['search_term']; // Use 'search_term' instead of 'item'

try {
    $stmt = $pdo->prepare("SELECT * FROM item WHERE item_name LIKE :searchTerm");
    $stmt->execute(['searchTerm' => "%$searchTerm%"]); // Use named placeholders

    if ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item['item_picture'] = base64_encode($item['item_picture']); // Convert BLOB to base64
        echo json_encode($item);
    } else {
        echo json_encode(['notFound' => true]); // Indicate that item is not found
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
