
  <?php
  session_start();
  $con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
  $get_id = "SELECT * from users where email='$_SESSION[email]'";
  $run_id = mysqli_query($con, $get_id);
  $fetch = mysqli_fetch_array($run_id);
  $user_id = $fetch['id'];
  $post_id = $_POST['post_id'];
  $comment = addslashes($_POST['comment']);

  $insert_comment = "INSERT INTO comments (POST_ID,comment_by,comment) VALUES ('$post_id','$user_id','$comment')";
  $run = mysqli_query($con, $insert_comment);
  if ($run) {
    echo 1;
  }
