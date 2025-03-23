<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once('/utils.php');


function generateTitle($title) {
    echo "<title>$title</title>";
}

generateTitle("Data Recieved");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedSkills = "No skills selected.";

    if (!empty($_POST['skills'])) {
        $selectedSkills = implode(", ", array_map("htmlspecialchars", $_POST['skills']));
    }

    $title = ($_POST['gender'] ?? '') === 'female' ? 'Miss' : 'Mr';
    $fname = $_POST['fname'] ?? 'N/A';
    $lname = $_POST['lname'] ?? 'N/A';
    $address = $_POST['address'] ?? 'N/A';
    $department = $_POST['department'] ?? 'N/A';
    
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Submission</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<head>
<h1>Good Evening to you!!</h1>
<div id="resultCard" class="mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title">Submitted Data</h4>
            <h3>Thanks <?php echo $fname . " " . $lname; ?></h3>
            <h3>Please review your information.</h3>
            <p><strong>Name:</strong> <span id="displayName"><?php echo $fname . " " . $lname; ?></span></p>
            <p><strong>Address:</strong> <span id="displayEmail"><?php echo $address; ?></span></p>
            <p><strong>Skills:</strong> <span id="displaySkills"><?php echo $selectedSkills; ?></span></p>
            <p><strong>Department:</strong> <span id="department"><?php echo $department; ?></span></p>
        </div>
    </div>
</div>
