<?php
// Below is the file that makes teh connection to the database:
require_once "pdo.php";
// The 'if isset' is checking if the blanks where the user is supposed to 
//      fill in data (name, email and password) is indeed filled in.
// * Ex: if user doesnt enter email, isset == false *
if(isset($_POST['name']) && isset($_POST['email'])
    && isset($_POST['password'])) 
    {
        // The following code deals with the incoming $_POST data
        // ex: when you type in your name in the webpage, :name recieves whatever is typed in.
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";
        echo("<pre>\n" . $sql . "\n</pre>\n");
        // Parse the data from above, and prepare it. 
        // It tells the database server to expect a certain type of query with placeholders for variables.
        $stmt = $pdo->prepare($sql);
        // match the placeholder data with the POST data:

        // execute() sends the prepared SQL statement to the database server for execution along with 
        // any parameters that have been bound to placeholders in the SQL statement.
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']));
    }
    ?>
    <html>
        <head></head>
    <body>
    <p>Add a new User</p>
    <form method="post">
        <p>Name:<input type"text" name=name size="40px"></p>
        <p>Email:<input type="text" name=email></p>
        <p>Password:<input type="pasword" name=password></p>
        <p><input type="submit" value="Add New"/></p>
    </form>
    </body>
