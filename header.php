<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="styles/header.css">
</head>
<body>
<header class="header">
    <div class="logo">Top Star Hotel</div>

    <nav class="nav" id="navMenu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="food.php">Food Menu</a>
        <a href="services.php">Services</a>
        <button class="btn outline" id="themeBtn" onclick="toggleTheme()">🌙</button>
        <a href="location.php">Find Us Here</a>
       <div class="dropdown">
  <button class="dropbtn">Help  &#10067;</button>
  <div class="dropdown-content">
    <a href="documentation.php">Help &#10067;!</a>
    
  </div>
</div>
    
    </nav>

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    
</header>

<script src="header.js"></script>

</body>
</html>