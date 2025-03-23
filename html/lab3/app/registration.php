<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form by Esraa Khalifa</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
    }

    .container {
        text-align: center;
        margin-bottom: 20px;
    }

    .container h1 {
        font-size: 36px;
        color: #1877f2;
        font-weight: bold;
    }

    .container p {
        font-size: 18px;
        color: #606770;
    }

    .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 80vw;
        max-width: 430px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 10px;
        text-align: left;
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: #606770;
        margin-bottom: 5px;
        display: block;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccd0d5;
        border-radius: 5px;
        font-size: 16px;
    }

    .error {
        color: red;
        font-size: 14px;
        font-weight: bold;
        margin-top: 5px;
    }

    .gender-group, .skills-group {
        display: flex;
        gap: 10px;
    }

    .gender-group input, .skills-group input {
        width: auto;
    }

    .btn-container {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    button {
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .submit-btn {
        background-color: #42b72a;
        color: white;
    }

    .reset-btn {
        background-color: #e4e6eb;
        color: black;
    }

    .submit-btn:hover {
        background-color: #36a420;
    }

    .reset-btn:hover {
        background-color: #d8dadf;
    }
    </style>
</head>
<body>

<?php
    $currently_valid_data = $_POST ?? [];
    $errors = [];



if(isset($_GET["errors"])){
    $errors = $_GET["errors"];
    echo "<br>";

    $errors = json_decode($errors, true);
}

if(isset($_GET["currently_valid_data"])){
    $currently_valid_data=$_GET["currently_valid_data"];
    $currently_valid_data = json_decode($currently_valid_data, true);
}



?>

<div class="form-container">
    <form method="POST" action="save.php">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($currently_valid_data['fname'] ?? '') ?>" >
            <div class="error"><?= $errors["fname"] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($currently_valid_data['lname'] ?? '') ?>">
            <div class="error"><?= $errors["lname"] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address"><?= htmlspecialchars($currently_valid_data["address"] ?? '') ?></textarea>
            <div class="error"><?= $errors["address"] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <select id="country" name="country">
                <option>Select Country</option>
                <option <?= (isset($currently_valid_data["country"]) && $currently_valid_data["country"] === "USA") ? "selected" : "" ?>>USA</option>
                <option <?= (isset($currently_valid_data["country"]) && $currently_valid_data["country"] === "UK") ? "selected" : "" ?>>UK</option>
                <option <?= (isset($currently_valid_data["country"]) && $currently_valid_data["country"] === "Egypt") ? "selected" : "" ?>>Egypt</option>
            </select>
            <div class="error"><?= $errors["country"] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="gender-group">
                <input type="radio" name="gender" value="male" <?= (isset($currently_valid_data["gender"]) && $currently_valid_data["gender"] === "male") ? "checked" : "" ?>> Male
                <input type="radio" name="gender" value="female" <?= (isset($currently_valid_data["gender"]) && $currently_valid_data["gender"] === "female") ? "checked" : "" ?>> Female
            </div>
            <div class="error"><?= $errors["gender"] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Skills</label>
            <div class="skills-group">
                <input type="checkbox" name="skills[]" value="php" <?(isset($currently_valid_data["skills"]) and in_array("php", $currently_valid_data["skills"])) ? 'checked' : '';?>>PHP
                <input type="checkbox" name="skills[]" value="mysql" <?(isset($currently_valid_data["skills"])and in_array("mysql", $currently_valid_data["skills"]) )? 'checked' : '';?>> MySQL
                <input type="checkbox" name="skills[]" value="j2se" <?( isset($currently_valid_data["skills"]) and in_array("j2se", $currently_valid_data["skills"])) ? 'checked' : '';?>> J2SE
                <input type="checkbox" name="skills[]" value="postgresql" <?(isset($currently_valid_data["skills"]) and in_array("postgresql", $currently_valid_data["skills"])) ? 'checked' : '';?>> PostgreSQL                    
            </div>
            <div class="error"><?= $errors["skills"] ?? '' ?></div>
        </div>
        <div class="form-group">
                <label for="department">Department</label>
                <input type="text" id="department" name="department" value="OpenSource" readonly>
            </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"  <?= (isset($currently_valid_data["username"])) ? $currently_valid_data["username"] : ""?>>
            <div class="error"><?= $errors["username"] ?? '' ?></div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email"  <?= (isset($currently_valid_data["email"])) ? $currently_valid_data["email"] : ""?>>
            <div class="error"><?= $errors["email"] ?? '' ?></div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" <?= (isset($currently_valid_data["password"])) ? $currently_valid_data["password"] : ""?>>
            <div class="error"><?= $errors["password"] ?? '' ?></div>
        </div>

        <div class="btn-container">
            <button type="submit" class="submit-btn">Submit</button>
            <button type="reset" class="reset-btn">Reset</button>
        </div>
    </form>
</div>

</body>
</html>
