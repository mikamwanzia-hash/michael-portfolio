<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entertainments</title>
    <link rel="stylesheet" href="styles/services.css">
</head>
<body>
    <?php
    include "header.php";
    ?>
<main class="services-section">
    
    <div class="services-grid">

        <!-- Accommodation -->
        <div class="service-card">
            <img src="images/sinema.png" alt="Luxury Rooms">
            <div class="service-content">
                <h4>Luxury Sinema Room</h4>
                <p>Spacious, clean, and modern Sinema rooms designed for your comfort.</p>
            </div>
        </div>
          <div class="service-card">
            <img src="images/services/background003.png" alt="Swimming Pool">
            <div class="service-content">
                <h4>Swimming Pool</h4>
                <p>Relax and refresh in our well-maintained pools.</p>
            </div>
        </div>
        <div class="service-card">
            <img src="images/services/background024.png" alt="Rooftop Restaurant">
            <div class="service-content">
                <h4>Rooftop Restaurant</h4>
                <p>Fine dining with breathtaking city views.</p>
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
            <img src="images/services/background030.png" alt="Tour Desk">
            <div class="service-content">
                <h4>Tour & Travel Desk</h4>
                <p>City tours, safaris, and travel arrangements.</p>
            </div>
        </div>
          <div class="service-card">
            <img src="images/services/prayer_room.jpg" alt="Prayer Room">
            <div class="service-content">
                <h4>Prayer & Meditation Room</h4>
                <p>Quiet space for prayer and reflection.</p>
            </div>
        </div>

       
</main>
 <p class="floating_par">To view all, <span><a href="index.php">Kindly Login.</a></span></p>
 <?php
 include "footer.php";
 ?>
 <script src="styles/main.js"></script>
</body>
</html>