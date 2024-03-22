<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Ensure session is started
require 'pdo.php'; 

// Get user_id from session:
$user_id = $_SESSION['user_id'];

// Check if fields in HTML have been set:
if (isset($_POST['fname'], $_POST['lname'], $_POST['description'])) {
    
    // Write SQL query:
    $sql = "UPDATE `user` SET 
            `fname` = :fname,
            `lname` = :lname,
            `description` = :description
            WHERE `id` = (
                SELECT `user_id` FROM `active_users` WHERE `user_id` = :user_id
            )";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fname', $_POST['fname']);
    $stmt->bindParam(':lname', $_POST['lname']);
    $stmt->bindParam(':description', $_POST['description']);
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

