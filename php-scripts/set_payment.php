<?php
    // Start a session at the beginning of your PHP script:
    session_start();

    // Import pdo.php to make a connection to the database:
    require_once "pdo.php";

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';


    try {
        // Check if form fields have been filled:
        if (isset($_POST['cardholder_name']) && isset($_POST['card_number']) 
            && isset($_POST['expiration_date']) && isset($_POST['CVV']) && isset($_POST['address'])) 
        {
            // Retrieving user ID
            $user_id = $_SESSION['user_id'];

            // Retrieve the address ID from shipping_info table:
            $sql = "SELECT id FROM shipping_info WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':user_id' => $user_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Store that id into address variable
            $address = $row['id'];
        
            $sql = "INSERT INTO payment_info (user_id, cardholder_name, card_number, expiration_date, CVV, address)
                VALUES (:user_id, :cardholder_name, :card_number, :expiration_date, :CVV, :address)";
        
            // Parse the data and prepare the query:
            $stmt = $pdo->prepare($sql);

            // Execute the query into the database:
            $stmt->execute(array(
            ':user_id' => $user_id,
            ':cardholder_name' => $_POST['cardholder_name'],
            ':card_number' => $_POST['card_number'],
            ':expiration_date' => $_POST['expiration_date'],
            ':CVV' => $_POST['CVV'],
            ':address' => $address));
        
            echo "Payment information added successfully.";
            header('Location: ../index.html');
        }
        else 
        {
            echo "Please fill all the fields.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    
    // Close the statement and the connection
    $stmt = null;
    $pdo = null;
?>
