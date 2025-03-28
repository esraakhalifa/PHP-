<?php
function ValidatePostData($postData){
    $errors = []; // Array of errors to return in the query string

    $valid_data = []; // Array of valid data to return to the user in case of error messages

    // Access each key in the posted data for validation

    foreach ($postData as $key => $value) {

        // Check if key is set
        if(empty($value)){

            // Add the error message to the errors' array
            $errors[$key] = ucfirst("{$key} is required");
            
        } else if (!empty($value)){
            if($key === "email")
            
        {

            if(! preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value)){
                $errors[$key] = ucfirst("Invalid {$key}");

        }

            }else if ($key === "password"){
                if(! preg_match('/^[a-z0-9_]{8}$/', $value)){
                    $errors[$key] = ucfirst("Invalid {$key}");
    
            }
        
            }
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