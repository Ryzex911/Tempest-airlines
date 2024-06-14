<?php
require_once "navbar.php";
require_once "connection.php";

// Check if the 'id' is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $trip_id = $_GET['id'];

    // Retrieve trip details from the database
    $stmt = $pdo->prepare("SELECT * FROM reis WHERE id = ?");
    $stmt->execute([$trip_id]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$trip) {
        die("Trip not found.");
    }
} else {
    die("Trip ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Details</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Adjust the path to your CSS file -->
</head>
<body class="detail-body">
<div class="detail-container">
    <?php if(isset($trip)): ?>
        <img src="../pics/<?= htmlspecialchars($trip['image']); ?>" alt="Trip Image" class="detail-trip-image">
        <h2 class="detail-trip-title"><?= htmlspecialchars($trip['titel']); ?></h2>
        <p class="detail-trip-description"><?= htmlspecialchars($trip['beschrijving']); ?></p>
        <p class="detail-trip-price">Price: €<?= number_format($trip['prijs'], 2); ?></p>
        <form id="bookForm" action="book.php" method="post" class="detail-book-form">
            <input type="hidden" name="reis_id" value="<?= htmlspecialchars($trip['id']); ?>">
            <!-- Additional form fields if needed -->
            <button id="bookButton" type="submit" class="detail-book-button disabled">Book Now</button>
            <label class="cl-checkbox">
                <input type="checkbox" id="agreeTerms">
                <span></span> I agree to <a href="terms.php" target="_blank">Terms & Conditions</a>
            </label>
        </form>
    <?php else: ?>
        <p>Trip details could not be found.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('agreeTerms');
        const bookButton = document.getElementById('bookButton');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                bookButton.classList.remove('disabled');
            } else {
                bookButton.classList.add('disabled');
            }
        });
    });
</script>
</body>
</html>
