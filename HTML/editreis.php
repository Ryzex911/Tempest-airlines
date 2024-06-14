<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();

session_start();


require_once "connection.php";
require_once "navbar.php";

if (!isset($_GET['id'])) {
    header('Location: admin-page.php');
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM reis WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header('Location: admin.php');
    exit();
}

if (isset($_POST['submit'])) {
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $vanaf = $_POST['vanaf'];
    $tot = $_POST['tot'];
    $image = $_POST['image'];

    $sql = "UPDATE reis SET titel = ?, beschrijving = ?, prijs = ?, vanaf = ?, tot = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titel, $beschrijving, $prijs, $vanaf, $tot, $image, $id]);

    header('Location: admin-page.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Flight</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="admin-edit-html">
<div class="admin-edit-container">
    <h2 class="admin-welcoming-text3">Edit Flight</h2>
    <a href="admin-page.php" class="admin-back-btn">Back to Flight List</a>
    <form action="" method="post" class="admin-edit-form">
        <label for="titel">Title:</label>
        <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($item['titel']); ?>" required>

        <label for="beschrijving">Description:</label>
        <textarea id="beschrijving" name="beschrijving" required><?php echo htmlspecialchars($item['beschrijving']); ?></textarea>

        <label for="prijs">Price:</label>
        <input type="number" step="0.01" id="prijs" name="prijs" value="<?php echo htmlspecialchars($item['prijs']); ?>" required>

        <div class="admin-date-field">
            <label for="vanaf">From Date (vanaf):</label>
            <input type="date" id="vanaf" name="vanaf" value="<?php echo htmlspecialchars($item['vanaf']); ?>" required>
        </div>

        <div class="admin-date-field">
            <label for="tot">To Date (tot):</label>
            <input type="date" id="tot" name="tot" value="<?php echo htmlspecialchars($item['tot']); ?>" required>
        </div>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($item['image']); ?>" required>

        <input type="submit" name="submit" value="Update" class="admin-submit-btn">
    </form>
</div>
</body>
</html>

<?php
ob_end_flush();
?>
