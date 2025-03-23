<?php
require_once("helpers.php");

$jsonFile = "data.json"; // Ensure this file exists
if (!file_exists($jsonFile)) {
    die("<p style='color: red;'>Error: JSON file not found.</p>");
}

$jsonData = json_decode(file_get_contents($jsonFile), true);
if ($jsonData === null) {
    die("<p style='color: red;'>Error: Failed to parse JSON.</p>");
}

$header = ['First Name', 'Last Name', 'Address', 'Department', 'Gender', 'Skills'];

// Prepare table data
$tableData = [];
foreach ($jsonData as $key => $user) {
    if (is_array($user) && is_numeric($key)) {
        $tableData[] = [
            'fname'      => $user['fname'] ?? 'N/A',
            'lname'      => $user['lname'] ?? 'N/A',
            'address'    => $user['address'] ?? 'N/A',
            'department' => $user['department'] ?? 'N/A',
            'gender'     => $user['gender'] ?? 'N/A',
            'skills'     => $user['skills'] ?? 'N/A', 
        ];
    }
}
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
            background-color: #007bff;
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
        .highlight {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Users Information</h2>
    <table>
        <?php RenderTable($header, $tableData); ?>
    </table>
</div>

</body>
</html>
