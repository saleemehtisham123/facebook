<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];

$profile_img_name = $_FILES['image']['name'];
$file_extension = pathinfo($profile_img_name, PATHINFO_EXTENSION);
$valid_extensions = array("jpg", "jpeg", "png");
if (in_array($file_extension, $valid_extensions)) {
    $profile_img_tmp = $_FILES['image']['tmp_name'];
    $upload = move_uploaded_file($profile_img_tmp, "../profile_img/" . $profile_img_name);
    if ($upload) {
        $insert_pro_img = "UPDATE `profile_images` SET `profile_img` = '$profile_img_name' WHERE `profile_images`.`user_id` = $user_id";
        $run = mysqli_query($con, $insert_pro_img);
        echo "1";
    }
}
