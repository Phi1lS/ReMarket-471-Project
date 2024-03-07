<?php
    // Start a session at the beginning of your PHP script:
session_start();

// Import pdo.php to make a connection to the database:
require_once "pdo.php";

// Check if form fields have been filled:
    if (isset($_POST['cardholder_name']) && isset($_POST['card_number']) && isset($_POST['expiration_date']) && isset($_POST['CVV'])) 
    {
        // Retrieving user ID
        $user_id = $_SESSION['user_id'];
    
        $sql = "INSERT INTO payment_info (user_id, cardholder_name, card_number, expiration_date, CVV)
            VALUES (:user_id, :cardholder_name, :card_number, :expiration_date, :CVV)";
    
        // Parse the data and prepare the query:
        $stmt = $pdo->prepare($sql);

         // Execute the query into the database:
        $stmt->execute(array(
        'user_id' => $user_id,
        'cardholder_name' => $_POST['cardholder_name'],
        'card_number' => $_POST['card_number'],
        'expiration_date' => $_POST['expiration_date'],
        'CVV' => $_POST['CVV']));
    
        echo "Payment information added successfully.";
    }
    else 
    {
        echo "Please fill all the fields.";
    }
    
    // Close the statement and the connection
    $stmt = null;
    $pdo = null;
    header('Location: ../index.html');
?>