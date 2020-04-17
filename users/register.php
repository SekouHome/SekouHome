<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat = $_POST['repeat-password'];

// Move checks to seperate scripts
if (strlen($email) <= 0 || strlen($email) > 50 || !strpos($email, "@"))
{
    if (strlen($email) < 1)
        echo "Email length too short";
    else
        echo "Email length too long";
    die();
}
else if (strlen($username) <= 0 || strlen($username) > 30 || preg_match("/[^A-Za-z\'-]/", $username))
{
    echo "Invalid username!";
    die();
}
else if (strlen($password) <= 0 || strlen($password) > 65 || preg_match("/[^A-Za-z0-9\'-]/", $password))
{
    echo "Invalid password!";
    die();
}
else if ($password !== $repeat)
{
    echo "Your passwords dont't match!";
    exit();
}

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id` FROM `users` WHERE `username` = ? OR `email` = ?"))
{
    $stmt -> bind_param("ss", $username, $email);
    $stmt -> execute();
    $stmt -> bind_result($id);

    while ($stmt -> fetch())
    {
        echo "Could not create account!";
        die();
    }

    $stmt -> close();
}

$hash = password_hash($password, PASSWORD_DEFAULT);

if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)"))
{
    $stmt -> bind_param("sss", $username, $email, $hash);
    $stmt -> execute();
    $last_id = $stmt -> insert_id; // The ID of the row just inserted

    // Once the user is logged in, update the user's session variables
    $_SESSION['id'] = $last_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $stmt -> close();

    // Send to account page
    header("Location: " . $GLOBALS['home'] . "/users/account.php");
}

?>