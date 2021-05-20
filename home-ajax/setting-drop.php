<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$name = $fetch['name'];
$surname = $fetch['surname'];
$gender = $fetch['gender'];
$check_profile_images = "SELECT * from profile_images where user_id='$user_id'" or die("Query Failed");
$run_images = mysqli_query($con, $check_profile_images);
$fetch_img = mysqli_fetch_array($run_images);
$prf_img = $fetch_img['profile_img'];
$output = "";
if ($gender == 'Male') {

    if ($prf_img == '') {
        $output .= "<div class='go-to-profile'><a href='profile.php'><div><img src='icon/boy.jpg' alt='error'></div>";
    } else {
        $output .= "<div class='go-to-profile'><a href='profile.php'><div><img src='profile_img/$prf_img' alt='error'></div>";
    }
} else {
    if ($prf_img == '') {
        $output .= "<div class='go-to-profile'><a href='profile.php'><div><img src='icon/girl.jpg' alt='error'></div>";
    } else {
        $output .= "<div class='go-to-profile'><a href='profile.php'><div><img src='profile_img/$prf_img' alt='error'></div>";
    }
}
$output .= "<b class='ml-2 mt-1'>$name $surname</b><br><span class='ml-2'>See Your Profile</span></a></div><hr>";

$output .= "<div class='setting'><i class='fa fa-cog' aria-hidden='true'></i><p>Setting</p></div><hr>";



$output .= '<div class="logout"> <a href="user-logout.php?user=' . $user_id . '">
<i class="fa fa-sign-out" aria-hidden="true"></i><p>Logout</p></a></div>';

echo $output;
