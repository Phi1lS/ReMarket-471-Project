<?php
// Start a session at the beginning of your PHP script:
session_start();

// Include the database connection file
require_once 'pdo.php';

// Get user_id:
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT cardholder_name, card_number, expiration_date, CVV, address FROM payment_info WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$paymentInfo = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $paymentInfo[] = $row;
}
echo json_encode($paymentInfo);
?>

