<?php

require_once "./../validation/registrationValidation.php";

// Validate Post Data

$formDataIssues = ValidatePostData($_POST);
$formErrors = $formDataIssues["errors"];
$currently_valid_data = $formDataIssues["valid_data"];

if (!empty($formErrors)) {

    // Pass the form validation errors to the registration page in query string
    $errors = json_encode($formErrors);

    // Pass the valid form data to the registration page in query string
    $currently_valid_data_json = json_encode($currently_valid_data);
    
    // Set the query string value, errors and valid data.
    $queryString = "errors={$errors}";
    if (!empty($currently_valid_data)) {
        $queryString .= "&currently_valid_data={$currently_valid_data_json}";
    }

    // Set the header
    header("Location: registration.php?{$queryString}");
    exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selectedSkills = "No skills selected.";

    // Join the skills into a single string

    if (!empty($_POST['skills'])) {
        $selectedSkills = implode(", ", array_map("htmlspecialchars", $_POST['skills']));
    }

    // Set the variables for the confirmation page from POST data

    $title = ($_POST['gender'] ?? '') === 'female' ? 'Miss' : 'Mr';
    $fname = $_POST['fname'] ?? 'N/A';
    $lname = $_POST['lname'] ?? 'N/A';
    $address = $_POST['address'] ?? 'N/A';
    $department = $_POST['department'] ?? 'N/A';
    $gender=$_POST['gender'];

    // Create JSON object for the data
    $userData = [

        "fname" => $fname,
        "lname" => $lname,
        "address" => $address,
        "department" => $department,
        "gender" => $gender,
        "skills" => $selectedSkills
    ];
    
    $fileName = "data.json";

    // Add the data to the json file

    if(AddUserToFile($fileName, $userData))
    {

        // Set up the saved flag for the registration confirmation page
        $saved=true;
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Submission</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 text-center">
    <?php if ($saved): ?>
        <h1 class="fw-bold text-primary">🎉 Data Saved Successfully! 🎉</h1>
        <a class="btn btn-primary btn-lg shadow-lg rounded-pill px-4 py-2 fw-bold" href="dataTable.php">
            🚀 Display All Users
        </a>
    <?php else: ?>
        <h1 class="fw-bold text-danger">⚠️ Contact your Admin ⚠️</h1>
    <?php endif; ?>
</div>

<div id="resultCard" class="mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title">Submitted Data</h4>
            <h3>Thanks <?= htmlspecialchars($fname . " " . $lname) ?>!</h3>
            <h3>Please review your information.</h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($fname . " " . $lname) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
            <p><strong>Skills:</strong> <?= htmlspecialchars($selectedSkills) ?></p>
            <p><strong>Department:</strong> <?= htmlspecialchars($department) ?></p>
        </div>
    </div>
</div>

</body>
</html>
