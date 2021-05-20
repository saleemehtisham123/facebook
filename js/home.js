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
    // ...................................................................................................show posts
    function showAllPosts() {
        $.ajax({
            url: "home-ajax/show_all_posts.php",
            type: "post",
            success: function (data) {
                $("#show_all_posts").html(data);
            }
        });
    }
    showAllPosts();
});