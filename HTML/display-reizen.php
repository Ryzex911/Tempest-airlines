<?php
require_once "navbar.php";
require_once "connection.php";

$sql = "SELECT img, besteming, prijs FROM reizen";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clouds & Chill Flying Agency</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="main">
<div class="booking">Book you journey</div>
    <div class="toprow-reizen">
        <?php
        function displayReis($Reis) {
        echo "<div class='reis-boek'>";
        echo "<div class='besteming'>" . $Reis['locatie'] . "</div>";
            echo "<div class='flex-direction'>";
                echo "<div class='gap'>";
                    echo "<div class='text-book'>voor maar ";
                    echo "<div class='prijs'>". $Reis['prijs'] . ",-</div>";
                echo "</div>";
                echo "<div class='gap'>";
                    echo "<div class='text-book'> p.p.";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        }
        ?>
        
    </div>
    <div class="bottomrow-reizen">

    </div>
</div>
</body>
