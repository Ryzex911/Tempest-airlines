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
    echo "<a href='details.php?id=" . htmlspecialchars($Reis['id']) . "' class='book-now-button'>Details</a>";
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

    <!-- Search input -->
    <div class="input-container">
        <input type="text" id="searchInput" class="input" placeholder="Search...">
        <span class="icon">
                <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </span>
    </div>

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

<script >
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const reisBoeken = document.querySelectorAll('.reis-boek');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.trim().toLowerCase();

            reisBoeken.forEach(reis => {
                const titel = reis.querySelector('.bestemming').textContent.toLowerCase();
                const beschrijving = reis.querySelector('.beschrijving').textContent.toLowerCase();

                if (titel.includes(searchTerm) || beschrijving.includes(searchTerm)) {
                    reis.style.display = 'block';
                } else {
                    reis.style.display = 'none';
                }
            });
        });
    });
</script>
</body>
</html>
