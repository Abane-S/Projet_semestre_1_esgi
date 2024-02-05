<?php

namespace App\FileStorage;
ini_set('display_errors', 1); 
error_reporting(E_ALL);






class Upload 
{
    private const DOWNLOAD_PATH = "/var/www/html/assets/Framework/public/images_upload/";

    public static function uploadFile($file)
    {

        $target_dir = $DOWNLOAD_PATH;
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            $response = [
                "uploaded" => 0,
                "error" => ["message" => "Sorry, your file was not uploaded."]
            ];
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
                $response = [
                    "uploaded" => 1,
                    "fileName" => basename($file["name"]),
                    "url" => $target_dir . basename($file["name"]) // Assurez-vous que cette URL est accessible publiquement
                ];
            } else {
                echo "Sorry, there was an error uploading your file.";
                $response = [
                    "uploaded" => 0,
                    "error" => ["message" => "Sorry, there was an error uploading your file."]
                ];
            }
        }
        
        // Envoyer la réponse à CKEditor
        header('Content-Type: application/json');
        echo json_encode($response);

    }

 
}