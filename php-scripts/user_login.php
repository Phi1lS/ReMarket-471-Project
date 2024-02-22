<?php
// error log imports:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// import pdo.php to make connection to DB:
require_once "pdo.php";

// Use isset() to see if the follwoing fields have been entered in HTML:
// 1. Username, 2. Password
if(isset($_POST['username']) && isset($_POST['password'])) 
    {
        // Write the SQL query to check if values (uername/password) exist:
            $sql = "SELECT username, password
            FROM user WHERE username = :username AND password = :password";

        // Prepare the SQL statement:
        $stmt = $pdo->prepare($sql);

        // Execute the SQL statement, passing in the username and password
        $stmt->execute(array(
            ':username' => $_POST['username'],
            ':password' => $_POST['password']
        ));

        // Get the results:
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check the results:
        if($row === false) {
            header('Location: ../login.html');
        }
        else {
            header('Location: ../index.html');
            exit;
        }
    }
?>