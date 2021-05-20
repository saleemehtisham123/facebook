<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$from = $_POST['from'];

$update_from = "UPDATE `users` SET `from?` = '$from' WHERE `users`.`email` = '$_SESSION[email]'";

$run = mysqli_query($con, $update_from);
if ($run) {
    echo "1";
}
