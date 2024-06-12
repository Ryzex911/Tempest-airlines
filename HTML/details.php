<?php
require_once "navbar.php";
require_once "connection.php";

// Check if trip ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $trip_id = $_GET['id'];

    // Retrieve trip details from the database
    $stmt = $pdo->prepare("SELECT * FROM reis WHERE id = ?");
    $stmt->execute([$trip_id]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$trip) {
        // Handle case when trip is not found
        // For example: Redirect or display an error message
    }
    // Display trip details
    // Add HTML and PHP code to display trip details
} else {
    // Handle case when no trip ID is provided
    // For example: Redirect or display an error message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Details</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="detail-body">
<div class="detail-container">
    <?php if(isset($trip)): ?>
        <img src="../pics/<?= htmlspecialchars($trip['image']); ?>" alt="Trip Image" class="detail-trip-image">
        <h2 class="detail-trip-title"><?= htmlspecialchars($trip['titel']); ?></h2>
        <p class="detail-trip-description"><?= htmlspecialchars($trip['beschrijving']); ?></p>
        <p class="detail-trip-price">Price: €<?= number_format($trip['prijs'], 2); ?></p>
        <form action="book.php" method="post" class="detail-book-form">
            <input type="hidden" name="reis_id" value="<?= htmlspecialchars($trip['id']); ?>">
            <!-- Additional form fields if needed -->
            <button type="submit" class="detail-book-button">Book Now</button>
        </form>
    <?php else: ?>
        <p>Trip not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
