$(document).ready(function () {
    // -------------------------------------------------------------------------------Show Profile and Cover Photo

    function showPfCr() {
        var friend_id = $("#friend-id").val();
        $.ajax({
            url: "friend-ajax/other_users_profile_ajax_file.php",
            type: "post",
            data: { friend_id: friend_id },
            success: function (data) {
                // alert(data);
                $("#profile-img-cover").html(data);
            }
        });
    }
    showPfCr();
    // .................................................................................... full size profile image or cover

    $(document).on("click", "#upload_profile_img", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").slideDown(1000);
    });
    $(document).on("click", "#close-btn", function () {
        $("#fullsizeprforcovermodal").slideUp(1000);
    });
    $(document).on("click", "#upload_profile_cover", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").slideDown(1000);
    });
    // .................................................................................... full size post_image

    $(document).on("click", ".post_image", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").slideDown(1000);
    });
    // ....................................................................................about 
    function about() {
        var friend_id = $("#friend-id").val();
        // alert(friend_id);
        $.ajax({
            url: "friend-ajax/about.php",
            method: "post",
            data: { friend_id: friend_id },
            success: function (data) {
                $(".about").html(data);
            }
        });
    }
    about();
    $("#about-trigger").click(function () {
        $(".about-show-or-not").toggleClass("d-none");
    });
    // // ...............................................................................................send Request to friendd

    $(document).on("click", ".add_friend", function () {
        var id = $(this).data("id");
        var c = $(this);
        $.ajax({
            url: "friend-ajax/send_request.php",
            type: "post",
            data: { id: id },
            success: function (data) {
                // alert(data);
                if (data == "1") {
                    $(c).removeClass("btn-primary");
                    $(c).addClass("btn-secondary");
                    $(c).html("Request Sent");
                    $(c).attr("disabled", "disabled");
                }
            }
        });
    });
    // // ...................................................................................................show posts
    function showPosts() {
        var friend_id = $("#friend-id").val();
        $.ajax({
            url: "friend-ajax/show_other_user_posts.php",
            type: "post",
            data: { friend_id: friend_id },
            success: function (data) {
                $(".posts").html(data);
            }
        });
    }
    showPosts();

});
