<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$martial_status = $fetch['martial_status'];
$work_at = $fetch['work_at'];
$from = $fetch['From?'];
$output = "";
if ($martial_status == "") {
    $output .= "<h3>About</h3>";
    $output .= "<b>Martial Status</b><br>";
    $output .= "Single<input type='radio' name='martial_status' value='Single' class='ml-2 martial_status'>
    Married<input type='radio' name='martial_status' value='Married' class='ml-2 martial_status'><br>";
    $output .= "<button class='btn btn-success' id='edit-martial-status'>Edit</button><br>";
} else {
    $output .= "<h3>About</h3>";
    $output .= "<b>Martial Status</b><br>";
    $output .= "<div class='d-flex martial-status'><i class='fa fa-heart py-2'></i><p>$martial_status</p></div>";
    $output .= "<div class='d-none' id='update_martial_status'>Single<input type='radio' name='martial_status' value='Single' class='ml-2 martial_status'>
    Married<input type='radio' name='martial_status' value='Married' class='ml-2 martial_status'><br></div>";
    $output .= "<button class='btn btn-success' id='edit-martial-status'>Edit</button><br>";
}
if ($from == "") {
    $output .= "<b>From  </b><br>";
    $output .= "<input type='text' name='from' class='ml-2 mb-2 d-none form-control' id='from'>";
    $output .= "<button class='btn btn-success' id='edit-from'>Edit</button>";
    $output .= "<button class='btn btn-success ml-2 d-none' id='submit-from'>submit</button><br>";
} else {
    $output .= "<i class='fa fa-map-marker mr-2 py-2' style='font-size:20px;color:gray;'></i><b>From  </b>";
    $output .= "<span style='margin:0px;'>$from</span><br>";
    $output .= "<input type='text' name='from' value='$from' class='ml-2 mb-2 d-none form-control' id='from'>";
    $output .= "<button class='btn btn-success mb-2' id='edit-from'>Edit</button>";
    $output .= "<button class='btn btn-success ml-2 d-none' id='submit-from'>submit</button><br>";
}
if ($work_at == "") {
    $output .= "<b>Work at</b><br>";
    $output .= "<input type='text' name='work-at' class='ml-2 mb-2 d-none form-control' id='work-at'>";
    $output .= "<button class='btn btn-success' id='edit-work-at'>Edit</button>";
    $output .= "<button class='btn btn-success ml-2 d-none' id='submit-work-at'>submit</button><br>";
} else {
    $output .= "<b>Work at</b>";
    $output .= "<p style='margin:0px;' class='pb-2'>$work_at</p>";
    $output .= "<input type='text' name='work-at' value='$work_at' class='ml-2 mb-2 d-none form-control' id='work-at'>";
    $output .= "<button class='btn btn-success' id='edit-work-at'>Edit</button>";
    $output .= "<button class='btn btn-success ml-2 d-none' id='submit-work-at'>submit</button><br>";
}
echo $output;
