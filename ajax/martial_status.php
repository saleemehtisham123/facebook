<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$martial_status = $_POST['martial_status'];

$update_martial_status = "UPDATE `users` SET `martial_status` = '$martial_status' WHERE `users`.`email` = '$_SESSION[email]'";

$run = mysqli_query($con, $update_martial_status);
if ($run) {
    echo "1";
}
