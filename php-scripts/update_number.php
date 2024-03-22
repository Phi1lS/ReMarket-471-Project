<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Ensure session is started
require 'pdo.php'; 

// Get user_id from session:
$user_id = $_SESSION['user_id'];

// Check if fields in HTML have been set:
if (isset($_POST['phone'])) {
    
    // Write SQL query:
    $sql = "UPDATE `user` SET 
            `phone` = :phone
            WHERE `id` = (
                SELECT `user_id` FROM `active_users` WHERE `user_id` = :user_id
            )";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':user_id', $_SESSION['user_id']); // Assuming you have a session variable for user id

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../settings.html");
        exit;
    } else {
        echo "Error updating user information.";
    }
} else {
    echo "Not all fields are set.";
}
?>

