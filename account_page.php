<?php
session_start();
require_once 'php-scripts/pdo.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['id'];

// Fetch user details
$userQuery = $pdo->prepare("SELECT fname, lname, username, profile_pic FROM user WHERE id = ?");
$userQuery->execute([$user_id]);
$user = $userQuery->fetch();

// Set profile picture for display
$defaultProfilePic = 'other-images/default_profile_pic.jpg'; // Fallback to a default picture
$profilePictureToShow = !empty($user['profile_pic']) ? 'data:image/jpeg;base64,' . base64_encode($user['profile_pic']) : $defaultProfilePic;

// User reviews fetching code would go here.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page - ReMarket</title>
    <link rel="stylesheet" href="./stylesheets/styles-account.css"> <!-- Link to your stylesheet -->
    <link rel="stylesheet" href="./stylesheets/styles-home.css">
    <!--Font Awesome icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body>
    <!--Header information-->
    <div class="header">
        <a href="index.html">
            <img src="./logo/logo.png" alt="ReMarket Logo" class="site-logo">
        </a>

        <div class="search-container">
            <input type="text" placeholder="Search for anything">
        </div>

        <div class="cart-icon-container">
            <i class="fas fa-shopping-cart"></i>
        </div>

        <div class="profile-icon-container">
            <!--PLACEHOLDER TEMPORARY IMAGE. DEFAULT PROFILE PIC UNTIL PHP IS ADDED.-->
            <!--TODO: Add PHP to query the user's profile picture based on their primary key (user id) and display it dynamically with HTML-->
            <img src="<?php echo htmlspecialchars($profilePictureToShow); ?>" alt="Profile" class="profile-icon">
            <!-- Account dropdown -->
            <div class="account-dropdown" style="display: none;">
                <a href="account_page.html">Account Page</a>
                <a href="purchases.html">Purchases</a>
                <a href="settings.html">Settings</a>
            </div>
        </div>
    </div>
    <div class="nav-bar">
        <nav>
            <!-- 
            <a href="index.php">Home</a>
            <a href="create_post.php">Create New Post</a>
            <a href="add_payment.php">Add Payment</a>
            <a href="logout.php">Logout</a> 
            -->
            <a href="index.html">Home</a>
            <a href="create_post.html">Create New Post</a>
        </nav>
    </div>
    <!--END Header information-->

    <main class="account-container">
        <section class="profile-section">
                <img src="<?php echo htmlspecialchars($profilePictureToShow); ?>" alt="Profile Picture" class="profile-picture">
                <h2><?php echo htmlspecialchars($user['fname']) . ' ' . htmlspecialchars($user['lname']); ?></h2>
                <p class="user-description">Username: <?php echo htmlspecialchars($user['username']); ?></p>
                <!-- Form for updating profile picture -->
                <form id="change-picture-form" action="php-scripts/upload_profile_pic.php" method="POST" enctype="multipart/form-data">
                    <input type="file" id="profile-picture-input" name="profile_picture">
                    <input type="submit" value="Update Picture">
                </form>
        </section>

        <section class="reviews-section">
            <h3>User Reviews</h3>
            <!-- User reviews will be loaded here -->
            <!-- TODO: Use PHP to display reviews from database-->
        </section>

        <section class="review-form-section">
            <h3>Leave a Review</h3>
            <form id="submit-review-form">
                <div class="star-rating-input">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                </div>
                <textarea id="review-text" name="review_text" required></textarea>
                <input type="submit" value="Submit Review">
                <!-- TODO: Use PHP to submit reviews to database -->
            </form>
        </section>

        <section class="user-listings">
            <h2>User Listings</h2>
            <!-- TODO: Use PHP to  display listings from database -->
        </section>
    </main>

    <div class="cart-dropdown" style="display: none;">
        <!--TODO: Use PHP to read and display cart items in dropdown -->
        <!--TODO: Use PHP to check if there are cart items in the database. If there are none, display "No items are in your cart!"-->
        <!--This is TEMPORARY. REMOVE THIS WHEN PHP IS ADDED--> No items are in your cart!
        <div class="cart-dropdown-footer">
            <a href="checkout.html" class="checkout-button">Go to Checkout</a>
        </div>
    </div>

    <script src="js-scripts/ui.js"></script>
    <script src="js/account.js"></script> <!-- Link to your JavaScript file -->
</body>
</html>
