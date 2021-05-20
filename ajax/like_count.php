<?php
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$post_id = $_POST['post_id'];
$check_like = "SELECT * FROM likes WHERE p_id='$post_id' and like_status='liked'";
$run_like = mysqli_query($con, $check_like);
$totallikes = mysqli_num_rows($run_like);
if ($totallikes > 0) {
    if ($totallikes == "1") {
        echo "$totallikes Like";
    } else {
        echo "$totallikes Likes";
    }
}
