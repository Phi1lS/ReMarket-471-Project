<?php
// Start a session at the beginning of your PHP script:
session_start();

// Import pdo.php to make a connection to the database:
require_once "pdo.php";

// Use isset() to check if the following fields have been entered in HTML:
// 1. Username, 2. Password
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Write the SQL query to check if values (username/password) exist:
    $sql = "SELECT id, username, password FROM user WHERE username = :username AND password = :password";

    // Prepare the SQL statement:
    $stmt = $pdo->prepare($sql);

    // Execute the SQL statement, passing in the username and password:
    $stmt->execute(array(
        ':username' => $_POST['username'],
        ':password' => $_POST['password']
    ));

    // Get the results:
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check the results:
    if ($row === false) {
        // Redirect to the login page if login fails:
        header('Location: ../login.html');
        exit;
    } else {
        // Store the user ID in the session:
        $_SESSION['id'] = $row['id'];

        // Insert the user into the active users table
        $sql = "INSERT INTO active_users (user_id) VALUES (:user_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':user_id' => $row['id']
        ));

        // Redirect to the index page (or any other desired page):
        header('Location: ../index.html');
        exit;
    }
}
?>

