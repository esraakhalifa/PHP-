<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form by Esraa Khalifa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h1 {
            font-size: 28px;
            color: #1877f2;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .form-container p {
            font-size: 16px;
            color: #606770;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
        }

        .btn-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .submit-btn {
            background-color: #1877f2;
            color: white;
            border: none;
        }

        .submit-btn:hover {
            background-color: lightblue;
        }

        .reset-btn {
            background-color: #e4e6eb;
            color: #000;
            border: none;
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
        if (isset($_GET["errors"])) {
            $errors = $_GET["errors"];
            echo "<br>";
            $errors = json_decode($errors, true);
        }

        if (isset($_GET["currently_valid_data"])) {
            $currently_valid_data = $_GET["currently_valid_data"];
            $currently_valid_data = json_decode($currently_valid_data, true);
        }
        if (isset($_GET["status"])) {
            $status = $_GET["status"];
        }
    ?>
    <div class="form-container">
        <h1>Registration Form</h1>
        <p>Please fill out the form below to register.</p>
        <form method="POST" action="save.php" enctype="multipart/form-data">
            <!-- First Name -->
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= htmlspecialchars($currently_valid_data['fname'] ?? '') ?>">
                <div class="error"><?= $errors["fname"] ?? '' ?></div>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?= htmlspecialchars($currently_valid_data['lname'] ?? '') ?>">
                <div class="error"><?= $errors["lname"] ?? '' ?></div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address"><?= htmlspecialchars($currently_valid_data["address"] ?? '') ?></textarea>
                <div class="error"><?= $errors["address"] ?? '' ?></div>
            </div>

            <!-- Country -->
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country">
                    <option value="">Select Country</option>
                    <?php
                    $countries = ["USA", "UK", "Egypt"];
                    foreach ($countries as $country) {
                        $selected = (isset($currently_valid_data["country"]) && $currently_valid_data["country"] === $country) ? "selected" : "";
                        echo "<option value=\"$country\" $selected>$country</option>";
                    }
                    ?>
                </select>
                <div class="error"><?= $errors["country"] ?? '' ?></div>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" <?= (isset($currently_valid_data["gender"]) && $currently_valid_data["gender"] === "male") ? "checked" : "" ?>>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" <?= (isset($currently_valid_data["gender"]) && $currently_valid_data["gender"] === "female") ? "checked" : "" ?>>
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="error"><?= $errors["gender"] ?? '' ?></div>
            </div>

            <!-- Skills -->
            <div class="mb-3">
                <label class="form-label">Skills</label>
                <div class="d-flex gap-3 flex-wrap">
                    <?php
                    $skills = ["php", "mysql", "j2se", "postgresql"];
                    foreach ($skills as $skill) {
                        $checked = (isset($currently_valid_data["skills"]) && in_array($skill, $currently_valid_data["skills"])) ? "checked" : "";
                        echo "<div class=\"form-check\">
                                <input class=\"form-check-input\" type=\"checkbox\" name=\"skills[]\" value=\"$skill\" $checked>
                                <label class=\"form-check-label\">" . ucfirst($skill) . "</label>
                              </div>";
                    }
                    ?>
                </div>
                <div class="error"><?= $errors["skills"] ?? '' ?></div>
            </div>

            <!-- Department (Read-Only) -->
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="OpenSource" readonly>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($currently_valid_data["username"] ?? '') ?>">
                <div class="error"><?= $errors["username"] ?? '' ?></div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($currently_valid_data["email"] ?? '') ?>">
                <div class="error"><?= $errors["email"] ?? '' ?></div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="error"><?= $errors["password"] ?? '' ?></div>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload an Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <div class="error"><?= $errors["image"] ?? '' ?></div>
            </div>

            <!-- Status Messages -->
            <?php if (isset($_GET['status']) && ($_GET['status'] == 'success' || $_GET['status'] == 'error')): ?>
                <div class="alert <?= ($_GET['status'] == 'success') ? 'alert-success' : 'alert-danger' ?>">
                    <?= ($_GET['status'] == 'success') ? '✅ Image uploaded successfully!' : '⚠️ Error uploading image. Please try again.' ?>
                </div>
            <?php endif; ?>

            <!-- Submit & Reset Buttons -->
            <div class="btn-container">
                <button type="submit" class="btn submit-btn">Submit</button>
                <button type="reset" class="btn reset-btn">Reset</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>