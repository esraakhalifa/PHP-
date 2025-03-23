<?php

function AddUserToFile($filename, $newUserData)
{

    // Handling current file structure

    if (file_exists($filename)) {

        // The output existing data retrieved is in the form of associative array

        $existingData = json_decode(file_get_contents($filename), true);

        if (!is_array($existingData)) {
            $existingData = [];
        }
    } else {
        $existingData = [];
    }

    array_push($existingData, $newUserData);

     // JSON Serialization

    $jsonData = json_encode($existingData, JSON_PRETTY_PRINT);

    return file_put_contents($filename, $jsonData) !== false;
}


function RenderTable($header, $tableData) {


    // HTML and Boostrap Rendering
    echo '<div class="table-responsive">
        <table>
            <thead class="table-dark">
            <tr>';
    // Create table headers
    foreach ($header as $value) {
        echo "<th>$value</th>";
    }
    echo "</tr></thead><tbody>";


    // Create table rows from array of arrays
    
    foreach ($tableData as $row) { // Main array

        echo "<tr>";

        foreach ($row as  $field) { // Nested array

            if (is_array($field)) { // Split the values if inside an array

                echo "<td>" . implode(", ", $field) . "</td>";

            } else { // Handle the values not in array

                echo "<td>{$field}</td>";

            }

        }

        echo "</tr>"; // End row, and user record
    }

    echo "</tbody></table></div> </div>"; // End table

}


function ValidatePostData($postData){
    $errors = []; // Array of errors to return in the query string

    $valid_data = []; // Array of valid data to return to the user in case of error messages

    // Access each key in the posted data for validation

    foreach ($postData as $key => $value) {

        // Check if key is set
        if(empty($value)){

            // Add the error message to the errors' array
            $errors[$key] = ucfirst("{$key} is required");
            

        }else{

            // Add the valid data to the array to return to the user
            if ( is_array($value)) 
            {
                $valid_data[$key] = array_map('trim', $value);
                

            }
            else $valid_data[$key] = trim($value);

        }

      
    
}
// Return results of both arrays

return ["errors" => $errors, "valid_data" => $valid_data];
}
?>

