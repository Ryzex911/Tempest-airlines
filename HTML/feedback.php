<?php
session_start();
require_once "navbar.php";
require_once "connection.php";

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    die('Access denied. Admins only.');
}
function displayReis($feedback) {
    echo "<div class='reis-boek'>";
    echo "<div class='beschrijving'>user id: " . htmlspecialchars($feedback['id']) . "</div>";
    echo "<div class='flex-direction'>";
    echo "<div class='gap'>";
    echo "<div class='text-book'>";
    echo "<div class='prijs'>Name:  " . htmlspecialchars($feedback['name']) . "</div>";
    echo "</div>";
    echo "<div class='gap'>";
    echo "</div>";
    echo "<div class='text-book'>Email: " . htmlspecialchars($feedback['email']) . "</div>";
    echo "<div class='text-book'>Message: " . htmlspecialchars($feedback['message']) . "</div>";
    echo "<div class='beschrijving'>submission_date:" . htmlspecialchars($feedback['submission_date']) . "</div>";
    echo '<span>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
$sql = "SELECT id, name, email, message, submission_date FROM feedback";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clouds & Chill Flying Agency</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="display-reis-body">
<div class="main-display-reis">
    <div class="booking"></div>

    <div class="toprow-reizen">
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            displayReis($row);
        }
        ?>
    </div>
    <div class="bottomrow-reizen">
    </div>
</div>


</body>
</html>