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