<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
if (!isset($_SESSION['email'])) {
    echo "<script>window.open('user_login.php','_self')</script>";
} else {
    $get_id = "SELECT * from users where email='$_SESSION[email]'";
    $run_id = mysqli_query($con, $get_id);
    $fetch = mysqli_fetch_array($run_id);
    $user_id = $fetch['id'];
    $full_user_name = $fetch['name'];
    $surname = $fetch['surname'];
    $user_name = strtok($fetch['name'], " ");
    $gender = $fetch['gender'];
    $check_profile_images = "SELECT * from profile_images where user_id='$user_id'" or die("Query Failed");
    $run_images = mysqli_query($con, $check_profile_images);
    $fetch_img = mysqli_fetch_array($run_images);
    $prf_img = $fetch_img['profile_img'];
    $prf_cover = $fetch_img['profile_cover'];
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!--  meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
        <link rel="shortcut icon" href="icon/download.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/header.css">

        <title><?php echo $full_user_name . " " . $surname ?></title>
    </head>

    <body>
        <div class="error-msg"></div>
        <div class="success-msg"></div>
        <!-- ------------------------------------------------------------------------setting modal  -->
        <?php include("includes/setting-modal.php") ?>
        <!-- ------------------------------------------------------------------------insert posts modal start  -->
        <?php include("includes/insert_posts_modal.php") ?>
        <!----------------------------------------------------------------------------full size img; -->
        <?php include("includes/fullsizeimg.php") ?>
        <!----------------------------------------------------------------------------profile modal start; -->
        <div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="edit-profile" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-profile">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <button type="button" id="edit-pro-img" class="btn btn-success">Edit</button>
                        <button type="button" id="delete-pro-img" class="btn btn-danger">Delete</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-cover-modal" tabindex="-1" aria-labelledby="edit-profile-cover" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-profile-cover">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <button type="button" id="edit-pro-cover" class="btn btn-success">Edit</button>
                        <button type="button" id="delete-pro-cover" class="btn btn-danger">Delete</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---------------------------------------------------------------------------------profile header navbar  -->
        <?php include("includes/navbar.php") ?>
        <!------------------------------------------------------------------------------------------profile image and cover; -->

        <form id="profile_img_form">
            <input type="file" name="image" style="display: none;" id="profile_img">
            <input type="submit" name="submit" style="display: none;">
        </form>
        <form id="profile_cover_form">
            <input type="file" name="image" style="display: none;" id="profile_cover">
            <input type="submit" name="submit" style="display: none;">
        </form>
        <div class="backgradient w-100">
            <div class="width-75 m-auto profile-img" id="profile-img-cover">

            </div>
        </div>
        <div class="w-100 text-center mt-3 profile-title">
            <p><?php echo $full_user_name . $surname; ?><p>
        </div>
        <hr>
        <!------------------------------------------------------------------------------------------------------about and post section; -->

        <div class="width-75 m-auto">
            <div class="container-fluid">
                <div class="collection mb-4">
                    <button class="btn btn-success" id="about-trigger">About</button>
                    <a href="friends.php"> <button class="btn btn-success ml-2">Friends</button></a>
                    <a href="#"> <button class="btn btn-success ml-2">Photos</button></a>
                </div>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="about p-3 about-show-or-not d-none">
                            <h3>About</h3>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="posts p-3">
                            <div id="insert-post-prof-img" class="d-flex">
                                <input type="text" placeholder="What's on your mind?">
                            </div>
                        </div>
                        <div id="show_posts_append">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/header.js">
        </script>
        <script src="js/profile.js">
        </script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>