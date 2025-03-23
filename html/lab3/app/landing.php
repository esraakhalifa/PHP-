<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; }
        a { text-decoration: none; color: white; background: red; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>Welcome, <?= htmlspecialchars($_SESSION["user"]) ?>!</h2>
    <p>You have successfully logged in.</p>
    <a href="logout.php">Logout</a>

</body>
</html>
