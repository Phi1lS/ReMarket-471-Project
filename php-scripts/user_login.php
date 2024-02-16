<?php
// import pdo.php to make connection to DB:
require_once "pdo.php";
// use iffset() to see if fields have been filled in the HTML signup page:
if(isset($_POST['fname']) && isset($_POST_['lname']) && isset($_POST_['username'])  
            && isset($_POST_['phone'])  && isset($_POST_['email'])  
            && isset($_POST_['password'])) 
        {
            // Write teh SQL query:
            $sql = "INSERT INTO user (fname, lname, username, phone, email, password)
                    VALUES (:fname, :lname, :username, :phone, :email, :password)";

            // Parse the data from above and prepare it:
            $stmt = $pdo->prepare($sql);

            // Execute the Query into the DB:
            $stmt->execute(array(
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'username' => $_POST['username'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password']));
        }
    // Pray that it works lmao
?>