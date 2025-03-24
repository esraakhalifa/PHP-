<?php
require_once "./../pdo/Db_Operations.php"; 

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$userId = intval($_GET['id']);

// Fetch user data
$user = PdoFetchUser($userId);

if (!$user) {
    die("User not found.");
}
// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedData = [
        "fname" => $_POST['fname'],
        "lname" => $_POST['lname'],
        "address" => $_POST['address'],
        "department" => $_POST['department'],
        "gender" => $_POST['gender'],
        "skills" => $_POST['skills'],
        "username" => $_POST['username'],
        "email" => $_POST['email']
    ];

    PdoEdit("users", $updatedData, "id", $userId);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; margin-top: 50px; }
        .container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 400px; margin: auto; }
        label { display: block; margin: 10px 0 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background-color: #28a745; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>

        <label>Last Name:</label>
        <input type="text" name="lname" value="<?= htmlspecialchars($user['lname']) ?>" required>

        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">

        <label>Department:</label>
        <input type="text" name="department" value="<?= htmlspecialchars($user['department']) ?>">

        <label>Gender:</label>
        <select name="gender" required>
            <option value="male" <?= $user['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= $user['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
        </select>

        <label>Skills:</label>
        <input type="text" name="skills" value="<?= htmlspecialchars($user['skills']) ?>">

        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit">Save Changes</button>
    </form>
</div>

</body>
</html>