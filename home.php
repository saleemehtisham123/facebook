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
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/header.css">
        <title>Facebook</title>
    </head>

    <body>
        <div class="error-msg"></div>
        <div class="success-msg"></div>
        <?php include("includes/setting-modal.php") ?>

        <!-- ------------------------------------------------------------------------insert posts modal start  -->
        <?php include("includes/insert_posts_modal.php") ?>

        <!-- ----------------------------------------------------------------------------------home navbar  -->

        <?php include("includes/navbar.php")
        ?>

        <!-- ----------------------------------------------------------------------------------home body  -->
        <div class="container-50 mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="posts p-3">
                        <div id="insert-post-prof-img" class="d-flex">
                            <input type="text" placeholder="What's on your mind?">
                        </div>
                    </div>
                    <div class="online-friends py-1 px-2 mt-3">

                    </div>
                    <div id="show_all_posts">

                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/home.js">
        </script>
        <script src="js/header.js">
        </script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>