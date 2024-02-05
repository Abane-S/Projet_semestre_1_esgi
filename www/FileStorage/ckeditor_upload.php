<?php

$data = [];

// URL de base où les images sont accessibles publiquement
$base_url = "http://localhost:8081/assets/Framework/public/images_upload/";

if (isset($_FILES['upload']['name']))
{
    $file_name = $_FILES['upload']['name'];
    $file_path = "/var/www/html/assets/Framework/public/images_upload/" . $file_name;
    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
    {
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_path))
        {
            $data['file'] = $file_name;
            $data['url'] = $base_url . $file_name;	
            $data['uploaded'] = 1;
        }
        else
        {
            $data['uploaded'] = 0;
            $data['error']['message'] = 'An error occurred while uploading the file';
        }
    }
    else
    {
        $data['uploaded'] = 0;
        $data['error']['message'] = 'File type not allowed';
    }
}

echo json_encode($data);