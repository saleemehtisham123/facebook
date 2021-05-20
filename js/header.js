$(document).ready(function () {
    // -------------------------------------------------------------------home header 
    function showProfimgHeader() {
        $.ajax({
            url: "ajax/loadProfile_img_header.php",
            type: "post",
            success: function (data) {
                $(".profile").html(data);
            }
        });
    }
    showProfimgHeader();
    // -------------------------------------------------------------------unread message count
    function unreadmessagecount() {
        $.ajax({
            url: "message-ajax/unread-message-count.php",
            type: "Post",
            success: function (data) {
                $(".message i").html(data);
            }
        });
    }
    unreadmessagecount();
    // -------------------------------------------------------------------notification dropdown 

    $(".notification-icon").click(function () {
        $(".notification-drop").toggleClass("d-none");
        $(".notification-icon i").toggleClass("text-primary")
    });
    // -------------------------------------------------------------------setting dropdown 
    function setting_drop() {
        $.ajax({
            url: "home-ajax/setting-drop.php",
            method: "post",
            success: function (data) {
                $(".setting-drop").html(data);
            }
        });
    }
    setting_drop();
    $(".setting-and-logout").click(function () {
        $(".setting-drop").toggleClass("d-none");
        $(".setting-and-logout i").toggleClass("text-primary")
    });
    // ...................................................................................................setting modal
    //show modal box
    $(document).on("click", ".setting", function () {
        $("#profile-setting-modal").fadeIn(1000);
    });
    //hide modal box
    $(document).on("click", "#close-btn", function () {
        $("#profile-setting-modal").fadeOut(1000);
    });
    // ...................................................................................................get setting data
    function get_setting_data() {
        $.ajax({
            url: "home-ajax/get_setting_data.php",
            method: "post",
            success: function (data) {
                $(".change-data").html(data);
            }
        });
    }
    get_setting_data()
    // ............................................................................................update data

    //update facebook account
    $(document).on("submit", "#submit-form", function (e) {
        e.preventDefault();
        var formdata = new FormData(this);

        $.ajax({
            url: 'home-ajax/update-data.php',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "PC") {
                    $(".change-password").addClass("d-none");
                    $("#change-password").removeAttr("disabled", "disabled");
                    $("#submit-form").trigger("reset");
                    $("#profile-setting-modal").fadeOut(1000);
                    $('.success-msg').html("Password Changed Successfully");
                    $('.success-msg').fadeIn();
                    setTimeout(function () {
                        $('.success-msg').fadeOut();
                    }, 5000)
                }
                if (data == "PNM") {
                    $('.error-msg').html("Password Not Matched");
                    $('.error-msg').fadeIn();
                    setTimeout(function () {
                        $('.error-msg').fadeOut();
                    }, 5000)
                }
                if (data == "OPNM") {
                    $('.error-msg').html("Old Password is Incorrect");
                    $('.error-msg').fadeIn();
                    setTimeout(function () {
                        $('.error-msg').fadeOut();
                    }, 5000)
                }
            }

        });
    });

    $(document).on("click", "#change-password", function () {
        $(".change-password").removeClass("d-none");
        $(this).attr("disabled", "disabled");
    });
    // ........................................................................... profile_img_for insert post

    function showInsertPostImg() {
        $.ajax({
            url: "ajax/load-prof-img-for-insert-post.php",
            type: "post",
            success: function (data) {
                $("#insert-post-prof-img").prepend(data);
                $(".insert-post-modal-inner").prepend(data);
            }
        });
    }
    showInsertPostImg();
    // .............................................................................................posts modal
    //show modal box
    $("#insert-post-prof-img input").click(function () {
        $("#post-modal").fadeIn(1000);
    });
    //hide modal box
    $(document).on("click", "#close-btn", function () {
        $("#post-modal").fadeOut(1000);
    });
    // ......................................................................................insert posts

    $("#submit-post-form").on("submit", function (e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: "ajax/insert_post.php",
            type: "post",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "1") {
                    $("#submit-post-form").trigger("reset");
                    $('.success-msg').html("Post Inserted Successfully");
                    $('.success-msg').fadeIn();
                    setTimeout(function () {
                        $('.success-msg').fadeOut();
                    }, 5000)
                    $("#modal").fadeOut(1000);
                }
            }
        });
    });
    // ...................................................................................................like 
    $(document).on("click", "#trigger-like", function () {
        var postId = $(this).data("post-id");
        $(this).toggleClass("text-secondary")
        $(this).toggleClass("text-primary")
        $.ajax({
            url: "ajax/liked.php",
            type: "post",
            data: { postid: postId },
            success: function (data) {
                if (data == "1") {
                    var audio = new Audio();
                    audio.src = "facebooklike.sound.mp3";
                    audio.play();
                    $("#trigger-like").removeClass("text-secondary");
                    $("#trigger-like").addClass("text-primary");
                    likecount(postId);
                } else {
                    $("#trigger-like").removeClass("text-primary")
                    $("#trigger-like").addClass("text-secondary")
                    likecount(postId);
                }
            }
        });
    });
    // ...................................................................................................like count
    function likecount(post_id) {
        var post_id = post_id;
        $.ajax({
            url: "ajax/like_count.php",
            type: "post",
            data: { post_id: post_id },
            success: function (data) {
                $("#like-count-" + post_id).html(data);
            }
        });
    }
    // // ...........................................................................insert comment input field show

    $(document).on("keypress", ".comment-by", function (event) {
        if (event.which == 13) {
            var post_id = $(this).data("post-id");
            var comment = $(this).val();
            var comment_reset = $(this);
            var page_no = $("#load-more-comment" + post_id).data("page");
            var load_more_id = "load-more-comment" + post_id;
            var load_c = "no";
            if (comment != "") {
                $.ajax({
                    url: "ajax/insert-comment.php",
                    type: "Post",
                    data: { post_id: post_id, comment: comment },
                    success: function (data) {
                        loadcomment(post_id, load_c, page_no, load_more_id);
                        $(comment_reset).blur();
                        $(comment_reset).val("");
                    }
                });
            }
        }
    });
    // // ...........................................................................load comment

    function loadcomment(post_id, load_c, page_no, load_more_id, button) {
        var post_id = post_id;
        var page_no = page_no;
        var load_more_id = load_more_id;
        var button = button;
        // alert(post_id);
        $.ajax({
            url: "ajax/load-comment.php",
            type: "Post",
            data: { post_id: post_id, page_no: page_no, load_c: load_c },
            success: function (data) {
                if (data != 0) {
                    if (load_c == "yes") {
                        $("#" + load_more_id).remove();
                        $(".full-comment" + post_id).remove();
                        $("#comment-by" + post_id).html("");
                        $("#comment" + post_id).append(data);
                    } else {
                        // alert(data);
                        $("#" + load_more_id).remove();
                        $("#comment" + post_id).append(data);
                    }
                } else {
                    $(button).html("No more Comments");
                }
            }
        });
    }
    // // ...........................................................................pagination
    $(document).on("click", ".load-more-comment", function () {
        var button = $(this);
        var load_c = "yes";
        var p_id = $(this).data("post-id");
        var load_more_id = $(this).attr("id");
        var page_no = $(this).data("page");
        loadcomment(p_id, load_c, page_no, load_more_id, button)
    });
    $(document).on("click", ".trigger-comment", function () {
        var post_id = $(this).data("post-id");
        $(".comment-area-toggle" + post_id).toggle(1000);
    });
});