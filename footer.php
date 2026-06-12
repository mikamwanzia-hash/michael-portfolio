<?php
if(session_status() === PHP_SESSION_NONE){
session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/footer.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body>
    <footer class="footer">


<!-- QUICK LINKS -->

<div class="quick_access">

<h3>Quick Access</h3>

<ul>
<li><a href="index.php">Home</a></li>
<li><a href="food.php">Menu</a></li>
<li><a href="about.php">About Us</a></li>
<li><a href="contact.php">Contact</a></li>

</ul>

</div>


<!-- CONTACT -->

<div class="contact-infor">

<h3>Contact</h3>

<p><i class="bi bi-geo-alt"></i> Nairobi, Kenya</p>
<p><i class="bi bi-telephone"></i> +254 740463326</p>
<p><i class="bi bi-envelope"></i> info@topstarhotel.com</p>

</div>


<div class="social-icons">
<h3>Social Media</h3>
<a href="#"><i class="bi bi-facebook"></i></a>
<a href="#"><i class="bi bi-instagram"></i></a>
<a href="#"><i class="bi bi-twitter-x"></i></a>
<a href="#"><i class="bi bi-youtube"></i></a>

</div>




<!-- COPYRIGHT -->

<div class="footer_bottom">

<p>
 &copy;<?php echo date("Y"); ?> 
</p>

</div>


<!-- FLOATING BUTTONS -->

<div class="footer_float_icons">
    <h3><h3>Active Icons</h3></h3>
<a href="tel:+254740463326" 
class="phone-float">
<i class="bi bi-telephone"></i>
</a>

<a href="https://wa.me/254740463326"
class="whatsapp-float"
target="_blank">
<i class="bi bi-whatsapp"></i>
</a>
</div>

</footer>
</body>
</html>







