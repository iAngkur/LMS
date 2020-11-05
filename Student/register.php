<?php
session_start();
require_once('../dbcon.php');

if (isset($_SESSION['student_login'])) {
    header('location: index.php');
    exit();
}

if(isset($_POST['student_register'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $input_errors = array();
    if(empty($name)) {
        $input_errors['name'] = "Name Field is requied";
    } 
    if(empty($roll)) {
        $input_errors['roll'] = "Roll Field is requied";
    } 
    if(empty($email)) {
        $input_errors['email'] = "Email Field is requied";
    } 
    if(empty($password)) {
        $input_errors['password'] = "Password Field is requied";
    } 
    if(strlen($password) < 5) {
        $input_errors['password'] = "Password Must Be More Than 6 Characters";
    } 
    if(empty($phone)) {
        $input_errors['phone'] = "Phone Field is requied";
    }

    if (count($input_errors) == 0) {

        // Checking user alreday existance
        $sql_email_check = "SELECT * FROM `students` WHERE `email` = '$email'";
        $result_email_check = mysqli_query($con, $sql_email_check);

        if (!mysqli_num_rows($result_email_check)) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        
            $sql = "INSERT INTO `students`(`name`, `roll`, `email`, `password`, `phone`, `status`) VALUES ('$name','$roll','$email','$password_hashed','$phone', '0')";
            $result = mysqli_query($con, $sql);
        
            if ($result) {
                $success = 'Successfully Inserted, Login Now';
            } else {
                $error = 'Registration Failed, Try Again';
            }
        } else {
            $error = "This Email Is Already Taken";
        }
    }

}

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Registration</title>
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
            <h1 class="text-center">Register</h1>
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
                }, 4000); 
            </script>
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">

                    <form method="POST" action="register.php">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control is-invalid" value="<?= isset($name) ? $name : '' ?>" name="name" placeholder="Full Name">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['name'])) {
                                    echo '<span style="color: red">' . $input_errors['name'] . '</span>';
                                } 
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" value="<?= isset($roll) ? $roll : '' ?>" name="roll" placeholder="Roll" pattern="[0-9]{7}">
                                <i class="fa fa-book"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['roll'])) {
                                    echo '<span style="color: red">' . $input_errors['roll'] .'</span>';
                                } 
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" value="<?= isset($email) ? $email : '' ?>" name="email" placeholder="Email">
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
                            <span class="input-with-icon">
                                <input type="text" class="form-control" value="<?= isset($phone) ? $phone : '' ?>" name="phone" placeholder="01******" pattern="01[1|5|6|7|8|9][0-9]{8}">
                                <i class="fa fa-phone"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['phone'])) {
                                    echo '<span style="color: red">' . $input_errors['phone'] .'</span>';
                                } 
                            ?>
                        </div>
                       
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="student_register" value="Register">
                        </div>
                        <div class="form-group text-center">
                            Have an account? <a href="sign-in.php">Sign In</a>
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
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>

</html>
