
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP STAR LOCATION</title>
</head>
<body>
    <style>
        .map-section {
    margin-top: 40px;
}

.map-section h3 {
    text-align: center;
    margin-bottom: 15px;
}

.map-section iframe {
    width: 100%;
    height: 320px;
    border: 0;
    border-radius: 14px;
}
    </style>
     <div class="map-section">
        <h3>Find Us Here</h3>
        <iframe 
            src="https://www.google.com/maps?q=Nairobi+Prestige&output=embed"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
    
</body>
</html>