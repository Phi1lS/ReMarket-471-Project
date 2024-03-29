<?php 
    // Start a session at the beginning of your PHP script:
    session_start();

    // Import pdo.php to make a connection to the database:
    require_once "pdo.php";

    if (isset($_POST['name']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) 
        && isset($_POST['zip']) && isset($_POST['country'])) 
    {
        // Retrieving user ID
        $user_id = $_SESSION['id'];
    
        $sql = "INSERT INTO shipping_info (user_id, name, street, city, state, zip, country)
            VALUES (:user_id, :name, :street, :city, :state, :zip, :country)";
    
        // Parse the data and prepare the query:
        $stmt = $pdo->prepare($sql);

         // Execute the query into the database:
        $stmt->execute(array(
        'user_id' => $user_id,
        'name' => $_POST['name'],
        'street' => $_POST['street'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'zip' => $_POST['zip'],
        'country' => $_POST['country']));
    
        echo "Shipping information added successfully.";
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