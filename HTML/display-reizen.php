<?php
require_once "navbar.php";
require_once "connection.php";

function displayReis($Reis) {
    echo "<div class='reis-boek'>";
    echo "<img src='../pics/" . htmlspecialchars($Reis['image']) . "' alt='Image of " . htmlspecialchars($Reis['titel']) . "' class='reis-image'>";
    echo "<div class='bestemming'>" . htmlspecialchars($Reis['titel']) . "</div>";
    echo "<div class='beschrijving'>" . htmlspecialchars($Reis['beschrijving']) . "</div>";
    echo "<div class='flex-direction'>";
    echo "<div class='gap'>";
    echo "<div class='text-book'>voor maar ";
    echo "<div class='prijs'>€ " . htmlspecialchars($Reis['prijs']) . ",- p.p.</div>";
    echo "</div>";
    echo "<div class='gap'>";

    echo "</div>";
    echo "<div class='text-book'> Boeken Vanaf: " . htmlspecialchars($Reis['vanaf']) . "</div>";
    echo "<div class='text-book'>Boeken Tot: " . htmlspecialchars($Reis['tot']) . "</div>";
    echo '<span>';
    echo "<a href='details.php?id=" . htmlspecialchars($Reis['id']) . "' class='book-now-button'>Details</a>"; // Link to details page
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

$sql = "SELECT id, titel, beschrijving, prijs, image, vanaf, tot FROM reis";
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
    <div class="booking">Book your journey</div>
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
