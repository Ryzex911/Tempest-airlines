<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reis_id = $_POST['reis_id'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("UPDATE boeking SET status = 'geannuleerd' WHERE reis_id = ? AND user_id = ?");
        $stmt->execute([$reis_id, $user_id]);

        header('Location: reizen.php');
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
