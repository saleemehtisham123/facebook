<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
if (!isset($_SESSION['email'])) {
    echo "<script>window.open('user_login.php','_self')</script>";
} else {
    $get_id = "SELECT * from users where email='$_SESSION[email]'";
    $run_id = mysqli_query($con, $get_id);
    $fetch = mysqli_fetch_array($run_id);
    $user_id = $fetch['id'];
    $user_name = strtok($fetch['name'], " ");
    $gender = $fetch['gender'];
    $check_profile_images = "SELECT * from profile_images where user_id='$user_id'" or die("Query Failed");
    $run_images = mysqli_query($con, $check_profile_images);
    $fetch_img = mysqli_fetch_array($run_images);
    $prf_img = $fetch_img['profile_img'];
    $prf_cover = $fetch_img['profile_cover'];
    $output = "";
    if ($gender == 'Male') {
        if ($prf_img == '') {
            $output .= "<div id='profile-image'><img src='icon/boy.jpg' alt='error' id='upload_profile_img' class='upload_profile_img'></div></div>";
            $output .= "<i class='fa fa-camera edit-pro-img' data-toggle='modal' data-target='#edit-profile-modal' title='Update Profile Image'></i>";
        } else {
            $output .= "<div id='profile-image'><img src='profile_img/$prf_img' alt='error' id='upload_profile_img' class='upload_profile_img'></div>";
            $output .= "<i class='fa fa-camera edit-pro-img' data-toggle='modal' data-target='#edit-profile-modal' title='Update Profile Image'></i>";
        }
        if ($prf_cover == '') {
            $output .= "<div id='profile-cover'><img src='icon/boy.jpg' alt='error' id='upload_profile_cover' class='upload_profile_cover'></div>";
            $output .= "<i class='fa fa-camera edit-pro-cover' data-toggle='modal' data-target='#edit-cover-modal' title='Update Cover photo'></i>";
        } else {
            $output .= "<div id='profile-cover'><img src='profile_img/$prf_cover' alt='error' id='upload_profile_cover' class='upload_profile_cover'></div>";
            $output .= "<i class='fa fa-camera edit-pro-cover' data-toggle='modal' data-target='#edit-cover-modal' title='Update Cover photo'></i>";
        }
        echo $output;
    } else {
        if ($prf_img == '') {
            $output .= "<div id='profile-image'><img src='icon/girl.jpg' alt='error' id='upload_profile_img' class='upload_profile_img'></div>";
            $output .= "<i class='fa fa-camera edit-pro-img' data-toggle='modal' data-target='#edit-profile-modal' title='Update Profile Image'></i>";
        } else {
            $output .= "<div id='profile-image'><img src='profile_img/$prf_img' alt='error' id='upload_profile_img' class='upload_profile_img'></div>";
            $output .= "<i class='fa fa-camera edit-pro-img' data-toggle='modal' data-target='#edit-profile-modal' title='Update Profile Image'></i>";
        }
        if ($prf_cover == '') {
            $output .= "<div id='profile-cover'><img src='icon/girl.jpg' alt='error' id='upload_profile_cover' class='upload_profile_cover'></div>";
            $output .= "<i class='fa fa-camera edit-pro-cover' data-toggle='modal' data-target='#edit-cover-modal' title='Update Cover photo'></i>";
        } else {
            $output .= "<div id='profile-cover'><img src='profile_img/$prf_cover' alt='error' id='upload_profile_cover' class='upload_profile_cover'></div>";
            $output .= "<i class='fa fa-camera edit-pro-cover' data-toggle='modal' data-target='#edit-cover-modal' title='Update Cover photo'></i>";
        }
        echo $output;
    }
}
