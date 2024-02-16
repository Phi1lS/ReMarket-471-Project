<?php 
// make connection to data base using PDO object
// $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'nhalash', '20012766');


$host="demodatabase471.c9as2uq8gw4v.us-east-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="admin";
$password="";
$dbname="testDB";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
