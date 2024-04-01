<?php
    session_start();
    require_once 'pdo.php';

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.html');
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user details
    $userQuery = $pdo->prepare("SELECT city, country FROM shipping_info WHERE user_id = :user_id");
    $userQuery->bindParam(':user_id', $user_id);
    $userQuery->execute();
    $userDetails = $userQuery->fetch(PDO::FETCH_ASSOC);


    echo json_encode($userDetails);
?>