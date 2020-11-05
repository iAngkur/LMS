<?php
session_start();
require_once('../dbcon.php');

if (isset($_SESSION['admin_login'])) {
    header('location: index.php');
    exit();
}

if(isset($_POST['admin_login'])) {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $input_errors = array();
    if(empty($email)) {
        $input_errors['email'] = "Email Field is requied";
    } 
    if(empty($password)) {
        $input_errors['password'] = "Password Field is requied";
    } 
 
    if (!count($input_errors)) {

        $sql_user_check = "SELECT * FROM `admin` WHERE `email` = '$email'";
        $result_user_check = mysqli_query($con, $sql_user_check);


        if (mysqli_num_rows($result_user_check) == 1) {
            $row = mysqli_fetch_assoc($result_user_check);
            
            if ($password == $row['password']) {
                $_SESSION['admin_login'] = $email;
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];

                header('location: index.php');
            } else {
                $error = 'Login Failed, Try With Valid Info';
            }
        } else {
            $error = "Please Register First. Contact with Adminstri.";
        } 
    } 

}
?>


<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Login</title>
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h1 class="text-center">Admin Log In</h1>
            <?php
            if(isset($success)) { ?>
                <div class="alert alert-success" id="alert" role="alert">
                    <?= $success ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php 
            }
            ?>
            <?php
            if(isset($error)) { ?>
                <div class="alert alert-danger" id="alert" role="alert">
                    <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php 
            }
            ?>
            <script type="text/javascript"> 
                setTimeout(function () { 
        
                    // Closing the alert 
                    $('#alert').alert('close'); 
                }, 5000); 
            </script>
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">

                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" value="<?= isset($email) ? $email : '' ?>" name="email" placeholder="Enter Email">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['email'])) {
                                    echo '<span style="color: red">' . $input_errors['email'] .'</span>';
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['password'])) {
                                    echo '<span style="color: red">' . $input_errors['password'] .'</span>';
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="admin_login" value="Login">
                        </div>
                        <div class="form-group text-center">
                            <a href="pages_forgot-password.html">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- ========================================================= -->
</body>

</html>