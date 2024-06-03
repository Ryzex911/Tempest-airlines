<?php
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
    header('Location: admin-page.php');
    exit();
}

if (isset($_POST['confirm_delete'])) {
    $sql = "DELETE FROM reis WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: admin-page.php');
    exit();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Flight</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="delete-html">
<div class="delete-container">
    <h2 class="welcoming-text4">Delete Flight</h2>

    <table class="item-details">
        <tr>
            <td class="title-text"><strong>Title:</strong></td>
            <td><?php echo htmlspecialchars($item['titel']); ?></td>
        </tr>
        <tr>
            <td class="desc-text"><strong>Description:</strong></td>
            <td><?php echo htmlspecialchars($item['beschrijving']); ?></td>
        </tr>
        <tr>
            <td class="prijs-text"><strong>Price:</strong></td>
            <td>$<?php echo htmlspecialchars($item['prijs']); ?></td>
        </tr>
        <tr>
            <td class="date-text"><strong>From:</strong></td>
            <td><?php echo htmlspecialchars($item['vanaf']); ?></td>
        </tr>
        <tr>
            <td class="date-text"><strong>To:</strong></td>
            <td><?php echo htmlspecialchars($item['tot']); ?></td>
        </tr>
        <tr>
            <td class="image-text"><strong>Image URL:</strong></td>
            <td><?php echo htmlspecialchars($item['image']); ?></td>
        </tr>
    </table>

    <form action="" method="post" class="delete-form">
        <button class="delete-btn-confirm" type="submit" name="confirm_delete">Yes, Delete</button>
        <a class="delete-btn-cancel" href="admin-page.php">Cancel</a>
    </form>
</div>
</body>
</html>
<?php
$pdo = null;
?>
