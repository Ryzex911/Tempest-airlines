<?php
session_start();
require_once "navbar.php";
require_once "connection.php";

$user_id = $_SESSION['user_id'];
$bestemming = "Syria";
$aankomst = "2024-05-25";
$vertrek = "2024-05-20";
$prijs = "30.00";
$stmt = $pdo->prepare("INSERT INTO boeking (user_id, bestemming, aankomst, vertrek , prijs) VALUES (?, ?, ?, ? ,?)");
$stmt->execute([$user_id, $bestemming, $aankomst, $vertrek, $prijs]);
?>
