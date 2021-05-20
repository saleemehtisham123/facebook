<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$work_at = $_POST['work_at'];

$update_work_at = "UPDATE `users` SET `work_at` = '$work_at' WHERE `users`.`email` = '$_SESSION[email]'";

$run = mysqli_query($con, $update_work_at);
if ($run) {
    echo "1";
}
