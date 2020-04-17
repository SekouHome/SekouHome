<?php

session_start();

header('X-XSS-Protection:0');

ini_set('display_errors', 1);

/* Credentials for database, currently without password */
$GLOBALS['ip'] = "localhost";
$GLOBALS['user'] = 'root';
$GLOBALS['password'] = '';
$GLOBALS['database'] = new mysqli($GLOBALS['ip'], $GLOBALS['user'], $GLOBALS['password'], 'social_media');

/* Server variables */
$GLOBALS['root'] = $_SERVER['DOCUMENT_ROOT'];
$GLOBALS['home'] = 'http://' . $_SERVER['SERVER_NAME'];

function getHeader($title)
{
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8">
  <title> <?php echo $title;?> </title>
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <div class="">
          <div class="alert alert-primary text-center" role="alert" id="header">
              <h1><?php echo $title;?></h1>
          </div>
      </div>
  </head>
  <body>
  <?php
}

function getFooter()
{
  echo "</body>";
      ?>
        <footer>
            <div class="alert alert-primary text-center" role="alert">
                Practice_Social_Media
            </div>
        </footer>
      <?php
  echo "</html>";
}

?>
