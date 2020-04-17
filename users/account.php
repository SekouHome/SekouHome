<?php

getHeader("Account Overview");

// Make this into a function within loader.php ?? and call on any page
if (!isset($_SESSION['id']))
{
    ?>
    <script>
        document.getElementById("header").style.display="none";
    </script>

    <div class="alert alert-danger text-center" role="alert">
        <h1>Access Denied! You must be logged in to access this page.</h1>
    </div>
    <div class="alert alert-danger text-center" role="alert">
        <h1>Please return to the <a href="<?php echo $GLOBALS['home']; ?>" class="alert-link">sign in page</a> and Log in or create a new account.</h1>
    </div>
    <?php
    die();
}

?>

<div class="container text-center">
    <p>Logged in as:
        <?php
            if (isset($_SESSION['id']))
            {
              echo $_SESSION['username'] . " (" . $_SESSION['email'] . ")";
            }
            else
            {
              echo "Anon";
            }
       ?>
    </p>
    <a href="<?php echo $GLOBALS['home'] . "/home.php"; ?>" class="btn btn-outline-success">Home</a>
    <p></p>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-4">
          <h3>Edit User Info</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="username" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="firstname">Firstname:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                </div>

                <div class="form-group container text-center">
                    <button class="btn btn-outline-primary" formaction="/users/update.php" name="infobutton">Update</button>
                </div>
            </form>
      </div>
        <div class="col-4">
            <h3>Change Password</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="old-password">Old Password:</label>
                    <input type="password" class="form-control" placeholder="Old password" id="old-password" name="old-password">
                </div>
                
                <div class="form-group">
                    <label for="new-password">New Password:</label>
                    <input type="password" class="form-control" placeholder="New password" id="new-password" name="new-password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password must be 8-20 characters long, contain letters and numbers.
                    </small>
                </div>
                
                <div class="form-group">
                    <label for="repeat-new-password">Repeat New Password:</label>
                    <input type="password" class="form-control" placeholder="Repeat new password" name="repeat-new-password">
                    <small id="repeatPasswordHelpBlock" class="form-text text-muted">
                        Your passwords must match.
                    </small>
                </div>
                
                <div class="form-group container text-center">
                    <button class="btn btn-outline-primary" formaction="/users/update.php" name="passwordbutton">Update</button>
                </div>
            </form>
        </div>
      
        <div class="col-4">
            <h3>Change Profile Picture</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profileimg">Current profile picture:</label>
                    <div class="container text-center" style="max-height: 200px; max-width: 200px;">
                        <img src="../images/<?php echo $_SESSION['profile']; ?>"  class="img-thumbnail" alt="../images/<?php echo $_SESSION['profile']; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="profile">Upload new image:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profile" name="profile">
                        <label class="custom-file-label" for="profile">Choose file</label>
                        <small class="form-text text-muted">
                            Files must be either *.png, *.jpg, *.jpeg or *.gif and no larger than 200px by 200px
                        </small>
                    </div>
                </div>

                <div class="form-group container text-center">
                    <button class="btn btn-outline-primary" formaction="/images/upload.php" name="profilebutton">Update</button>
                </div>
            </form>
        </div>
  </div>
</div>

<?php

getFooter();

?>
