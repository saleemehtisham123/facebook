<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$qry = "SELECT * FROM `messages` WHERE message_sent_to='$user_id'";
$run = mysqli_query($con, $qry);
$count = "0";
if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_array($run)) {
        $status = $row['message_status'];
        if ($status == "unread") {
            $count = $count + 1;
        }
    }
}
if ($count > 0) {
    $count = "<span>$count<span>";
    echo $count;
}
