<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$sent_to_id = $_POST['id'];

$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];

$inert_request = "INSERT INTO pending_requests (sent_by_id,reciever_id) VALUES ('$user_id','$sent_to_id')";
$run_insert_request = mysqli_query($con, $inert_request);
if ($run_insert_request) {
    echo "1";
}
