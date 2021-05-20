<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$old_password = $fetch['password'];


$entered_old = $_POST['old-password'];
$new_password = $_POST['newpass'];
$confirm_password = $_POST['cpass'];
$checkPass = checkpass($new_password, $confirm_password, $entered_old);

// echo $checkPass;
if ($checkPass == "PNM") {
    echo "PNM";
} else if ($checkPass == "OPNM")
    echo "OPNM";
else {
    $update_password = "UPDATE `users` SET `password` = '$new_password' WHERE `users`.`id` = $user_id;";
    $run_update = mysqli_query($con, $update_password);
    if ($run_update) {
        echo "PC";
    }
}

function checkpass($new_password, $confirm_password, $entered_old)
{
    global $old_password;
    if ($new_password != $confirm_password) {
        return "PNM";
    } else if ($new_password == $confirm_password) {
        if ($entered_old == $old_password)
            return "M";
        else
            return "OPNM";
    }
}
