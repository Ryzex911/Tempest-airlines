<?php
session_start();


require_once "connection.php";
if (isset($_POST['add'])) {
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $vanaf = $_POST['vanaf'];
    $tot = $_POST['tot'];
    $image = $_POST['image'];

    $sql = "INSERT INTO reis (titel, beschrijving, prijs, vanaf, tot, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $prijs, $vanaf, $tot, $image]);
    header('location:admin-page.php');
    exit;
}
require_once "navbar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Flight</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="admin-add-html">
<div class="admin-add-container">
    <h2 class="admin-welcoming-text2">What flight would you like to add?</h2>
    <a href="admin-page.php" class="admin-back-btn">Back to Flight List</a>
    <form method="post" action="" class="admin-add-form">
        <input type="text" name="titel" placeholder="Title" required>
        <input type="text" name="beschrijving" placeholder="Description" required>
        <input type="number" step="0.01" name="prijs" placeholder="Price" required>

        <div class="admin-date-field">
            <input type="date" name="vanaf" required>
            <span class="admin-date-label">From Date (vanaf)</span>
        </div>

        <div class="admin-date-field">
            <input type="date" name="tot" required>
            <span class="admin-date-label">To Date (tot)</span>
        </div>

        <input type="text" name="image" placeholder="Image URL" required>
        <input type="submit" name="add" value="Add Flight" class="admin-submit-btn">
    </form>
</div>
</body>
</html>
