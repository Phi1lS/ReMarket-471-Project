<?php
    session_start();
    require_once 'pdo.php';

    if (!isset($_SESSION['id'])) {
        header('Location: login.html');
        exit();
    }

    $user_id = $_SESSION['id'];

    // Fetch user details
    $userQuery = $pdo->prepare("SELECT * FROM user WHERE id = :user_id");
    $userQuery->bindParam(':user_id', $user_id);
    $userQuery->execute();
    $userDetails = $userQuery->fetch(PDO::FETCH_ASSOC);


    if ($userDetails) {
        // Check if profile_pic contains data
        if (!empty($userDetails['profile_pic'])) {
            // Convert BLOB to Base64
            $userDetails['profile_pic'] = base64_encode($userDetails['profile_pic']);
        }
        
        echo json_encode($userDetails);
    } else {
        echo json_encode(['error' => 'No user data found.']);
        exit();
    }
?>