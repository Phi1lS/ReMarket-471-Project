<?php
    session_start();
    require_once "pdo.php";

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];


    $stmt = $pdo->prepare("SELECT cardholder_name, card_number, CVV FROM payment_info WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $paymentInfo = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $paymentInfo[] = $row;
    }
    echo json_encode($paymentInfo);
?>
