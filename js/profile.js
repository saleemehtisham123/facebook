$(document).ready(function () {

    // -------------------------------------------------------------------------------Edit Profile Image 

    $(document).on("click", "#edit-pro-img", function () {
        $("#profile_img").trigger("click")
    });
    $("#profile_img").change(function () {
        $("#profile_img_form").trigger("submit");
    });
    $("#profile_img_form").on("submit", function (e) {
        e.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            url: "ajax/profile_image.php",
            type: "post",
            data: form_data,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "1") {
                    showPfCr();
                    showProfimgHeader()
                    showInsertPostImg()
                }
            }
        });
    });
    // -------------------------------------------------------------------------------Edit Profile cover

    $(document).on("click", "#edit-pro-cover", function () {
        var a = $("#profile_cover").trigger("click");

    });
    $("#profile_cover").change(function () {
        $("#profile_cover_form").trigger("submit");
    });
    $("#profile_cover_form").on("submit", function (e) {
        e.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            url: "ajax/profile_cover.php",
            type: "post",
            data: form_data,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "1") {
                    showPfCr();
                }
            }
        });
    });
    // -------------------------------------------------------------------------------delete profile Image 
    $(document).on("click", "#delete-pro-img", function () {
        $.ajax({
            url: "ajax/delete_profile_img.php",
            type: "post",
            success: function (data) {
                if (data == "1") {
                    showPfCr();
                    showProfimgHeader()
                    showInsertPostImg()
                }
            }
        });
    });
    // -------------------------------------------------------------------------------delete profile Cover

    $(document).on("click", "#delete-pro-cover", function () {
        $.ajax({
            url: "ajax/delete_cover_img.php",
            type: "post",
            success: function (data) {
                if (data == "1") {
                    showPfCr();
                }
            }
        });
    });
    // -------------------------------------------------------------------------------Show Profile and Cover Photo

    function showPfCr() {
        $.ajax({
            url: "ajax/loadProfile_cover.php",
            type: "post",
            success: function (data) {
                $("#profile-img-cover").html(data);
            }
        });
    }
    showPfCr();
    // .................................................................................... full size profile image or cover

    $(document).on("click", "#upload_profile_img", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").fadeIn(1000);
    });
    $(document).on("click", "#close-btn", function () {
        $("#fullsizeprforcovermodal").fadeOut(1000);
    });
    $(document).on("click", "#upload_profile_cover", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").fadeIn(1000);
    });
    // .................................................................................... full size post_image

    $(document).on("click", ".post_image", function () {
        var prfimage = $(this).attr("src");
        $("#fullsizeimage img").attr("src", prfimage)
        $("#fullsizeprforcovermodal").fadeIn(1000);
    });

    // ....................................................................................about 
    function about() {
        $.ajax({
            url: "ajax/about.php",
            method: "post",
            success: function (data) {
                $(".about").html(data);
            }
        });
    }
    about();
    $("#about-trigger").click(function () {
        $(".about-show-or-not").toggleClass("d-none");
    });
    $(document).on("click", "#edit-martial-status", function () {
        $("#update_martial_status").toggleClass("d-none");
    });
    $(document).on("change", ".martial_status", function () {
        var martial_status = $("input[name='martial_status']:checked").val();
        $.ajax({
            url: "ajax/martial_status.php",
            type: "post",
            data: { martial_status: martial_status },
            success: function (data) {
                if (data == "1") {
                    about();
                }
            }
        });
    });
    $(document).on("click", "#edit-work-at", function () {
        $("#work-at").toggleClass("d-none");
        $("#submit-work-at").toggleClass("d-none");
    });
    $(document).on("click", "#submit-work-at", function () {
        var work_at = $("input[id='work-at']").val();
        $.ajax({
            url: "ajax/work-at.php",
            type: "post",
            data: { work_at: work_at },
            success: function (data) {
                if (data == "1") {
                    about();
                    // $("#work-at").toggleClass("d-none");
                }
            }
        });
    });
    $(document).on("click", "#edit-from", function () {
        $("#from").toggleClass("d-none");
        $("#submit-from").toggleClass("d-none");
    });
    $(document).on("click", "#submit-from", function () {
        var from = $("input[id='from']").val();
        $.ajax({
            url: "ajax/from.php",
            type: "post",
            data: { from: from },
            success: function (data) {
                if (data == "1") {
                    about();
                    // $("#work-at").toggleClass("d-none");
                }
            }
        });
    });

    // ...................................................................................................show posts
    function showPosts() {
        $.ajax({
            url: "ajax/show_posts_in_profile.php",
            type: "post",
            success: function (data) {
                $("#show_posts_append").html(data);
            }
        });
    }
    showPosts();

});
