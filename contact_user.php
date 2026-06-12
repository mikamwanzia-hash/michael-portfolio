<?php
session_start();
require "connect.php";

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

$message_feedback = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $message_feedback = "Message sent successfully!";
    } else {
        $message_feedback = "Failed to send message. Try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact | Top Star Hotel</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/contact_user.css">
</head>
<body>

<?php
include "loggedin_user_header.php";
?>
<main>
    <div class="contact-card">
        <h2>Let's Get In Touch</h2>
        <p>Have any <span>question</span> or need <span>assistance</span>?  
           Send us a message and we’ll respond <span>as soon as possible.</span>
        </p>

        <?php if ($message_feedback): ?>
            <p class="message-feedback"><?= $message_feedback ?></p>
        <?php endif; ?>

        <form action="send_contact.php" method="POST">

            <input type="text" name="name" 
                value="<?= htmlspecialchars($_SESSION['name'] ?? '') ?>" 
                placeholder="Your Name" required>

            <input type="email" name="email" 
                value="<?= htmlspecialchars($_SESSION['email']) ?>" 
                placeholder="Your Email" required>

            <input type="tel" name="phone" 
                placeholder="Your Number (Recommended (Whatsapp No.))" 
                pattern="[0-9+ ]{9,15}" 
                required>

            <textarea name="message" 
                placeholder="Your Message" required></textarea>

            <button type="submit" name="send_message">Send Message</button>

        </form>
    </div>

    <!-- Google Maps -->
    <div class="map-section">
        <h3>Find Us Here</h3>
        <iframe 
            src="https://www.google.com/maps?q=Nairobi+Prestige&output=embed"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</main>

<?php
include "footer.php";
?>

<script src="styles/services.js"></script>

</body>
</html>
