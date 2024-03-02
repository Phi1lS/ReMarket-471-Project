<?php
// Import pdo.php to make a connection to the DB
require_once "pdo.php";


// Picture, Description, Price, Contact_Name, Contact_Number, Date posted:
if (isset($_POST['item_picture'], $_POST['item_description'], $_POST['item_price'],
    $_POST['contact_name'], $_POST['contact_number'], $_POST['post_date'])) {

    // Retrieve buyer ID (if applicable)
    $buyer_name = $_POST['contact_name']; // Example: Retrieve buyer's name from the form
    // Query the user table to find the buyer's ID based on the name
    $sql = "SELECT id FROM user WHERE fname = :contact_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':buyer_name' => $buyer_name]);
    $buyer_id_row = $stmt->fetch();
    $buyer_id = $buyer_id_row ? $buyer_id_row['id'] : null; // Set to NULL if buyer not found
    // Seller id is the same as buyer id for now:
    $seller_id = $buyer_id;

    // Get date time:
    $current_datetime = date('Y-m-d H:i:s');

    // Write SQL Query
    $sql = "INSERT INTO item (item_picture, item_description, cost, 
    contact_name, contact_number, seller_id, buyer_id, time_posted) 
    VALUES (:item_picture, :item_description, :cost, 
            :contact_name, :contact_number, :seller_id, :buyer_id, :current_datetime)";
    

    // Prepare the query
    $stmt = $pdo->prepare($sql);

    // Execute the query
    $stmt->execute([
    ':item_picture' => $_POST['item_picture'],
    ':item_description' => $_POST['item_description'],
    ':cost' => $_POST['item_price'],
    ':contact_name' => $_POST['contact_name'],
    ':contact_number' => $_POST['contact_number'],
    ':seller_id' => $seller_id,
    ':buyer_id' => $buyer_id,
    ':post_date' => $current_datetime
    ]);
    }


    // Query executed successfully
    header('Location: ../index.html');
?>