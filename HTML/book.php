<?php
session_start();
require_once "connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['reis_id']) && !empty($_POST['reis_id']) && isset($_POST['vanaf']) && !empty($_POST['vanaf'])) {
        $user_id = $_SESSION['user_id'];
        $trip_id = $_POST['reis_id'];
        $vanaf = $_POST['vanaf'];
        $tot = $_POST['tot'];

        try {
            $stmt = $pdo->prepare("INSERT INTO boeking (user_id, reis_id, vanaf, tot) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $trip_id, $vanaf, $tot]);
            header('Location: booking-success.php');
            exit();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Error: Required form fields are missing or empty.";
    }
}
require_once 'navbar.php';
?>
