<?php
require_once("DBConnection.php");
require_once("./../includes/utils.php");
function PdoCreateTable($tableName, $columns)
{
    try { 
        $conn = connectPDO();

        // Dynamic Table Creation Query
        $query = "create tabele $tableName ($columns);";

        $stmt = $conn->prepare($query);
        $res = $stmt->execute();

        var_dump($res);
        $conn = null;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function PdoInsert($tableName, $data) // Data is passed as an associative array
{
    try {
        $conn = ConnectPDO();
        $columns = implode(", ", array_keys($data)); // Columns are joined from keys of the data array
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        
        $query = "INSERT INTO `$tableName` ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);
        $res = $stmt->execute(array_values($data));
        var_dump($res);
        $conn = null;
        return $res;
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    
}

function PdoShowData($tableName){
    try {
        $conn = ConnectPDO();
        $query = "select * from $tableName";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $data;
    }
    catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        return [];
    }
}
// PdoShowData("users");
function PdoEdit($tableName, $updatedData, $identifier, $idVal) {
    try {
        $conn = ConnectPDO();
        
      
        $fields = implode(", ", array_map(fn($field) => "`$field` = ?", array_keys($updatedData)));
        $query = "update `$tableName` set $fields where `$identifier` = ?";

        $stmt = $conn->prepare($query);

        $res = $stmt->execute([...array_values($updatedData), $idVal]);
        $res = $stmt->execute();
        if($res){
            $affected_rows = $stmt->rowCount();# affected rows
            echo "User updated : {$affected_rows}";
            var_dump($res);
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function PdoDelete($tableName, $identifier, $idVal) {
    try {  
        $conn = ConnectPDO();
        $query=" delete from `$tableName` where `$identifier` = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$idVal]);
        var_dump( $stmt);
        $conn = null;
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

function PdoFetchUser($userId){
    try {
        $conn = ConnectPDO();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}


?>
