<?php
require_once "navbar.php";
require_once "connection.php";

try {
    $stmt = $pdo->query("SELECT * FROM reis ORDER BY id LIMIT 4");
    $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clouds & Chill Flying Agency</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="homepage-body">
<header class="homepage-header">
    <div class="hero-text">
        <h1>Our Wings, Your World</h1>
        <h2>Elevate Your Experience</h2>
    </div>
</header>

<div class="homepage-container">
    <form action="display-reizen.php" method="get" class="homepage-search-form">
        <h2 class="homepage-search-title">Search Flights</h2>
        <div class="homepage-search-inputs">
            <label for="homepage-num_passengers">Number of Passengers:</label>
            <input type="number" id="homepage-num_passengers" name="num_passengers" min="1" value="1" required>
        </div>
        <div class="homepage-search-inputs">
            <label for="homepage-destination">Destination:</label>
            <input type="text" id="homepage-destination" name="destination" required>
        </div>
        <div class="homepage-search-inputs">
            <label for="homepage-departure_date">Departure Date (DD-MM-YYYY):</label>
            <input type="text" id="homepage-departure_date" name="departure_date" pattern="\d{1,2}-\d{1,2}-\d{4}" required>
        </div>
        <button type="submit" class="homepage-search-button">Search</button>
    </form>
</div>

<div class="container">
    <h2 class="homepage-section-title">Explore Our Popular Destinations</h2>
    <div class="homepage-trips">
        <?php foreach ($destinations as $destination): ?>
            <div class="homepage-trip">
                <img src="../pics/<?= htmlspecialchars($destination['image']); ?>" alt="<?= htmlspecialchars($destination['titel']); ?>">
                <h3 class="homepage-trip-title"><?= htmlspecialchars($destination['titel']); ?></h3>
                <p class="homepage-trip-description"><?= htmlspecialchars($destination['beschrijving']); ?></p>
                <a href="details.php?id=<?= $destination['id']; ?>" class="homepage-book-now-btn">Book Now</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
