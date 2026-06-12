<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="styles/logged_user.css">
</head>
<body>
    <header class="header">
    <div class="logo">Top Star Hotel</div>

    <nav class="nav" id="navMenu">
        <a href="user_page.php">Home</a>
        <a href="about_user.php">About</a>
        <a href="food_menu_user.php">Food Menu</a>
        <a href="services_user.php">Services</a>
        <a href="cart.php">Cart (<span id="cartCount">0</span>)</a>
        <a href="contact_user.php">Contact</a>
        <button class="btn outline" id="themeBtn" onclick="toggleTheme()">🌙</button>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </nav>

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
</header>


</body>
</html>

