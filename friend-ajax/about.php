<?php
$friend_id = $_POST['friend_id'];
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_about = "SELECT * from users where id='$friend_id'";

$run_get_about = mysqli_query($con, $get_about);
$fetch = mysqli_fetch_array($run_get_about);
$martial_status = $fetch['martial_status'];
$work_at = $fetch['work_at'];
$from = $fetch['From?'];
$output = "";
if ($martial_status == "") {
    $output .= "<h3>About</h3>";
    $output .= "<b>Martial Status</b><br>";

} else {
    $output .= "<h3>About</h3>";
    $output .= "<b>Martial Status</b><br>";
    $output .= "<div class='d-flex martial-status'><i class='fa fa-heart py-2'></i><p>$martial_status</p></div>";

}
if ($from == "") {
    $output .= "<b>From  </b><br>";

} else {
    $output .= "<i class='fa fa-map-marker mr-2 py-2' style='font-size:20px;color:gray;'></i><b>From  </b>";
    $output .= "<span style='margin:0px;'>$from</span><br>";
}
if ($work_at == "") {
    $output .= "<b>Work at</b><br>";

} else {
    $output .= "<b>Work at</b>";
    $output .= "<p style='margin:0px;' class='pb-2'>$work_at</p>";
}
echo $output;
