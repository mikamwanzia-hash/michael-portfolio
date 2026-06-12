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
    <title>Our Services | Top Star Hotel</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="styles/services.css">
</head>
<body>

<!-- ===== Header ===== -->
<?php
include "loggedin_user_header.php"
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

        <div class="service-card">
            <img src="images/services/background018.png" alt="Gym">
            <div class="service-content">
                <h4>Fitness Gym</h4>
                <p>Fully equipped gym with professional trainers.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background025.png" alt="Cinema">
            <div class="service-content">
                <h4>Private Cinema</h4>
                <p>Luxury private cinema and movie lounge.</p>
            </div>
        </div>

        <!-- Business -->
        <div class="service-card">
            <img src="images/services/background026.png" alt="Business Center">
            <div class="service-content">
                <h4>Business Center</h4>
                <p>High-speed internet, printing, and meeting rooms.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background027.png" alt="Executive Lounge">
            <div class="service-content">
                <h4>Executive Lounge</h4>
                <p>Exclusive lounge for executives and VIP guests.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background028.png" alt="Conference">
            <div class="service-content">
                <h4>Conference & Events</h4>
                <p>Modern halls for meetings, weddings, and events.</p>
            </div>
        </div>

        <!-- Travel & Transport -->
        <div class="service-card">
            <img src="images/services/background005.png" alt="Airport Pickup">
            <div class="service-content">
                <h4>Airport Pickup & Drop-off</h4>
                <p>Reliable airport transfers available on request.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background029.png" alt="Chauffeur">
            <div class="service-content">
                <h4>Chauffeur & Car Hire</h4>
                <p>Luxury cars with professional drivers.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background030.png" alt="Tour Desk">
            <div class="service-content">
                <h4>Tour & Travel Desk</h4>
                <p>City tours, safaris, and travel arrangements.</p>
            </div>
        </div>

        <!-- Family & Lifestyle -->
        <div class="service-card">
            <img src="images/services/background031.png" alt="Babysitting">
            <div class="service-content">
                <h4>Babysitting & Childcare</h4>
                <p>Professional childcare services.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/background015.png" alt="Garden">
            <div class="service-content">
                <h4>Outdoor Garden</h4>
                <p>Relaxation gardens and outdoor event spaces.</p>
            </div>
        </div>

        <!-- Convenience -->
        <div class="service-card">
            <img src="images/services/background019.png" alt="WiFi">
            <div class="service-content">
                <h4>Free High-Speed Wi-Fi</h4>
                <p>Unlimited high-speed internet access.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background013.png" alt="Room Service">
            <div class="service-content">
                <h4>24/7 Room Service</h4>
                <p>Meals and drinks delivered to your room.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background021.png" alt="Laundry">
            <div class="service-content">
                <h4>Laundry & Dry Cleaning</h4>
                <p>Professional same-day laundry services.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background002.png" alt="Valet Parking">
            <div class="service-content">
                <h4>Valet Parking</h4>
                <p>Convenient and secure valet parking.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/background032.png" alt="Salon">
            <div class="service-content">
                <h4>Beauty Salon & Barber</h4>
                <p>Professional grooming and beauty services.</p>
            </div>
        </div>

        <div class="service-card">
            <img src="images/services/prayer_room.jpg" alt="Prayer Room">
            <div class="service-content">
                <h4>Prayer & Meditation Room</h4>
                <p>Quiet space for prayer and reflection.</p>
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
