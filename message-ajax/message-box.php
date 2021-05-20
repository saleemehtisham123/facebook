<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$friend_id = $_POST['friend_id'];
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$qry = "SELECT * FROM `messages` WHERE message_sent_to='$user_id' AND message_sent_by='$friend_id'";
$run = mysqli_query($con, $qry);
while ($fetch = mysqli_fetch_array($run)) {
    $message_status =  $fetch['message_status'];
    if ($message_status == "unread") {
        $update_status = "UPDATE messages SET message_status='read' WHERE message_sent_to='$user_id' AND message_sent_by='$friend_id'";
        $run_update = mysqli_query($con, $update_status);
    }
}
$finaloutput = "";
$get_messages = "SELECT * FROM `messages` WHERE message_sent_to='$user_id' AND message_sent_by='$friend_id' OR
                 message_sent_to='$friend_id' AND message_sent_by='$user_id' ORDER BY message_id DESC";
$run_get = mysqli_query($con, $get_messages);
if (mysqli_num_rows($run_get) > 0) {
    while ($fetch_message = mysqli_fetch_array($run_get)) {
        $message_s_b = $fetch_message['message_sent_by'];
        $own_prf_img = getuser($user_id);
        $profile_img = checkGender($own_prf_img);
        $finaloutput .= finaloutput($message_s_b, $fetch_message);
    }
    $finaloutput .= "<div id='close-btn'>
                    <p>X</p>
                </div>";
    $finaloutput .= "<div class='send-message d-flex'><img src='profile_img/$profile_img'>
                        <form id='send-message-form' data-user-id='$user_id' data-friend-id='$friend_id' class='d-flex w-100'>
                            <input type='text' id='message' placeholder='type a message'>
                            <button class='btn btn-info ml-2' type='submit'>send</button>
                         </from>
                    </div>";
    echo $finaloutput;
}
function finaloutput($message_s_b, $fetch_message)
{
    $output = "";
    global $user_id;
    $message = $fetch_message['message'];
    $get_user = getUser($message_s_b);
    $prf_img = checkGender($get_user);
    // echo $prf_img . "<br>";
    if ($message_s_b == $user_id) {
        $output = "<div class='prf-image-in-message-me text-right d-flex w-100 mb-2'><div class='ml-auto'><p class='mr-3'>$message</p></div><img src='profile_img/$prf_img'></div>";
    } else {
        $output = "<div class='prf-image-in-message-friend d-flex w-100 mb-2'><img src='profile_img/$prf_img'><div class='ml-3'><p>$message</p></div></div>";
    }
    return $output;
}
function getUser($id)
{
    global $con;
    $get_user = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$id'";
    $run_get_users = mysqli_query($con, $get_user);
    $fetch_user_data = mysqli_fetch_array($run_get_users);
    return $fetch_user_data;
}
function checkGender($profile_img)
{
    $prf_image = $profile_img['profile_img'];
    $gender = $profile_img['gender'];
    if ($prf_image)
        return $prf_image;
    else {
        if ($gender == "Male")
            return "boy.jpg";
        else
            return "girl.jpg";
    }
}
