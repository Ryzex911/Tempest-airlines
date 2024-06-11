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
    $stmt = $pdo->prepare("SELECT reis.titel, reis.prijs, reis.image 
                           FROM reis 
                           INNER JOIN boeking ON reis.id = boeking.reis_id 
                           WHERE boeking.user_id = ?");
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
<body>
<div class="container">
    <h1>Your booked trips</h1>
    <div class="trips">
        <?php foreach($trips as $trip): ?>
            <div class="trip">
                <img src="<?= htmlspecialchars($trip['image']); ?>" alt="<?= htmlspecialchars($trip['titel']); ?>">
                <div class="info">
                    <h2><?= htmlspecialchars($trip['titel']); ?></h2>
                    <p>$<?= number_format($trip['prijs'], 2); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
