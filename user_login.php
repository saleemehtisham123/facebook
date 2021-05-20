<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "facebook") or die("Connection Failed!");
?>
<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="shortcut icon" href="icon/download.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>facebook - login or sign up</title>
</head>

<body>
    <div class="w-100">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="facebook-header text-center">
                    <h1>Facebook</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="error-msg"></div>
    <div class="qf-error-msg"></div>
    <div class="success-msg"></div>
    <div class="padding"></div>
    <div class="container-m">
        <div class="fb-left">
            <div class="facebook-logo">
                <img src="images/dF5SId3UHWd.svg" alt="">
            </div>
            <div class="facebook-logo-desc">
                <h3>Facebook helps you connect and share with the people in your life.</h3>
            </div>
        </div>
        <div class="fb-right">
            <div class="login">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="email" class="input-login" title="Email" name="lemail" placeholder="Email adress or phone number">
                    </div>
                    <div class="form-group" id="leye">
                        <input type="password" class="input-login" name="lpassword" placeholder="Password">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                    <button type="submit" name="login" class="login-btn">Log In</button>
                </form>
                <div class="text-center mt-3 mb-4 forgot-login-user">
                    <a href="#">Forgotten account?</a>
                </div>
                <hr>
                <div class="user-create-accout text-center mt-4 mb-3">
                    <button id="signupModal">Create New Account</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------sign up -->
    <div id="modal">
        <div id="modal-form">
            <div class="modal-title">
                <p>Sign Up</p>
                <p>It's quick and easy.</p>
            </div>
            <hr>
            <div class="w-100">
                <form id="submit-form">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" placeholder="First name" class="form-control" name="name" required>
                        </div>
                        <div class="col-6">
                            <input type="text" placeholder="Surname" class="form-control" name="surname" required>
                        </div>
                        <div class="col-12 mt-2">
                            <input type="text" minlength="10" placeholder="Mobile number or Emial address" class="form-control" name="email" required>
                        </div>
                        <div class="col-6 mt-2">
                            <input type="password" placeholder="Password" class="form-control" name="pass" required>
                        </div>
                        <div class="col-6 mt-2">
                            <input type="password" placeholder="Confirm Password" class="form-control" name="cpass" required>
                        </div>
                        <div class="col-12 mt-2 signup-date">
                            <label>Date of Birth</label>
                            <input type="date" id="date" class="form-control" name="DOB" required>
                        </div>
                        <div class="col-12 mt-2 signup-gender">
                            <label>Gender</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="gender-radio">
                                        <span>Male</span>
                                        <input type="radio" name="gender" value="Male" checked>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="gender-radio">
                                        <span>Female</span>
                                        <input type="radio" name="gender" value="Female">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 signup-desc">
                            <p>By clicking Sign Up, you agree to our <span style="color: rgba(0,100,150)">Terms, Data</span>
                                Policy and <span style="color: rgba(0,100,150)">Cookie Policy.</span>
                                You may receive SMS notifications from us and can opt out at any time</p>
                        </div>
                        <div class="col-12 text-center">
                            <input type="submit" id="submit" name="submit" class="btn btn-success w-50" value="Sign Up">
                        </div>
                </form>
            </div>
            <div id="close-btn">X</div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/userSignup.js">
    </script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['login'])) {
    $Lemail = $_POST['lemail'];
    $Lpass = $_POST['lpassword'];

    $sql = "SELECT * from users where email='$Lemail' AND password='$Lpass'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)) {
        $update_status = "UPDATE `users` SET `status` = 'online' WHERE `users`.`email` = '$Lemail'";
        $run = mysqli_query($con, $update_status);
        if ($run) {
            $_SESSION['email'] = $Lemail;
            echo "<script>window.open('home.php','_self')</script>";
        }
    } else {
        echo "<script>window.open('user_login.php','_self')</script>";
    }
}
?>