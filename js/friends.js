$(document).ready(function () {
    // .................................................................................... you May know section
    function youMayKnow() {
        $.ajax({
            url: "friend-ajax/you-may-know.php",
            type: "post",
            success: function (data) {
                // alert(data);
                $(".you-may-know").html(data);
            }

        });
    }
    youMayKnow();
    $("#you-may-know").click(function () {
        $(".UMN").toggleClass("d-none");
    });
    // ....................................................................................add friend

    $(document).on("click", ".add_friend", function () {
        var id = $(this).data("id");
        var c = $(this);
        $.ajax({
            url: "friend-ajax/send_request.php",
            type: "post",
            data: { id: id },
            success: function (data) {

                if (data == "1") {
                    pending_requests();
                    $(c).removeClass("btn-primary");
                    $(c).addClass("btn-secondary");
                    $(c).html("Request Sent");
                    $(c).attr("disabled", "disabled");
                }
            }
        });
    });
    // ....................................................................................acceopt friend requst

    $(document).on("click", ".accept_friend_request", function () {
        var id = $(this).data("id");
        var c = $(this);
        $.ajax({
            url: "friend-ajax/accept_friend_request.php",
            type: "post",
            data: { id: id },
            success: function (data) {
                if (data == "1") {
                    $(c).removeClass("btn-info");
                    $(c).addClass("btn-warning");
                    $(c).html("Friends");
                    $(c).attr("disabled", "disabled");
                    friends();
                    friend_requests();
                    youMayKnow();
                }
            }
        });
    });
    // ....................................................................................friends
    function friends() {
        $.ajax({
            url: "friend-ajax/friends.php",
            type: "post",
            success: function (data) {
                // alert(data);
                $(".friends").html(data);
            }

        });
    }
    friends();
    $("#friends").click(function () {
        $(".FRIENDS").toggleClass("d-none");
    });
    // ....................................................................................friend Requests
    function friend_requests() {
        $.ajax({
            url: "friend-ajax/friend_requests.php",
            type: "post",
            success: function (data) {
                // alert(data);
                $(".friend-requests").html(data);
            }

        });
    }
    friend_requests();

    $("#friend-requests").click(function () {
        $(".FRIEND-REQUESTS").toggleClass("d-none");
    });
    // ....................................................................................pending Requests
    function pending_requests() {
        $.ajax({
            url: "friend-ajax/pending_requests.php",
            type: "post",
            success: function (data) {
                // alert(data);
                $(".pending-requests").html(data);
            }

        });
    }
    pending_requests();

    $("#pending-requests").click(function () {
        $(".PENDING-REQUESTS").toggleClass("d-none");
    });
});