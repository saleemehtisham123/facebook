$(document).ready(function () {
    // ......................................................................................online friends
    function showOnlineFriends() {
        $.ajax({
            url: "home-ajax/show-online-friends.php",
            type: "post",
            success: function (data) {
                $(".online-friends").html(data);
            }
        });
    }
    showOnlineFriends()
    // ......................................................................................show message area
    function message_area() {
        $.ajax({
            url: "message-ajax/message-area.php",
            method: "post",
            success: function (data) {
                $(".message-area").html(data);
            }
        })
    }
    message_area()
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
    // ......................................................................................message modal
    $(document).on("click", ".click-for-messages", function () {
        var friend_id = $(this).data("friend-id");
        $.ajax({
            url: "message-ajax/message-box.php",
            type: "post",
            data: { friend_id: friend_id },
            success: function (data) {
                unreadmessagecount();
                $("#message-modal-form").html(data);
                $("#message-modal").fadeIn();
                $(".name-and-l-message" + friend_id + " span").css({ "font-weight": "100" });
            }
        });
    });
    $(document).on("click", "#close-btn", function () {
        $("#message-modal").fadeOut(1000);
    });
    // ......................................................................................message modal
    $(document).on("submit", "#send-message-form", function (event) {
        event.preventDefault();
        var user_id = $(this).data("user-id");
        var friend_id = $(this).data("friend-id");
        var message = $("#message").val();
        $.ajax({
            url: "message-ajax/send-message.php",
            type: "Post",
            data: { user_id: user_id, friend_id: friend_id, message: message },
            success: function (data) {
                // alert(data);
                $("#send-message-form").trigger("reset");
                $("#message-modal-form").prepend(data);
            }
        });

    });
});