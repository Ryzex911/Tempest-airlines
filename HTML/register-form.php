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


<body class="login-form-body">
<link rel="stylesheet" href="css/styles.css">
<div class="login-box">
    <p>Regsiter Here</p>
    <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="user-box">
            <input required="" name="firstname" type="text">
            <label>First Name</label>
        </div>
        <div class="user-box">
            <input required="" name="lastname" type="text">
            <label>Last Name</label>
        </div>
        <div class="user-box">
            <input required="" name="email" type="text">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input required="" name="password" type="password">
            <label>Password</label>
        </div>
        <div class="user-box">
        <input required="" name="confirmpassword" type="password">
        <label>Confirm Password</label>
            </div>

        <a href="#" onclick="document.getElementById('login-form').submit(); return false;" class="submit-link">Register</a>
    </form>
    <p>Already have an account? <a href="email-login-form.php" class="a2">Login!</a></p>
</div>
</body>


    <script>
        function validateForm() {
            var password = document.getElementById("Password").value;
            var confirmPassword = document.getElementById("confirmpassword").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            return true;
        }
    </script>
