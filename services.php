<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | Top Star Hotel</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="styles/services.css">
</head>
<body>

<!-- ===== Header ===== -->
<?php
include "header.php";
?>

<!-- ===== Services Section ===== -->
<main class="services-section">
    <div class="services-title">
        <h2>Our Hotel Services</h2>
        <p>Experience comfort, luxury, and world-class hospitality</p>
    </div>

    <div class="services-grid">

        <!-- Accommodation -->
        <div class="service-card">
            <img src="images/services/background014.png" alt="Luxury Rooms">
            <div class="service-content">
                <h4>Luxury Rooms</h4>
                <p>Spacious, clean, and modern rooms designed for your comfort.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background023.png" alt="VIP Suites">
            <div class="service-content">
                <h4>VIP & Presidential Suites</h4>
                <p>Ultra-luxury suites designed for VIPs and high-profile guests.</p>
            </div>
        </div>

        <!-- Dining -->
        <div class="service-card">
            <img src="images/services/background017.png" alt="Fine Dining">
            <div class="service-content">
                <h4>Fine Dining</h4>
                <p>Local and international meals prepared by professional chefs.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background024.png" alt="Rooftop Restaurant">
            <div class="service-content">
                <h4>Rooftop Restaurant</h4>
                <p>Fine dining with breathtaking city views.</p>
            </div>
        </div>

        <!-- Leisure & Wellness -->
        <div class="service-card">
            <img src="images/services/background003.png" alt="Swimming Pool">
            <div class="service-content">
                <h4>Swimming Pool</h4>
                <p>Relax and refresh in our well-maintained pools.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background022.png" alt="Spa">
            <div class="service-content">
                <h4>Spa & Wellness</h4>
                <p>Relax with professional spa and massage services.</p>
            </div>
        </div>


    </div>
    <p class="access_infor">To access all our <span>services kindly</span> <a href="index.php">Login</a></p>
</main>

<!-- ===== Footer ===== -->
<?php
include "footer.php";
?>

<script src="styles/services.js"></script>
</body>
</html>
