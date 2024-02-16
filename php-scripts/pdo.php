<?php 
// make connection to data base using PDO object
try {
    $pdo = new PDO('mysql:host=demodatabase471.c9as2uq8gw4v.us-east-1.rds.amazonaws.com;port=3306;dbname=demoDatabase471','admin','Password123');
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>