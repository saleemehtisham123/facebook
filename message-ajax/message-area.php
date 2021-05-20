<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$final_output = "";
$check_message = "SELECT DISTINCT message_sent_by FROM messages where message_sent_to='$user_id'";
$run_check_message = mysqli_query($con, $check_message);
if (mysqli_num_rows($run_check_message) > 0) {
    while ($check = mysqli_fetch_array($run_check_message)) {;
        $message_by_id = $check['message_sent_by'];
        $made_message_area = messagearea($message_by_id);
        $final_output .= $made_message_area;
    }
    echo $final_output;
}
function messagearea($message_by_id)
{
    global $con;
    $output = "";
    $qry = "SELECT * FROM messages WHERE message_sent_by='$message_by_id' ORDER BY message_id DESC LIMIT 1";
    $run = mysqli_query($con, $qry);
    $fetch = mysqli_fetch_array($run);

    $message = substr($fetch['message'], 0, 20);
    $message_status = $fetch['message_status'];

    $get_users = "SELECT * FROM users u INNER JOIN profile_images p ON u.id = p.user_id where u.id='$message_by_id' ORDER BY name ASC";
    $run_get_users = mysqli_query($con, $get_users);
    $row = mysqli_fetch_array($run_get_users);
    $name = $row['name'];
    $surname = $row['surname'];
    $gender = $row['gender'];
    $check_profile_img = $row['profile_img'];
    $profile_img = checkGender($gender, $check_profile_img);
    $output .= "<div class='click-for-messages d-flex' data-friend-id=$message_by_id><img src='profile_img/$profile_img'>
               <div class='name-and-l-message name-and-l-message$message_by_id ml-2'><h3>$name $surname</h3>";
    if ($message_status == "unread") {
        $output .= "<span>$message</span>";
    } else {
        $output .= "<p>$message</p>";
    }
    $output .= "</div></div><hr>";

    return $output;
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
