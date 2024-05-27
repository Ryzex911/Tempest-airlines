<?php
require_once "navbar.php";
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clouds & Chill Flying Agency</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="homepage">
<header class="home-header">
    <div class="hero-text">
        <h1>Our Wings, Your World</h1>
        <h2>Elevate Your Experience</h2>
    </div>
</header>


<div class="container">
    <h2 class="section-title">Explore Our Popular Destinations</h2>
    <div class="pup-trips">
        <div class="trip">
            <img src="./pics/spain.jpg" alt="Spain">
            <h1 class="trip-title">Spain</h1>
            <p class="trip-description">Discover the beauty of Spain, from its stunning beaches to vibrant cities.</p>
            <button class="book-now-btn">Book Now</button>
        </div>
        <div class="trip">
            <img src="./pics/jorden.jpg" alt="Jordan">
            <h1 class="trip-title">Jordan</h1>
            <p class="trip-description">Experience the wonders of Jordan, from ancient ruins to breathtaking landscapes.</p>
            <button class="book-now-btn">Book Now</button>
        </div>
        <div class="trip">
            <img src="./pics/france.jpg" alt="France">
            <h1 class="trip-title">France</h1>
            <p class="trip-description">Fall in love with the romance of France, its iconic landmarks, and delicious cuisine.</p>
            <button class="book-now-btn">Book Now</button>
        </div>
        <div class="trip">
            <img src="./pics/greece.jpg" alt="Greece">
            <h1 class="trip-title">Greece</h1>
            <p class="trip-description">Explore the beauty of Greece, with its stunning islands and ancient ruins.</p>
            <button class="book-now-btn">Book Now</button>
        </div>
    </div>
</div>

</body>
</html>