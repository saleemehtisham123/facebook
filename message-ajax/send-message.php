<?php
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$friend_id = $_POST['friend_id'];
$user_id = $_POST['user_id'];
$message = $_POST['message'];
// echo $friend_id . $user_id . $message;
$insert = "INSERT INTO messages (message_sent_to,message_sent_by,message) VALUES ('$friend_id','$user_id','$message')";
$run = mysqli_query($con, $insert);
if ($run) {
    $get_own = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$user_id'";
    $run_own = mysqli_query($con, $get_own);
    $fetch_own = mysqli_fetch_array($run_own);
    $name = $fetch_own['name'];
    $gender = $fetch_own['gender'];
    $profile_img = $fetch_own['profile_img'];
    $prf_img = checkGender($gender, $profile_img);
    $output = "<div class='prf-image-in-message-me text-right d-flex w-100 mb-2'><div class='ml-auto'><p class='mr-3'>$message</p></div><img src='profile_img/$prf_img'></div>";
    echo $output;
}
function checkGender($gender, $prf_image)
{

    if ($prf_image)
        return $prf_image;
    else {
        if ($gender == "Male")
            return "boy.jpg";
        else
            return "girl.jpg";
    }
}
