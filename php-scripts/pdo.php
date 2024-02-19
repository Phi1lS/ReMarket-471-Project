<?php 
// make connection to data base using PDO object
$host = "localhost";
$port = 3306;
$user = "root";
$password = "";
$dbname = "remarket";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>