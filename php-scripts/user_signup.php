<?php
// Start a session at the beginning of your PHP script:
session_start();

// Import pdo.php to make a connection to the database:
require_once "pdo.php";

// Use isset() to check if fields have been filled in the HTML signup page:
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username'])  
    && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) 
{
    // Write the SQL query to insert user data into the 'user' table:
    $sql = "INSERT INTO user (fname, lname, username, phone, email, password)
            VALUES (:fname, :lname, :username, :phone, :email, :password)";

    // Parse the data and prepare the query:
    $stmt = $pdo->prepare($sql);

    // Execute the query into the database:
    $stmt->execute(array(
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'username' => $_POST['username'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'password' => $_POST['password']));

    // Retrieve the user ID after successful insertion (assuming 'id' is an auto-increment primary key):
    $user_id = $pdo->lastInsertId();

    // Store the user ID in the session:
    $_SESSION['user_id'] = $user_id;

    // Insert the user ID into the 'active_users' table:
    $sql_active_users = "INSERT INTO active_users (user_id) VALUES (:user_id)";
    $stmt_active_users = $pdo->prepare($sql_active_users);
    $stmt_active_users->execute(array('user_id' => $user_id));

    // Redirect the user to the desired page (e.g., index.html):

    header('Location: ../index.html');
    exit;
}

// Check if the user is logged in and has the privilege to delete users (this check could be more sophisticated):
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    
        // Write the SQL query to delete the user from the database:
        $sql = "DELETE FROM active_users WHERE user_id = :user_id";
    
        // Prepare the SQL statement:
        $stmt = $pdo->prepare($sql);
    
        // Bind parameters:
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        // Execute the query:
        if ($stmt->execute()) {
            // Destroy the session and redirect to login page:
            session_destroy();
            header('Location: ../login.html');
            exit;
        } else {
            // Handle errors if the query fails:
            echo "Error deleting user from the database.";
        }
    } else {
        // Redirect the user to the login page if they are not logged in:
        header('Location: ../login.html');
        exit;
    }
    


    
?>
