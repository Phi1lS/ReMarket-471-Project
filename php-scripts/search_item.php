<?php
session_start(); // Ensure session is started
require 'pdo.php'; // Assuming you have a PDO database connection established

// Retrieve the search term from the form submission
$searchTerm = $_POST['search_term']; // Use 'search_term' instead of 'item'

// Execute the query
$stmt = $pdo->prepare("SELECT id, item_name FROM item WHERE item_name LIKE :searchTerm");
$stmt->execute(['searchTerm' => "%$searchTerm%"]); // Use named placeholders

// Process the search results
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Display item details (e.g., item_name, item_description, etc.)
    echo '<p>' . 'item id: '. $row['id'] . '<br>' . 'Item Name: ' . $row['item_name'] . '</p>';
    // ... other fields
}
?>
