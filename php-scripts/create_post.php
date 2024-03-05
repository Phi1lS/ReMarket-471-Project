<?php
// Import pdo.php to make a connection to the DB
require_once "pdo.php";
print_r($_POST);
// Picture, Description, Price, Contact_Name, Contact_Number, Date posted:
if (isset($_POST['item_name'], $_FILES['item_picture'], $_POST['item_description'], $_POST['item_price'],
    $_POST['contact_name'], $_POST['contact_number'], $_POST['post_date'])) {

    // Handle the file upload
    $file_name = $_FILES['item_picture']['name'];
    $file_tmp = $_FILES['item_picture']['tmp_name'];
    $file_type = $_FILES['item_picture']['type'];
    $file_size = $_FILES['item_picture']['size'];
    $file_error = $_FILES['item_picture']['error'];

    // Move the uploaded file to your desired location
    if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
        echo "File has been uploaded successfully.";
    } else {
        echo "Failed to move uploaded file. Error: " . $file_error;
    }

    // Retrieve buyer ID (if applicable)
    $buyer_name = $_POST['contact_name']; // Example: Retrieve buyer's name from the form
    // Query the user table to find the buyer's ID based on the name
    $sql = "SELECT id FROM user WHERE fname = :contact_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':buyer_name' => $buyer_name]);
    $buyer_id_row = $stmt->fetch();
    $buyer_id = $buyer_id_row ? $buyer_id_row['id'] : null; // Set to NULL if buyer not found
    // Seller id is the same as buyer id for now:
    $seller_id = $buyer_id;

    // Write SQL Query
    $sql = "INSERT INTO item (item_name, item_picture, item_description, cost, 
    contact_name, contact_number, seller_id, buyer_id, post_date) 
    VALUES (:item_name, :item_picture, :item_description, :cost, 
            :contact_name, :contact_number, :seller_id, :buyer_id, :post_date)";
    

    // Prepare the query
    $stmt = $pdo->prepare($sql);

    // Execute the query
    try {
        $stmt->execute([
        ':item_name' => $_POST['item_name'],
        ':item_picture' => $file_name, // Use the name of the uploaded file
        ':item_description' => $_POST['item_description'],
        ':cost' => $_POST['item_price'],
        ':contact_name' => $_POST['contact_name'],
        ':contact_number' => $_POST['contact_number'],
        ':seller_id' => $seller_id,
        ':buyer_id' => $buyer_id,
        ':post_date' => $_POST['post_date']
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else {
    print_r($_POST);
    echo "Error: didnt pass if block, in else block.";
}

// Query executed successfully
//header('Location: ../index.html');
?>
