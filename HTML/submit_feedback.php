<?php
require_once "connection.php";

$message = "";
$isError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];

    $sql = "INSERT INTO feedback (name, email, message, submission_date) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $messageContent, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $message = "Thank you for your feedback!";
    } else {
        $isError = true;
        $message = "Error: " . $stmt->errorInfo()[2];
    }
}
?>


<body class="contact-body">
<?php include_once "navbar.php"; ?>

<div class="contact-form">
    <h2>Contact Us</h2>

    <?php if (!empty($message)): ?>
        <div class="message <?php echo $isError ? 'error' : 'success'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="submit_feedback.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
