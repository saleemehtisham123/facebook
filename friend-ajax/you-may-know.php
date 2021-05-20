<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$check_request = "SELECT * from friends where user_id='$user_id'";
$check_request_id = mysqli_query($con, $check_request);

$friends_id = [];
while ($check = mysqli_fetch_array($check_request_id)) {
    $friends_id[] = $check['friend_id'];
}

$get_users = "SELECT * FROM users u INNER JOIN profile_images p ON u.id = p.user_id where u.id!='$user_id' ORDER BY name ASC";
$run_get_users = mysqli_query($con, $get_users);

if ($run_get_users) {
    if (mysqli_num_rows($run_get_users) > 0) {
        while ($row = mysqli_fetch_array($run_get_users)) {
            $id = $row['id'];
            $name = $row['name'];
            $gender = $row['gender'];
            $prf_image = $row['profile_img'];
            $final_output = show_status($id, $gender, $name, $prf_image);
            echo $final_output;
        }
    }
} else {
    echo "<h1>Query Failed</h1>";
}

function show_status($id, $gender, $name, $prf_image)
{

    $output = "";
    global $con, $user_id, $friends_id;
    $gender_local = checkGender($gender, $prf_image);

    if (in_array($id, $friends_id)) {
        $output .= "";
    } else if (!in_array($id, $friends_id)) {
        // echo $id;
        $check_sent_by_id = "SELECT * FROM pending_requests WHERE sent_by_id='$id' AND reciever_id='$user_id'";
        $run_sent_by_id = mysqli_query($con, $check_sent_by_id);
        if (mysqli_num_rows($run_sent_by_id) > 0) {
            $output .= "<div class='w-100 p-2 mt-2 users-profile-link'><a href='other_users_profile.php?id=$id' class='users-id-anchor'>
                                <img src='profile_img/$gender_local' class='profile_img_logo mr-1' alt='Something went wrong'><b>$name </b></a><button class='btn btn-info accept_friend_request' data-id='$id'>Accept Request</button></div>";
        } else {
            $check_sent_by_id = "SELECT * FROM pending_requests WHERE sent_by_id='$user_id' AND reciever_id='$id'";
            $run_sent_by_id = mysqli_query($con, $check_sent_by_id);
            if (mysqli_num_rows($run_sent_by_id) > 0) {
                $output .= "<div class='w-100 p-2 mt-2 users-profile-link'><a href='other_users_profile.php?id=$id' class='users-id-anchor'>
                            <img src='profile_img/$gender_local' class='profile_img_logo mr-1' alt='Something went wrong'><b>$name </b></a><button class='btn btn-secondary add_friend' disabled='disabled'>Request Sent</button></div>";
            } else {
                $output .= "<div class='w-100 p-2 mt-2 users-profile-link'><a href='other_users_profile.php?id=$id' class='users-id-anchor'>
                            <img src='profile_img/$gender_local' class='profile_img_logo mr-1' alt='Something went wrong'><b>$name </b></a><button class='btn btn-primary add_friend' data-id='$id'>Add Friend</button></div>";
            }
        }
    }
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
