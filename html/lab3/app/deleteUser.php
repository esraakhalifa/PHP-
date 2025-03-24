<?php
require_once "./../pdo/Db_Operations.php"; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    PdoDelete("users", "id", $id);
    header("Location: dataTable.php"); // Redirect back to the users page
    exit();
} else {
    echo "Invalid ID.";
}
?>
