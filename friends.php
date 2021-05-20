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
        <link rel="stylesheet" href="css/friends.css">
        <link rel="stylesheet" href="css/header.css">

        <title>Facebook</title>
    </head>

    <body>
        <!----------------------------------------------------------------------------------------------------------------profile header; -->
        <?php include("includes/navbar.php") ?>
        <!----------------------------------------------------------------------------------------------------------------friends section; -->

        <div class="container mt-3">
            <button class='btn btn-success mt-1' id="you-may-know">You May Know</button>
            <button class='btn btn-success mt-1' id="friends">Friends</button>
            <button class='btn btn-success mt-1' id="friend-requests">Requests</button>
            <button class='btn btn-success mt-1' id="pending-requests">pending Requests</button>
        </div>
        <div class="w-87">
            <div class="row">
                <div class="col-md-4 col-12 mt-2 UMN">
                    <h2 classd="display-1">You May know</h2>
                    <div class="you-may-know p-3 mt-2">

                    </div>
                </div>
                <div class="col-md-4 col-12 mt-2 FRIENDS">
                    <h2 classd="display-1">Friends</h2>
                    <div class="friends p-3 mt-2">

                    </div>
                </div>
                <div class="col-md-4 col-12 mt-2 FRIEND-REQUESTS d-none">
                    <h2 classd="display-1">Friend Requests</h2>
                    <div class="friend-requests p-3 mt-2">

                    </div>
                </div>
                <div class="col-md-4 col-12 mt-2 PENDING-REQUESTS d-none">
                    <h2 classd="display-1">Pending Requests</h2>
                    <div class="pending-requests p-3 mt-2">

                    </div>
                </div>
            </div>
        </div>
        <a href="user-logout.php?user=<?php echo $user_id ?>">Logout</a>
        <script src="js/jquery.js"></script>
        <script src="js/friends.js">
        </script>
        <script src="js/header.js">
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>