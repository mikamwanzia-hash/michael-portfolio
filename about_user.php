<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Top Star Hotel</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="styles/about.css">

    <!-- Page-specific styles -->
  
</head>
<body>

<!-- ===== Header ===== -->
<?php
include "loggedin_user_header.php";
?>

<!-- ===== About Content ===== -->
<main class="about-section">
    <div class="about-card">
        <h2>About Top Star Hotel</h2>

        <p>
            Welcome to <strong>Top Star Hotel</strong>, a luxury and comfort-focused hotel
            located in the heart of Nairobi. We are committed to delivering exceptional
            hospitality, world-class services, and unforgettable guest experiences.
        </p>

        <p>
            Our hotel combines modern elegance with African warmth, offering beautifully
            designed rooms, fine dining, conference facilities, swimming pools, and
            personalized services for both leisure and business travelers.
        </p>

        <p>
            At Top Star Hotel, your comfort is our priority. From 24/7 customer support
            to top-tier security and cleanliness, we ensure your stay is safe, relaxing,
            and memorable.
        </p>

        <div class="features">
            <div class="feature-box">
                <h4>Luxury Rooms</h4>
                <p>Modern, clean, and comfortable rooms designed for relaxation.</p>
            </div>

            <div class="feature-box">
                <h4>Fine Dining</h4>
                <p>Enjoy delicious local and international cuisines prepared by experts.</p>
            </div>

            <div class="feature-box">
                <h4>Swimming Pools</h4>
                <p>Relax and refresh in our clean and well-maintained pools.</p>
            </div>

            <div class="feature-box">
                <h4>24/7 Support</h4>
                <p>Our staff is always available to serve you at any time.</p>
            </div>
        </div>
    </div>
</main>

<!-- ===== Footer ===== -->
<?php
include "footer.php";
?>

<script src="styles/services.js"></script>
</body>
</html>
