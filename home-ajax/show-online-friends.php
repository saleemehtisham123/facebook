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
$final_output = "<table class='table table-responsive'><tr>";
if ($run_get_users) {
    if (mysqli_num_rows($run_get_users) > 0) {
        while ($row = mysqli_fetch_array($run_get_users)) {
            $id = $row['id'];
            $name = $row['name'];
            $gender = $row['gender'];
            $status = $row['status'];
            // echo $status . "<br>";
            $prf_image = $row['profile_img'];
            $final_output .= show_status($id, $gender, $name, $prf_image, $status);
        }
    }
} else {
    echo "<h1>Query Failed</h1>";
}

function show_status($id, $gender, $name, $prf_image, $status)
{

    $output = "";
    global $con, $user_id, $friends_id;
    $gender_local = checkGender($gender, $prf_image);

    if (in_array($id, $friends_id)) {
        if ($status != "offline") {
            $output .= "<th><div class='w-100 users-profile-link'><a href='other_users_profile.php?id=$id' class='users-id-anchor'>
                    <img src='profile_img/$gender_local' class='profile_img_logo mr-1' alt='Something went wrong'></a><i class='fa fa-circle' aria-hidden='true'></i></div></th>";
        }
    }
    return $output;
}
echo $final_output . "</tr></table>";
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
