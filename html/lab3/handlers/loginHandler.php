<?php

function FindUser($username, $password) {

$usersJson = file_get_contents("./../users.json");
$usersArray = json_decode($usersJson, true);

// Debug line
if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Decode Error: " . json_last_error_msg());
}


foreach ($usersArray as $user) {

    if ($user["username"] == $username && $user["password"] == $password) {
        print_r($user);
        return $user;
}
}
return false;
}
function SetSession($username, $password) {
    session_start();
    $error = "";

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $validUser = FindUser($username, $password);

        if (empty($username) || empty($password)) {
            $error = "Both fields are required!";
            
        } elseif ($validUser) {
            $_SESSION["user"] = $username;
            header("Location: landing.php");
        } else {
            $error = "Invalid username or password!";
            
        }
    }
    return $error;
}
?>