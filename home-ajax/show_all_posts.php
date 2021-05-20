<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
$get_id = "SELECT * from users where email='$_SESSION[email]'";
$run_id = mysqli_query($con, $get_id);
$fetch = mysqli_fetch_array($run_id);
$user_id = $fetch['id'];
$gender = $fetch['gender'];
// $name = $fetch['name'];
// $surname = $fetch['surname'];
$own_profile_img = "";
$get_own_proile_img = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$user_id'";
$run = mysqli_query($con, $get_own_proile_img);
$fetch_own_profile_img = mysqli_fetch_array($run);
$own_profile_img = checkGender($fetch_own_profile_img);

$check_friends = "SELECT * from friends where user_id='$user_id'";
$friends_id_sql = mysqli_query($con, $check_friends);
$friends_id = [];
while ($check = mysqli_fetch_array($friends_id_sql)) {
    $friends_id[] = $check['friend_id'];
}
$get_posts = "SELECT * FROM posts order by rand()";
$run_get_posts = mysqli_query($con, $get_posts);
$output = "";
if (mysqli_num_rows($run_get_posts) > 0) {
    while ($row = mysqli_fetch_array($run_get_posts)) {
        if (in_array($row['user_id'], $friends_id) || $row['user_id'] == $user_id) {

            $like_info = get_like_info($row['post_id'], $user_id);
            $total_likes = like_count($row['post_id']);
            $comments = comments($row['post_id']);
            $post_info = get_post_info($row['user_id']);
            $check_g_p = checkGender($post_info);
            $output = allPosts($row, $post_info, $like_info, $check_g_p, $total_likes, $comments, $own_profile_img);
            echo $output;
        }
    }
} else {
    $output .= "<div class='show-posts p-3 mt-4'><h1>hello</h1></div>";
}

function allPosts($row, $post_info, $like_info, $check_g_p, $total_likes, $comments, $own_profile_img)
{
    $output = "";
    $user_id = $post_info['user_id'];
    $name = $post_info['name'];
    $surname = $post_info['surname'];
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_image = $row['post_image'];
    $post_date = $row['post_date'];

    $output .= "<div class='show-posts p-3 mt-4'>";

    $output .= "<div class='post-top'><a href='other_users_profile.php?id=$user_id' class='profile-anchor'>
    <img src='profile_img/$check_g_p' alt='error'>";

    $output .= "<b class='ml-2'>$name $surname</b></a><br><b class='ml-2'>$post_date</b></div>";
    $output .= "<div class='d-flex mt-2'><p>$post_title</p></div>";
    $output .= "<div class=''><img src='post_images/$post_image' class='w-100'></div><p id='like-count-$post_id' class='like-count'>$total_likes</p>";
    $output .= "<div class='d-flex post-bottom mt-2 p-3'>";
    if ($like_info == "not liked") {
        $output .=  "<div class='trigger-like w-33 text-center text-secondary' id='trigger-like' data-post-id='$post_id'><i class='fa fa-thumbs-o-up'></i><b class='ml-1'>Like</b></div>";
    } else {
        $output .=  "<div class='trigger-like w-33 text-center text-primary' id='trigger-like' data-post-id='$post_id'><i class='fa fa-thumbs-o-up'></i><b class='ml-1'>Like</b></div>";
    }
    $output .=  "<div class='trigger-comment w-33 text-center' data-post-id='$post_id'><i class='fa fa-commenting-o'></i><b class='text-secondary ml-1'>Comment</b></div>
                <div class='trigger-share w-33 text-center'><i class='fa fa-share'></i><b class='text-secondary ml-1'>Share</b></div>
                </div>";

    $output .= "<div class='comment-area comment-area-toggle$post_id p-3 mt-2'><div id='comment$post_id'>$comments</div>
                  <div class='insert_comment'>
                     <img src='profile_img/$own_profile_img' alt='error'>
                      <input type='text' class='comment-by' id='comment-by$post_id' data-post-id='$post_id' placeholder='Add your comment'>  
                  </div>
               </div>";


    $output .= "</div>";
    return $output;
}
function comments($post_id)
{
    $limit = "1";
    global $con;
    $comment = "SELECT * FROM comments where POST_ID='$post_id' LIMIT 0,$limit";
    $run = mysqli_query($con, $comment);
    if (mysqli_num_rows($run) > 0) {
        $output = "";
        $profile_img = "";
        $i = "0";
        while ($fetch = mysqli_fetch_array($run)) {
            $comment_by = $fetch['comment_by'];
            $comment = $fetch['comment'];
            $get_user = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$comment_by'";
            $run_get_users = mysqli_query($con, $get_user);
            $fetch_user_data = mysqli_fetch_array($run_get_users);
            // $profile_img = $fetch_user_data['profile_img'];
            $profile_img = checkGender($fetch_user_data);
            $name = $fetch_user_data['name'];
            $output .= "
                           <div class='d-flex full-comment'>
                                <div class='comment-by'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><img src='profile_img/$profile_img' alt='Something went Wrong'></a>
                                </div>
                                <div class='comment'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><b>$name</b></a><br>
                                    <p>$comment</p>
                                </div>
                            </div>
                        
                            ";
            $i++;
        }

        $output .= "<p class='load-more-comment' data-post-id='$post_id' data-page='$i' id='load-more-comment$post_id'>Load More Comments</p>";
        return $output;
    }
}
function get_post_info($id)
{
    global $con;
    $sql = "SELECT * FROM users u INNER JOIN profile_images p ON u.id = p.user_id where id='$id'";
    $run = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_array($run);
    if (mysqli_num_rows($run) > 0) {
        return $fetch;
    }
}
function get_like_info($post_id, $user_id)
{
    global $con;
    $check_like = "SELECT * FROM likes WHERE p_id='$post_id' and liked_by_id = '$user_id'";
    $run_like = mysqli_query($con, $check_like);
    $fetch = mysqli_fetch_array($run_like);
    if (mysqli_num_rows($run_like) > 0) {
        $status = $fetch['like_status'];
        if ($status == "liked") {
            return "liked";
        } else {
            return "not liked";
        }
    } else {
        return "not liked";
    }
}
function like_count($post_id)
{
    global $con;
    $check_like = "SELECT * FROM likes WHERE p_id='$post_id' and like_status='liked'";
    $run_like = mysqli_query($con, $check_like);
    $totallikes = mysqli_num_rows($run_like);
    // return $totallikes;
    if ($totallikes > 0) {
        if ($totallikes == 1) {
            return $totallikes . " Like";
        } else {
            return $totallikes . " Likes";
        }
    } else {
    }
}

function checkGender($post_info)
{
    $prf_image = $post_info['profile_img'];
    $gender = $post_info['gender'];
    if ($prf_image)
        return $prf_image;
    else {
        if ($gender == "Male")
            return "boy.jpg";
        else
            return "girl.jpg";
    }
}
