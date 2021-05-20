<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];

$check_profile_images = "SELECT * from profile_images where user_id='$user_id'" or die("Query Failed");
$run_images = mysqli_query($con, $check_profile_images);
$fetch_img = mysqli_fetch_array($run_images);
$prf_img = $fetch_img['profile_img'];
$delete_prof_image = unlink("../profile_img/$prf_img");

$insert_pro_img = "UPDATE `profile_images` SET `profile_img` = '' WHERE `profile_images`.`user_id` = $user_id";
$run = mysqli_query($con, $insert_pro_img);
if ($run) {
    echo "1";
}
