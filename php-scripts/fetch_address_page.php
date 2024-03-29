<?php
// Start a session at the beginning of your PHP script:
session_start();

// Include the database connection file
require_once 'pdo.php';

// Get user_id:
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM shipping_info WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$addresses = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $addresses[] = $row;
}
echo json_encode($addresses);
?>

