<?php
session_start();
require_once "connection.php";
require_once "navbar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match');</script>";
        echo "<script>window.location.href = 'register-form.php';</script>";
        exit();
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $hashed_password]);

        echo "<script>alert('Registration successful!');</script>";
        echo "<script>window.location.href = 'login.php';</script>";

    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>


<body class="regsiter-body">
<form class="form" action="register-form.php" method="POST" onsubmit="return validateForm()">
    <p class="title">Register</p>
    <p class="message">Signup now and get full access to our trips.</p>
    <div class="flex">
        <label>
            <input class="input" type="text" name="firstname" placeholder="" required="">
            <span>Firstname</span>
        </label>

        <label>
            <input class="input" type="text" name="lastname" placeholder="" required="">
            <span>Lastname</span>
        </label>
    </div>

    <label>
        <input class="input" type="email" name="email" placeholder="" required="">
        <span>Email</span>
    </label>

    <label>
        <input class="input" type="password" name="password" placeholder="" required="">
        <span>Password</span>
    </label>
    <label>
        <input class="input" type="password" name="confirmpassword" placeholder="" required="" >
        <span>Confirm password</span>
    </label>
    <button class="submit" type="submit">Submit</button>
    <p class="signin">Already have an account? <a href="login.php">Sign in</a></p>
</form>
    <video autoplay loop muted plays-inline class="background-video">
    <source src="pics/backgroundvideo1.webm" type="video/mp4">
        </video>
</body>


    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmpassword").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            return true;
        }
    </script>
