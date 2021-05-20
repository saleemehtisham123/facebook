<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

$friend_id = $_POST['id'];

$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];

$accept = "DELETE FROM pending_requests WHERE sent_by_id='$friend_id' AND reciever_id='$user_id'";
$run_accept = mysqli_query($con, $accept);
if ($run_accept) {
    $insert_friend = "INSERT INTO friends (user_id,friend_id) VALUES ('$friend_id','$user_id'),('$user_id','$friend_id')";
    $insert = mysqli_query($con, $insert_friend);
    if ($insert)
        echo "1";
}
