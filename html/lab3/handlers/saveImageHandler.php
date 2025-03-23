<?php
    require_once('./../includes/utils.php');

    function SaveImage()
    {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
    
        $valid_extensions = array("jpeg", "jpg", "png");
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
    
            if (empty($image_name) || empty($image_tmp) || !in_array(strtolower($ext), $valid_extensions)) {
                // header('location:saveImageHandler.php?status=error');
                return null;
                // exit();
            }
    
            $image_name = explode("/", $image_tmp);
            $image_name = end($image_name).".".$ext;
    
            $uploaded=move_uploaded_file($image_tmp, "./../uploads/images/" . $image_name);


            return $uploaded;
        }


    function deleteImage($image_path){
        if(file_exists($image_path)){
            unlink($image_path);
        }

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        SaveImage();
    }
?>


<!-- HTML & Styling -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
   
</body>
</html> -->






