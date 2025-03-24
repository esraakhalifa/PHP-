<?php
require_once('./../includes/utils.php');
require_once('connection_creds.php');


function ConnectPDO(){
    try{
        // Data Source Name (DSN) String
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=3306";
        // PDO connection creation
        $pdo = new PDO($dsn,DB_USER,DB_PASSWORD);
        // var_dump($pdo);
    }
    catch(PDOException $e){
        // Display error message
        echo "". $e->getMessage();
    }
    return $pdo;
}
ConnectPDO();
?>