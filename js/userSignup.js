
$(document).ready(function () {
    //sign up facebook
    $("#submit-form").on("submit", function (e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: 'ajax/userSignup.php',
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "PNM") {
                    $('.error-msg').html("Password Not Matched");
                    $('.error-msg').fadeIn();
                    setTimeout(function () {
                        $('.error-msg').fadeOut();
                    }, 5000)
                }
                if (data == "UE") {
                    $('.error-msg').html("This Email Already Taken Try A different Email");
                    $('.error-msg').fadeIn();
                    setTimeout(function () {
                        $('.error-msg').fadeOut();
                    }, 5000)
                }
                if (data == "QF") {
                    $('.qf-error-msg').html("You Cannot Use Single or Double quote!Try Again");
                    $('.qf-error-msg').fadeIn();
                    setTimeout(function () {
                        $('.qf-error-msg').fadeOut();
                    }, 5000)
                }
                if (data == "DS") {
                    $("#submit-form").trigger("reset");
                    $("#modal").fadeOut(1000);
                    $('.success-msg').html("Your Account has been Created Successfully");
                    $('.success-msg').fadeIn();
                    setTimeout(function () {
                        $('.success-msg').fadeOut();
                    }, 5000)
                }
            }

        });
    });

    // ------------------------------------------------------signup modal 
    //show modal box
    $("#signupModal").click(function () {
        $("#modal").fadeIn(1000);
    });
    //hide modal box
    $(document).on("click", "#close-btn", function () {
        $("#modal").fadeOut(1000);
    });
    // ------------------------------------------------------login password show and hide 
    function loginp() {
        var a = $('#leye input').attr("type");
        if (a == "password") {
            $("#leye input").attr("type", "text");
            // alert(a);
            // $('#leye input').("type");
            // var b = $('#leye input:type').val("text")
            // alert(b);
        } else {
            $("#leye input").attr("type", "password");
        }
    }
    $("#leye i").click(function () {
        loginp();
    });
});