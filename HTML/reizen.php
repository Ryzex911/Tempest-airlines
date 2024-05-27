<?php
session_start();
require_once "navbar.php";
require_once "connection.php";

$user_id = $_SESSION['user_id'];
try {
    $sql = 'SELECT * FROM boeking WHERE user_id = :user_id ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        foreach ($results as $row) {
            echo '<div class="reiscard">';
            echo '<p>Boekingnummer: ' . htmlspecialchars($row['id']) . '</p>';
            echo '<br>';
            echo '<h3>' . htmlspecialchars($row['bestemming']) . '.</h3>';
            echo '<p><i class="fa-solid fa-plane-departure"></i> ' . htmlspecialchars($row['aankomst']) . '</p>';
            echo '<p><i class="fa-solid fa-plane-arrival"></i> ' . htmlspecialchars($row['vertrek']) . '</p>';
            echo '<br>';
            echo '<small>&euro;' . htmlspecialchars($row['prijs']) . '</small>';
            echo '</div>';
        }
    } else {
        echo '<tr><td colspan="3">Geen reizen gevonden.</td></tr>';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
