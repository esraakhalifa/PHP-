<?php
require_once("./../handlers/loginHandler.php");

$username = $_POST["username"];
$password = $_POST["password"];
$error = SetSession($username, $password);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input { display: block; margin: 10px 0; padding: 8px; width: 200px; }
        .error { color: red; }
    </style>
</head>
<body>

    <h2>Login</h2>

    <?php if ($error !== ""): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

</body>
</html>
