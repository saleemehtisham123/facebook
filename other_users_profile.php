<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
if (!isset($_SESSION['email'])) {
    echo "<script>window.open('user_login.php','_self')</script>";
} else {
    $friend_id = $_GET['id'];
    $user_data = "SELECT * from users where id='$friend_id'";
    $run_get_data = mysqli_query($con, $user_data);
    $fetch = mysqli_fetch_array($run_get_data);
    $name = $fetch['name'];
    $surname = $fetch['surname'];
    $get_id = "SELECT * from users where email='$_SESSION[email]'";
    $run_id = mysqli_query($con, $get_id);
    $fetch = mysqli_fetch_array($run_id);
    $user_id = $fetch['id'];
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
        <link rel="stylesheet" href="css/other_users_profile.css">
        <link rel="stylesheet" href="css/header.css">

        <title>Facebook</title>
    </head>

    <body>
        <input type="hidden" value='<?php echo $friend_id ?>' id="friend-id">
        <div class="error-msg"></div>
        <div class="success-msg"></div>
        <!-- ------------------------------------------------------------------------setting modal  -->

        <?php include("includes/setting-modal.php") ?>
        <!----------------------------------------------------------------------------full size img; -->
        <?php include("includes/fullsizeimg.php") ?>
        <!-- ---------------------------------------------------------------------------------profile header navbar  -->
        <?php include("includes/navbar.php") ?>
        <!-----------------------------------------------------------------------------------------------profile image and cover; -->
        <div class="backgradient w-100">
            <div class="width-75 m-auto profile-img" id="profile-img-cover">

            </div>
        </div>
        <div class="w-100 text-center mt-3 profile-title">
            <p><?php echo $name . " " . $surname; ?><p>
        </div>
        <div class="w-100 text-center mt-3">
            <!-----------------------------------------------------------------------------------------------Friend Button -->

            <?php
            $check_request = "SELECT * from friends where user_id='$user_id'";
            $check_request_id = mysqli_query($con, $check_request);

            $friends_id = [];
            while ($check = mysqli_fetch_array($check_request_id)) {
                $friends_id[] = $check['friend_id'];
            }

            if (in_array($friend_id, $friends_id)) {
                echo "<button class='btn btn-warning added_friend'>Friends</button>";
            } else if (!in_array($friend_id, $friends_id)) {
                $check_sent_by_id = "SELECT * FROM pending_requests WHERE sent_by_id='$user_id' AND reciever_id='$friend_id'";
                $run_sent_by_id = mysqli_query($con, $check_sent_by_id);
                if (mysqli_num_rows($run_sent_by_id) > 0) {
                    echo "<button class='btn btn-secondary add_friend' disabled='disabled'>Request Sent</button>";
                } else {
                    $check_sent_by_id = "SELECT * FROM pending_requests WHERE sent_by_id='$friend_id' AND reciever_id='$user_id'";
                    $run_sent_by_id = mysqli_query($con, $check_sent_by_id);
                    if (mysqli_num_rows($run_sent_by_id) > 0) {
                        echo "<button class='btn btn-info accept_friend_request' data-id='$friend_id'>Accept Request</button>";
                    } else {
                        echo "<button class='btn btn-primary add_friend' data-id='$friend_id'>Add Friend</button>";
                    }
                }
            }
            ?>
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
                            <!-- <h3>About</h3> -->
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="posts">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/other_users_profile.js">
        </script>
        <script src="js/header.js">
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>