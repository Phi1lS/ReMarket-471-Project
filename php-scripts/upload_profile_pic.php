<?php
session_start(); // Ensure session is started
require 'pdo.php'; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the file upload is set
if (!isset($_FILES['profile_picture'])) {
    echo "No file uploaded.";
    exit();
}

$profile_picture = $_FILES['profile_picture'];
$maxFileSize = 5 * 1024 * 1024; // 5 MB
$allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];

// Check if the file exceeds the maximum file size
if ($profile_picture['size'] > $maxFileSize) {
    echo "File size exceeds the maximum limit of 5 MB.";
    exit();
}

// Check if the file type is allowed
if (!in_array($profile_picture['type'], $allowedFileTypes)) {
    echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
    exit();
}

// Read the contents of the uploaded file
$imageContent = file_get_contents($profile_picture["tmp_name"]);

if ($imageContent === false) {
    echo "An error occurred reading the uploaded file.";
    exit();
}

// Prepare the query to update the user's profile picture
$query = "UPDATE user SET profile_pic = ? WHERE id = ?";
$stmt = $pdo->prepare($query);

// Execute the query with the binary content of the image
if ($stmt->execute([$imageContent, $user_id])) {
    echo "Profile picture updated successfully.";
    header('Location: ../settings.html?success=true');
} else {
    echo "Error updating profile picture in the database.";
    //redirect back to the profile page or another appropriate page with an error message
    header('Location: ../settings.html');
}
?>