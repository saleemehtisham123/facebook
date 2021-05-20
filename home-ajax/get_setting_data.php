<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");

$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$name = $fetch['name'];
$surname = $fetch['surname'];
$email = $fetch['email'];
$DOB = $fetch['DOB'];
$gender = $fetch['gender'];
$output = "";
$output .= '<div class="row">
    <div class="col-6">
        <input type="text" placeholder="First name" class="form-control" value=' . $name . ' name="name" disabled>
    </div>
    <div class="col-6">
        <input type="text" placeholder="Surname" class="form-control" value=' . $surname . ' name="surname" disabled>
    </div>
    <div class="col-12 mt-2">
        <input type="text" minlength="10" placeholder="Mobile number or Emial address" class="form-control" value=' . $email . ' name="email" disabled>
    </div>
    <div class="col-12 mt-2 signup-date">
        <label>Date of Birth</label>
        <input type="date" id="date" class="form-control" value=' . $DOB . ' name="DOB" disabled>
    </div>
    <div class="col-12 mt-2 signup-gender">
        <label>Gender</label>
        <input type="text" class="form-control" value=' . $gender . ' disabled>
    </div>
    <div class="col-12 mt-2 text-center">
        <input id="change-password" type="button" class="btn btn-success w-50" value="Change Password">
    </div>

    <div class="col-12 mt-2 text-center change-password d-none">
        <form id="submit-form">
            <div class="row">
                <div class="col-12">
                    <input type="password" placeholder="Old Password" class="form-control" name="old-password" required>
                </div>
                <div class="col-6 mt-2">
                    <input type="password" placeholder="New Password" class="form-control" name="newpass" required>
                </div>
                <div class="col-6 mt-2">
                    <input type="password" placeholder="Confirm New Password" class="form-control" name="cpass" required>
                </div>
                <div class="col-12 mt-2 text-right">
                    <input class="btn btn-info w-25" type="submit" name="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>';
echo $output;
