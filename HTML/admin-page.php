<?php
session_start();
require_once "connection.php";
require_once "navbar.php";

if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    die('Access denied. Admins only.');
}

$sql = "SELECT id, titel, beschrijving, prijs, vanaf, tot, image FROM reis";
$stmt = $pdo->query($sql);

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="admin-items">
<div class="admin-items-container">
    <h2 class="admin-welcoming-text">Welcome to the admin panel of Tempest</h2>
    <h3 class="admin-items-list-title">Trip List</h3>
    <a href="addreis.php" class="admin-add-btn">Add Trip</a>
    <form class="admin-search-bar" method="GET">
        <input class="admin-search-bar-text" type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="admin-search-bar-btn" type="submit">Search</button>
    </form>
    <table class="admin-items-table">
        <thead>
        <tr>
            <th>Titel</th>
            <th>Beschrijven</th>
            <th>Price</th>
            <th>From</th>
            <th>To</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt) {
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . highlightSearchTerm($row['titel'], $searchTerm) . "</td>";
                echo "<td>" . highlightSearchTerm($row['beschrijving'], $searchTerm) . "</td>";
                echo "<td>$" . $row['prijs'] . "</td>";
                echo "<td>" . $row['vanaf'] . "</td>";
                echo "<td>" . $row['tot'] . "</td>";
                echo "<td><a href='editreis.php?id=" . $row['id'] . "' class='admin-edit-btn'>Edit</a>
                        <a href='deletereis.php?id=" . $row['id'] . "' class='admin-delete-btn'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No items found</td></tr>";
        }

        function highlightSearchTerm($text, $searchTerm) {
            if ($searchTerm !== '') {
                $text = preg_replace("/\b($searchTerm)\b/i", "<span class='admin-highlight'>$1</span>", $text);
            }
            return $text;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
