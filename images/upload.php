<?php

// Set the file path for the image
$filePath = "../images/" . basename($_FILES["profile"]["name"]);
// Set the file type by getting the extension
//$fileType = strtolower(pathinfo($filePath,PATHINFO_EXTENSION));

// If all checks pass attempt to upload the file
if (move_uploaded_file($_FILES["profile"]["tmp_name"], $filePath))
{
    // Run the update script to change the file name stored in the database
    include '../users/update.php';
}
else
{
    echo "[ERROR] File failed to upload.";
}

// Add &t= current time stamp
// Add &u= current user id

?>