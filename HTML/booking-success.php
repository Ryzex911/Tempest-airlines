<?php

require_once 'connection.php';

$host = 'mysql_db_webapp2';
$db = 'mydatabase';
$user = 'root';
$pass = 'rootpassword';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
} catch (PDOException $e) {
    die("Could not connect to the database $db: " . $e->getMessage());
}

// Initialize variables for error handling and feedback
$error = '';
$successMessage = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = intval($_POST["rating"]);
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $feedback = htmlspecialchars($_POST["feedback"]);

    // Insert rating into the database
    $sql = "INSERT INTO rating (rating, name, email, feedback, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rating, $name, $email, $feedback]);

    $successMessage = "Thank you for your rating!";

    // Redirect to index.php after successful submission
    header("Location: index.php");
    exit(); // Ensure that no further code execution happens after the redirect
}

// Close connection
$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .rating-body {
            font-family: Arial, sans-serif;
            background-color: #232121;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #666;
        }

        .form-group input[type="number"],
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #f00;
            font-size: 14px;
            margin-top: 10px;
        }

        .success-message {
            color: #0a0;
            font-size: 16px;
            margin-top: 10px;
        }
        .booked-text {
            color: green;
            font-weight: bold;
        }
    </style>

</head>
<body class="rating-body">
<div class="rating-container">
    <title>Your trip has been booked</title>

        <h1 class="booked-text">your trip is being booked <br> <h2>Rate us in the mean time</h2> </h1>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <p class="success-message"><?= htmlspecialchars($successMessage); ?></p>
    <?php else: require_once 'navbar.php';?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" required></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>

    <?php endif; ?>
</div>

</body>
</html>
