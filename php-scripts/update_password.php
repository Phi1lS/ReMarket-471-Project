<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Ensure session is started
require 'pdo.php'; 

// Get user_id from session:
$user_id = $_SESSION['id'];

// Check if fields in HTML have been set:
if (isset($_POST['password'], $_POST['newPassword'], $_POST['newPasswordConfirm'])) {
    // Verify if new password and confirm new password match
    if ($_POST['newPassword'] !== $_POST['newPasswordConfirm']) {
        echo "New password and confirm new password do not match.";
        exit;
    }
    
    // Write SQL query:
    $sql = "UPDATE `user` SET 
            `password` = :newPassword
            WHERE `id` = (
                SELECT `user_id` FROM `active_users` WHERE `user_id` = :user_id
            ) AND `password` = :password";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':newPassword', $_POST['newPassword']);
    $stmt->bindParam(':user_id', $_SESSION['user_id']); // Assuming you have a session variable for user id
    $stmt->bindParam(':password', $_POST['password']);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../settings.html");
        exit;
    } else {
        echo "Error updating password.";
    }
} else {
    echo "Not all fields are set.";
}
?>
