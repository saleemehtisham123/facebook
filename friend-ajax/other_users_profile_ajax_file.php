<?php
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

$friend_id = $_POST['friend_id'];
$get_friend_data = "SELECT * from users where id='$friend_id'";
$run_friend_data = mysqli_query($con, $get_friend_data);
$fetch = mysqli_fetch_array($run_friend_data);

$user_name = strtok($fetch['name'], " ");
$gender = $fetch['gender'];
$check_profile_images = "SELECT * from profile_images where user_id='$friend_id'" or die("Query Failed");
$run_images = mysqli_query($con, $check_profile_images);
$fetch_img = mysqli_fetch_array($run_images);
$prf_img = $fetch_img['profile_img'];
$prf_cover = $fetch_img['profile_cover'];
$output = "";
if ($gender == 'Male') {
    if ($prf_img == '') {
        $output .= "<img src='icon/boy.jpg' alt='error' id='upload_profile_img' class='upload_profile_img'>";
    } else {
        $output .= "<img src='profile_img/$prf_img' alt='error' id='upload_profile_img' class='upload_profile_img'>";
    }
    if ($prf_cover == '') {
        $output .= "<img src='icon/boy.jpg' alt='error' id='upload_profile_cover' class='upload_profile_cover'>";
    } else {
        $output .= "<img src='profile_img/$prf_cover' alt='error' id='upload_profile_cover' class='upload_profile_cover'>";
    }
    echo $output;
} else {
    if ($prf_img == '') {
        $output .= "<img src='icon/girl.jpg' alt='error' id='upload_profile_img' class='upload_profile_img'>";
    } else {
        $output .= "<img src='profile_img/$prf_img' alt='error' id='upload_profile_img' class='upload_profile_img'>";
    }
    if ($prf_cover == '') {
        $output .= "<img src='icon/girl.jpg' alt='error' id='upload_profile_cover' class='upload_profile_cover'>";
    } else {
        $output .= "<img src='profile_img/$prf_cover' alt='error' id='upload_profile_cover' class='upload_profile_cover'>";
    }
    echo $output;
}
