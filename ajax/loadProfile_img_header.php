<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

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
$output = "";
$output .= '<a href="profile.php">';
if ($gender == 'Male') {

    if ($prf_img == '') {
        $output .= "<img src='icon/boy.jpg' class='profile_img_logo mr-1' alt='error'><span>$user_name </span>";
    } else {
        $output .= "<img src='profile_img/$prf_img' class='profile_img_logo mr-1' alt='error'><span>$user_name </span>";
    }
} else {
    if ($prf_img == '') {
        $output .= "<img src='icon/girl.jpg' class='profile_img_logo mr-1' alt='error'><span>$user_name </span>";
    } else {
        $output .= "<img src='profile_img/$prf_img' class='profile_img_logo mr-1' alt='error'><span>$user_name </span>";
    }
}
$output .= '</a>';
echo $output;
