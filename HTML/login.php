<?php
session_start();
require_once "connection.php";
require_once 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            echo "<script>window.location.href = 'reizen.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect email or password');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
    }
}
?>
<body class="login-form-body">
<link rel="stylesheet" href="css/styles.css">
<div class="login-box">
    <p>Welcome back</p>
    <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="user-box">
            <input required="" name="email" type="text">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input required="" name="password" type="password">
            <label>Password</label>
        </div>
        <a href="#" onclick="document.getElementById('login-form').submit(); return false;" class="submit-link">Login</a>
    </form>
    <p>Don't have an account? <a href="register-form.php" class="a2">Sign up!</a></p>
</div>
</body>
