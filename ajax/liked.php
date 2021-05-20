<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$post_id = $_POST['postid'];
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);

$user_id = $fetch['id'];

$check_like = "SELECT * FROM likes WHERE p_id='$post_id' and liked_by_id = '$user_id'";
$run_like = mysqli_query($con, $check_like);
$fetch = mysqli_fetch_array($run_like);
if (mysqli_num_rows($run_like) > 0) {
    $status = $fetch['like_status'];
    if ($status == "liked") {
        $unlike = updatelike("unliked");
        if ($unlike == "1") {
            echo "0";
        }
    } else {
        $like = updatelike("liked");
        if ($like == "1") {
            echo "1";
        }
    }
} else {
    $insert = insertlike();
    if ($insert == "1") {
        echo "1";
    }
}
function updatelike($like)
{
    global $con, $user_id, $post_id;
    $update = "UPDATE likes SET like_status='$like' where p_id='$post_id' AND liked_by_id='$user_id'";
    $run = mysqli_query($con, $update);
    if ($run) {
        return "1";
    }
}
function insertlike()
{
    global $con, $user_id, $post_id;
    $update = "INSERT INTO likes (p_id,liked_by_id) VALUES ('$post_id','$user_id')";
    $run = mysqli_query($con, $update);
    if ($run) {
        return "1";
    }
}
