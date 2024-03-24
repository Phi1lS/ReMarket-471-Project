<?php
session_start();
require 'pdo.php';

// Check if the user is logged in and the file upload is set
if (!isset($_SESSION['id'], $_FILES['file-upload']) || $_FILES['file-upload']['error'] != UPLOAD_ERR_OK) {
    echo "Error: Missing user session or file upload issue.";
    exit();
}

$user_id = $_SESSION['id'];

// Fetch user details from the 'user' table
$userQuery = $pdo->prepare("SELECT fname, lname, phone FROM user WHERE id = :user_id");
$userQuery->bindParam(':user_id', $user_id);
$userQuery->execute();
$userDetails = $userQuery->fetch();

if (!$userDetails) {
    echo "Error: User details not found.";
    exit();
}

// Combine first name and last name for contact_name
$contact_name = $userDetails['fname'] . ' ' . $userDetails['lname'];
$contact_number = $userDetails['phone'];



// Assuming file validation and reading content is successful
$imageContent = file_get_contents($_FILES['file-upload']['tmp_name']);

// Prepare and execute SQL to insert the new item
$sql = "INSERT INTO item (item_name, item_picture, item_description, cost, contact_name, contact_number, seller_id, post_date) 
        VALUES (:item_name, :item_picture, :item_description, :cost, :contact_name, :contact_number, :seller_id, NOW())";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    ':item_name' => $_POST['item_name'], 
    ':item_picture' => $imageContent, 
    ':item_description' => $_POST['item_description'], 
    ':cost' => $_POST['item_price'], 
    ':contact_name' => $contact_name,
    ':contact_number' => $contact_number,
    ':seller_id' => $user_id,
]);

echo "Item posted successfully.";
header('Location: ../index.html')

?>
