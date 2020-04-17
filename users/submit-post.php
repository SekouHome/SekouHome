<?php

function reload()
{
    // Refresh home page
    header("Location: " . $GLOBALS['home'] . "/home.php");
}

$posttitle = $_POST['post-title'];
$postcontent = $_POST['post-content'];
$postlink = $_POST['post-link'];
$postimage = $_POST['post-image'];

if(!empty($postlink) && !empty($postimage))
{
    // All fields where filled in, send all to database
    if ($stmt = $GLOBALS['database'] -> 
        prepare("INSERT INTO `post_info` (`title`, `content`, `userid`, `ytlink`, `imagelink`) VALUES (?, ?, ?, ?, ?)"))
    {
        $stmt -> bind_param("ssiss", $posttitle, $postcontent, $_SESSION['id'], $postlink, $postimage);
        $stmt -> execute();
        $last_id = $stmt -> insert_id; // The ID of the row just inserted
        
        $stmt -> close();

        
        reload();
    }
}
elseif(!empty($postlink) && empty($postimage))
{
    // Only the link was filled in
    if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `post_info` (`title`, `content`, `userid`, `ytlink`) VALUES (?, ?, ?, ?)"))
    {
        $stmt -> bind_param("ssis", $posttitle, $postcontent, $_SESSION['id'], $postlink);
        $stmt -> execute();
        $last_id = $stmt -> insert_id; // The ID of the row just inserted
        
        $stmt -> close();

        reload();
    }
}
elseif(!empty($postimage) && empty($postlink))
{
    // Only the image was filled in
    if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `post_info` (`title`, `content`, `userid`, `imagelink`) VALUES (?, ?, ?, ?)"))
    {
        $stmt -> bind_param("ssis", $posttitle, $postcontent, $_SESSION['id'], $postimage);
        $stmt -> execute();
        $last_id = $stmt -> insert_id; // The ID of the row just inserted
        
        $stmt -> close();

        reload();
    }
}
else
{
    // Neither of the optional fields where filled in
    if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `post_info` (`title`, `content`, `userid`) VALUES (?, ?, ?)"))
    {
        $stmt -> bind_param("ssi", $posttitle, $postcontent, $_SESSION['id']);
        $stmt -> execute();
        $last_id = $stmt -> insert_id; // The ID of the row just inserted
        
        $stmt -> close();

        reload();
    }
}

?>