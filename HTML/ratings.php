<?php
session_start();
require_once "navbar.php";
require_once "connection.php";

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    die('Access denied. Admins only.');
}
function displayReis($rating) {
    echo "<div class='reis-boek'>";
    echo "<div class='beschrijving'>" . htmlspecialchars($rating['reis_id']) . "</div>";
    echo "<div class='flex-direction'>";
    echo "<div class='gap'>";
    echo "<div class='text-book'>";
    echo "<div class='prijs'>Rating: " . htmlspecialchars($rating['rating']) . ",Stars</div>";
    echo "</div>";
    echo "<div class='gap'>";
    echo "</div>";
    echo "<div class='text-book'> geplaats op: " . htmlspecialchars($rating['created_at']) . "</div>";
    echo "<div class='text-book'>Naam: " . htmlspecialchars($rating['name']) . "</div>";
    echo "<div class='beschrijving'> email:" . htmlspecialchars($rating['email']) . "</div>";
    echo "<div class='beschrijving'>feedback: " . htmlspecialchars($rating['feedback']) . "</div>";
    echo '<span>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

$sql = "SELECT id, reis_id, rating, created_at, name, email, feedback FROM rating";
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
