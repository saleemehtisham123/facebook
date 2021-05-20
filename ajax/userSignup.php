<?php
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$check_user = "SELECT * from users where email='$email'";
$result = mysqli_query($con, $check_user);
if (mysqli_num_rows($result) > 0) {
    echo "UE";
} else {
    if ($pass == $cpass) {

        $sql = "INSERT into users (name,surname,email,password,DOB,gender,status)
 VALUES ('$name','$surname','$email','$pass','$DOB','$gender','')";
        $run = mysqli_query($con, $sql);

        if ($run) {
            $user_id = "SELECT * from users where email='$email'";
            $run = mysqli_query($con, $user_id);
            $fetch = mysqli_fetch_array($run);
            $id = $fetch['id'];
            $insert_empty_img = "INSERT into profile_images (profile_img,profile_cover,user_id) VALUES ('','','$id')";
            $run_empty_img = mysqli_query($con, $insert_empty_img);
            if ($run_empty_img) {
                echo "DS";
            }
        } else {
            echo "QF";
        }
    } else {
        echo "PNM";
    }
}
