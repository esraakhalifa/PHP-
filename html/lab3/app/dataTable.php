<?php
require_once "./../pdo/Db_Operations.php"; 
require_once("./../includes/utils.php");

$tableName = "users"; 
$usersData = PdoShowData($tableName); 

if (empty($usersData)) {
    die("<p style='color: red;'>No data found in the database.</p>");
}

$allowedFields = ["id", "name", "email", "username"]; 

$header = array_intersect(array_keys($usersData[0]), $allowedFields);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 50px;
            text-align: center;
        }
        .container {
            max-width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #e97cbc;
            color: white;
            font-size: 16px;
            text-align: center;
        }
        td {
            background-color: #f9f9f9;
            text-align: center;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .edit-btn, .delete-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 2px;
        }
        .edit-btn {
            background-color: #f28f31;
            color: white;
        }
        .edit-btn:hover {
            background-color: #f35822;
        }
        .delete-btn {
            background-color: #cf5976;
            color: white;
        }
        .delete-btn:hover {
            background-color: #ef5f47;
        }
    </style>
    <script>
        function editUser(userId) {
            window.location.href = 'editUser.php?id=' + userId;

        }
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'deleteUser.php?id=' + userId;
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Users Information</h2>
    <table>
        <thead>
            <tr>
                <?php foreach ($header as $col): ?>
                    <th><?= ucfirst($col) ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersData as $user): ?>
                <tr>
                    <?php foreach ($header as $col): ?>
                        <td><?= htmlspecialchars($user[$col]) ?></td>
                    <?php endforeach; ?>
                    <td>
                        <button class='edit-btn' onclick='editUser(<?= $user["id"] ?>)'>Edit</button>
                        <button class='delete-btn' onclick='deleteUser(<?= $user["id"] ?>)'>Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
