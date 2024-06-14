<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'connection.php';
require_once 'navbar.php';

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT reis.id, reis.titel, reis.prijs, reis.image , boeking.status FROM reis INNER JOIN boeking ON reis.id = boeking.reis_id WHERE boeking.user_id = ?");
    $stmt->execute([$user_id]);
    $trips = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Trips</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="reis-body">
<div class="container">
    <h1 class="title-trip">Your booked trips</h1>
    <div class="reis-container">
        <?php foreach($trips as $trip): ?>
            <div class="reis-display">
                <img class="trip-pic" src="../pics/<?= htmlspecialchars($trip['image']); ?>" alt="<?= htmlspecialchars($trip['titel']); ?>">
                <div class="info">
                    <h2><?= htmlspecialchars($trip['titel']); ?></h2>
                    <p>$<?= number_format($trip['prijs'], 2); ?></p>
                    <h2>Status: <?= htmlspecialchars($trip['status']); ?></h2>
                    <?php if ($trip['status'] == 'booked'): ?>
                        <form action="cancel_trip.php" method="post">
                            <input type="hidden" name="reis_id" value="<?= htmlspecialchars($trip['id']); ?>">
                            <button type="submit" class="cancel-button">Cancel Trip</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
