    <?php
    $con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
    $post_id = $_POST['post_id'];
    if (isset($_POST['page_no'])) {
        $page_no = $_POST['page_no'];
        $i = $page_no;
    } else {
        $i = "0";
    }
    $limit = "5";
    $load_c = $_POST['load_c'];
    if ($load_c == "yes") {
        $comment = "SELECT * FROM comments where POST_ID='$post_id' LIMIT $i,$limit";
        $run = mysqli_query($con, $comment);
        if (mysqli_num_rows($run) > 0) {
            $output = "";
            $profile_img = "";

            while ($fetch = mysqli_fetch_array($run)) {

                $comment_by = $fetch['comment_by'];
                $comment = $fetch['comment'];
                $get_user = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$comment_by'";
                $run_get_users = mysqli_query($con, $get_user);
                $fetch_user_data = mysqli_fetch_array($run_get_users);
                $profile_img = checkGender($fetch_user_data);
                $name = $fetch_user_data['name'];
                $output .= "<a href='other_users_profile.php?id=$comment_by' class='comment-anchor'>
                           <div class='d-flex full-comment'>
                                <div class='comment-by'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><img src='profile_img/$profile_img' alt='Something went Wrong'></a>
                                </div>
                                <div class='comment'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><b>$name</b></a><br>
                                    <p>$comment</p>
                                </div>
                            </div>
                        </a>";
                $i++;
            }
            $output .= "<p class='load-more-comment' data-post-id='$post_id' data-page='$i' id='load-more-comment$post_id'>Load More Comments</p>";
            echo $output;
        } else {
            echo 0;
        }
    } else {
        $comment = "SELECT * FROM comments where POST_ID='$post_id' ORDER BY comment_id DESC LIMIT 1";
        $run = mysqli_query($con, $comment);
        if (mysqli_num_rows($run) > 0) {
            $output = "";
            $profile_img = "";
            $fetch = mysqli_fetch_array($run);

            $comment_by = $fetch['comment_by'];
            $comment = $fetch['comment'];
            $get_user = "SELECT * FROM users U INNER JOIN profile_images p ON u.id=p.user_id WHERE u.id='$comment_by'";
            $run_get_users = mysqli_query($con, $get_user);
            $fetch_user_data = mysqli_fetch_array($run_get_users);
            $profile_img = checkGender($fetch_user_data);
            $name = $fetch_user_data['name'];
            $output .= "<a href='other_users_profile.php?id=$comment_by' class='comment-anchor'>
                           <div class='d-flex full-comment$post_id'>
                                <div class='comment-by'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><img src='profile_img/$profile_img' alt='Something went Wrong'></a>
                                </div>
                                <div class='comment'>
                                    <a href='other_users_profile.php?id=$comment_by' class='comment-anchor'><b>$name</b></a><br>
                                    <p>$comment</p>
                                </div>
                            </div>
                        </a>";
            $output .= "<p class='load-more-comment' data-post-id='$post_id' data-page='$i' id='load-more-comment$post_id'>Load More Comments</p>";
            echo $output;
        } else {
            echo 0;
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
