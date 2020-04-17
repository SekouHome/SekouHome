<?php

getHeader("Home");

// Move this to a seperate script
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

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: #cce5ff;
    }

    .modal-content {
        margin: auto;
        padding: 20px;
        width: 80%;
    }

    .close {
        color: dimgray;
        float: right;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover, .close:focus {
        color: red;
        text-decoration: none;
        cursor: pointer;
    }

    #button-submit, #button-close {
        float: right;
    }

    .comment-section {
        display: none;
    }

    #add-comment {
        color: blue;
    }

    #add-comment:hover {
        cursor: pointer;
    }

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-auto">
            <div class="btn-group-vertical">
              <form id="videoform" action="videos.php" method="GET">
                <input type="text" id="videolink" name="URL" value="test" hidden>
                <button onclick="myFunction()" type="button" class="btn btn-outline-info">Videos</button>
              </form>
                <button class="btn btn-outline-info">Maps</button>
                <button class="btn btn-outline-info">Users</button>
                <button class="btn btn-outline-info">Other</button>
            </div>
        </div>

        <div class="col">
            <?php

            // Load user posts
            if ($stmt = $GLOBALS['database'] -> prepare("SELECT P.`postid`, P.`content`, P.`timestamp`, P.`title`, P.`ytlink`, P.`imagelink`, U.`username`, U.`profile` FROM `post_info` P INNER JOIN `users` U ON P.`userid` = U.`id`"))
            {
                $stmt -> execute();
                $stmt -> bind_result($postid, $content, $timestamp, $posttitle, $ytlink, $imagelink, $username, $profile);
                $stmt -> store_result();

                while ($stmt -> fetch())
                {
                    ?>
                    <h4><?php echo $posttitle;?></h4>
                    <div class="media">

                        <div class="media-body">
                            <h7 class="mt-0">by <?php echo $username; ?></h7>
                            <img src="../images/<?php echo $profile; ?>" class="align-self-start mr-3" width="32" height="32" alt="">
                            <p><?php echo $content; ?></p>
                            <p class="videos"><?php echo $ytlink ?></p>
                            <img src="../images/<?php echo $imagelink; ?>" class="align-self-start mr-3" width="100" height="100" alt="">
                    <?php

                    // Load comments for each post
                    if ($commentsq = $GLOBALS['database'] -> prepare("SELECT C.`commentid`, C.`content`, C.`timestamp`, U.`username`, U.`profile` FROM `comments` C  INNER JOIN `users` U ON C.`user_id` = U.`id` WHERE C.`post_id` = ?"))
                    {
                        $commentsq -> bind_param("i", $postid);
                        $commentsq -> execute();
                        $commentsq -> bind_result($commentid, $content, $timestamp, $username, $profile);
                        $commentsq -> store_result();

                        while ($commentsq -> fetch())
                        {
                            ?>

                            <div class="media mt-3">
                                <a class="mr-3" href="#">&#8627;</a>
                                <div class="media-body">
                                    <h7 class="mt-0"><?php echo $username; ?></h7>
                                    <img src="../images/<?php echo $profile; ?>" class="mr-3" width="32" height="32" alt="../images/<?php echo $profile; ?>">
                                    <p><?php echo $content ?></p>
                                </div>
                            </div>

                            <?php
                        }
                            ?>

                            <div class="form-group" id="add-comment" data-toggle="collapse" data-target="#comment-section">
                                Click here to add a comment
                            </div>

                            <div class="form-group">
                            <form method="POST" action="/users/add-comment.php">
                                <div class="collapse" id="comment-section">
                                    <input value="<?php echo $postid; ?>" name="postid" hidden>
                                    <textarea type="textarea" class="form-control" placeholder="Make a comment..." name="comment"></textarea>
                                    <button class="btn btn-outline-primary">Comment</button>
                                </div>
                            </form>
                            </div>

                        </div>
                        </div>

                        <?php

                    }
                    else
                    {
                        echo "[ERROR] Comments were unable to be loaded <br>";
                    }
                }
            }
            else
            {
                echo "[ERROR] Posts were unable to be loaded <br>";
            }

            ?>

        </div>

        <div class="col col-lg-2">
            <div class="img-container">
                <img src="../images/<?php echo $_SESSION['profile']; ?>" class="img-thumbnail" alt="../images/<?php echo $_SESSION['profile'];?>">
            </div>

            <div class="text-center">

                <label for="username">User: </label>
                <p class="text-monospace">
                    <?php echo $_SESSION['username']; ?>
                </p>

                <label for="email">Email: </label>
                <p class="text-monospace">
                    <?php echo $_SESSION['email']; ?>
                </p>

                <label for="date">Member since: </label>
                <p class="text-monospace">
                    <?php echo $_SESSION['date']; ?>
                </p>

            </div>
            <div class="text-center">
            <div class="btn-group-vertical">
                <form>
<!--                    change this away from a form into just hyperlink buttons-->
                    <button class="btn btn-outline-primary" formaction="/users/logout.php">Logout</button>
                    <button class="btn btn-outline-success" formaction="/users/account.php">Account Info</button>
                </form>

                <button class="btn btn-outline-dark" id="makepost">Create Post</button>
                <div class="text-left">
                <div class="modal" id="post-modal">
                    <div class="modal-content">
                        <div>
                            <span class="close">
                                &times;
                            </span>
                        </div>
                        <form method="POST" action="/users/submit-post.php">
                            <div class="form-group">
                                <label for="post-title">Post Title:</label>
                                <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Title goes here..." required>
                            </div>
                            <div class="form-group">
                                <label for="post-content">Post Content:</label>
                                <textarea type="text" class="form-control" id="post-content" name="post-content" placeholder="Make a post..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="post-link">Youtube Link: (Optional)</label>
                                <input type="text" class="form-control" id="post-link" name="post-link" placeholder="url : https://www.youtube.com/">
                            </div>
                            <div class="form-group">
                                <label for="post-image">Image upload: (Optional)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="post-image" name="post-image">
                                    <label class="custom-file-label" for="post-image">Choose file</label>
                                    <small class="form-text text-muted">
                                        Files must be either *.png, *.jpg, *.jpeg or *.gif and no larger than 200px by 200px
                                    </small>
                                </div>
                            </div>
                            <button class="btn btn-outline-success" id="button-submit">Submit</button>
                            <button class="btn btn-outline-danger" id="button-close">Cancel</button>
                        </form>
                    </div>
                </div>

                <script>
                    var modal = document.getElementById("post-modal");

                    var btn = document.getElementById("makepost");

                    var close = document.getElementById("button-close");

                    var span = document.getElementsByClassName("close")[0];

                    btn.onclick = function() {
                        modal.style.display = "block";
                        // When the modal is shown, we want a fixed body
                        document.body.style.position = 'fixed';
                        document.body.style.top = `-${window.scrollY}px`;

                    }

                    span.onclick = function() {
                        modal.style.display = "none";
                        // When the modal is hidden, we want to remain at the top of the scroll position
                        document.body.style.position = '';
                        document.body.style.top = '';
                    }

                    close.onclick = function() {
                        modal.style.display = "none";
                        // When the modal is hidden, we want to remain at the top of the scroll position
                        document.body.style.position = '';
                        document.body.style.top = '';
                    }

                    window.onclick = function(event) {
                        if (event.target == modal)
                        {
                            modal.style.display = "none";
                            // When the modal is hidden, we want to remain at the top of the scroll position
                            document.body.style.position = '';
                            document.body.style.top = '';
                        }
                    }

                    var links = document.getElementsByClassName("videos");

                    function myFunction() 
                    {
//                        var exists = false;
//                        while (exists == false)
//                        {
//                            var x = Math.floor((Math.random() * links.length) + 0);
//                            if (links[x].length > 0)
//                            {
//                                exists = true;
//                                var value = links[x].innerHTML;
//                            }
//                        }
                        
                        var value = links[5].innerHTML;
                        document.getElementById("videolink").value = value;
                        document.getElementById("videoform").submit(); // Form submission
                    }

                </script>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<?php

getFooter();

?>
