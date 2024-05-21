<?php
require_once "navbar.php";
require_once "connection.php";
?>

<link rel="stylesheet" href="css/styles.css">
<body class="contact-body">

<div class="contact-form">
    <span class="heading">Contact Us</span>
    <form>
        <label for="name">Name:</label>
        <input type="text" required="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required="">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required=""></textarea>
        <button type="submit">Submit</button>
    </form>
</div>
</body>