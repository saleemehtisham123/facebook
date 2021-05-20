<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$user_id = $_GET['user'];
$update_status = "UPDATE `users` SET `status` = 'offline' WHERE `users`.`id` = '$user_id'";
$run = mysqli_query($con, $update_status);
if ($run) {
    session_unset();
    session_destroy();
    echo "<script>window.open('user_login.php','_self')</script>";
}
