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
        <link rel="stylesheet" href="css/messages.css">
        <link rel="stylesheet" href="css/header.css">

        <title><?php echo $full_user_name . " " . $surname ?></title>
    </head>

    <body>
        <!-- ------------------------------------------------------------------------setting modal  -->
        <?php include("includes/setting-modal.php") ?>
        <!-- ------------------------------------------------------------------------messages modal  -->
        <div id="message-modal">
            <div id="message-modal-form">


            </div>
        </div>
        <!-- ---------------------------------------------------------------------------------profile header navbar  -->
        <?php include("includes/navbar.php") ?>
        <!------------------------------------------------------------------------------------------messages body; -->
        <div class="container-50 mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="online-friends py-1 px-2">
                    </div>

                    <div class="message-area p-3 mt-3">

                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/messages.js">
        </script>
        <script src="js/header.js">
        </script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>