<?php
session_start();


require_once "connection.php";
require_once "navbar.php";

global $connection;


$sql = "SELECT * FROM `users`";
// $stmt = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Flight</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
</html>

<?php
// Prepare and execute the query
$stmt = $pdo->query($sql);

// Fetch all rows
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Iterate over each row and output the data
foreach ($users as $user) {
    echo "<p>".  htmlspecialchars($user['firstname']). " ".  htmlspecialchars($user['lastname']). " ".  htmlspecialchars($user['email']). "</td>";
    echo '<a href="./wachtwoord.php?id=' . htmlspecialchars($user['id']) . '">Verander wachtwoord</a>';
}
?>