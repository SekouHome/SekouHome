<?php

$commentcontent = $_POST['comment'];
$postid = $_POST['postid'];

echo $postid . " " . $commentcontent;

if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `comments` (`content`, `user_id`, `post_id`) VALUES (?, ?, ?)"))
{
    $stmt -> bind_param("sii", $commentcontent, $_SESSION['id'], $postid);
    $stmt -> execute();
    $last_id = $stmt -> insert_id; // The ID of the row just inserted

    $stmt -> close();

    // Refresh home page
    header("Location: " . $GLOBALS['home'] . "/home.php");
    // Add some user notification
}

?>