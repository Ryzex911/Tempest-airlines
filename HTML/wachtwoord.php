<?php
session_start();


require_once "connection.php";
require_once "navbar.php";

global $pdo;
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

if (isset($_GET["id"]) &&!empty($_GET["id"])) {
    $id = $_GET["id"];

    echo $id;

    if (isset($_POST["bijwerken"])) {
        $newPassword = $_POST['password'];

        if (empty($newPassword) || strlen($newPassword) < 1) {
            $_SESSION['error_message'] = "Nieuw wachtwoord moet minimaal 1 tekens lang zijn.";
            header("Location: updatepassword.php?id=$id");
            exit;

        }

        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);


        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":new_password", $hashed_password, PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['success_message'] = "Wachtwoord succesvol gewijzigd.";

    }
}
?>


<form method='post'>
    <h1>Edit User Password</h1>
    <h2><?php echo isset($_SESSION['username'])? $_SESSION['username'] : '';?></h2>

    <div>
        <label>Nieuw Wachtwoord:
            <input type="password" name="password" placeholder="Type nieuw wachtwoord..." required>
        </label>
        <div>
            <input type="hidden" name="username" value="<?php echo isset($_SESSION['username'])? $_SESSION['username'] : '';?>">
            <input type="submit" name="bijwerken" value="Submit Changes">
        </div>
</form>
