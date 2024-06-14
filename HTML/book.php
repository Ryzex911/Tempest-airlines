<?php
session_start();
require_once "connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reis_id']) && !empty($_POST['reis_id'])) {
        $user_id = $_SESSION['user_id'];
        $reis_id = $_POST['reis_id'];
        $current_date = date('Y-m-d'); // Set the current date for 'vanaf' and 'tot'

        try {
            $stmt = $pdo->prepare("INSERT INTO boeking (user_id, reis_id, status, vanaf, tot, prijs) VALUES (?, ?, 'booked', ?, ?, 0)");
            $stmt->execute([$user_id, $reis_id, $current_date, $current_date]);

            // Redirect to booking success page
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
