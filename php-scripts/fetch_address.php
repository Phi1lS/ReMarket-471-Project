<?php
    session_start();
    require_once "pdo.php";

    // Get the user ID from the session
    $user_id = $_SESSION['id'];


    $stmt = $pdo->prepare("SELECT * FROM shipping_info WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $addresses = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $addresses[] = $row;
    }
    echo json_encode($addresses);
?>
