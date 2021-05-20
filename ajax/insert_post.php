<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$post_title = addslashes($_POST['post-title']);
$post_date = date('Y-m-d');

$post_img_name = addslashes($_FILES['post-file']['name']);
$file_extension = pathinfo($post_img_name, PATHINFO_EXTENSION);
$valid_extensions = array("jpg", "jpeg", "png");
if (in_array($file_extension, $valid_extensions)) {
    $profile_img_tmp = $_FILES['post-file']['tmp_name'];
    $upload = move_uploaded_file($profile_img_tmp, "../post_images/" . $post_img_name);
    if ($upload) {
        $insert_post = "INSERT INTO posts (post_title,post_image,post_date,user_id) VALUES ('$post_title','$post_img_name','$post_date','$user_id')";
        $run = mysqli_query($con, $insert_post);
        echo "1";
    }
}
