<?php
session_start();
require_once('../dbcon.php');

if (isset($_SESSION['student_login'])) {
    header('location: index.php');
    exit();
}

if(isset($_POST['student_login'])) {
   
    $roll_email = $_POST['roll_email'];
    $password = $_POST['password'];

    $input_errors = array();
    if(empty($roll_email)) {
        $input_errors['roll_email'] = "Roll or Email Field is requied";
    } 
    if(empty($password)) {
        $input_errors['password'] = "Password Field is requied";
    } 
 
    if (!count($input_errors)) {

        $sql_user_check = "SELECT * FROM `students` WHERE `roll` = '$roll_email' OR `email` = '$roll_email'";
        $result_user_check = mysqli_query($con, $sql_user_check);


        if (mysqli_num_rows($result_user_check) == 1) {
            $row = mysqli_fetch_assoc($result_user_check);
            
            $hash = $row['password'];

            if (password_verify($password, $hash)) {

                if ($row["status"] == 1) {
                     $_SESSION['student_login'] = $roll_email;
                     $_SESSION['student_id'] = $row['id'];
                     $_SESSION['student_name'] = $row['name'];
                     $_SESSION['student_roll'] = $row['roll'];
                     $_SESSION['student_email'] = $row['email'];


                     header('location: index.php');
                } else {
                    $error = "Your Status Inactive. Contact with Librarian";
                }

            } else {
                $error = 'Login Failed, Try With Valid Info';
            }
        } else {
            $error = "Please Register First. Contact with Librarian";
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
            <h1 class="text-center">Log In</h1>
            <?php
            if(isset($success)) { ?>
                <div class="alert alert-success" id="aler" role="alert">
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

                    <form method="POST" action="sign-in.php">
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" value="<?= isset($roll_email) ? $roll_email : '' ?>" name="roll_email" placeholder="Enter Roll or Email">
                                <i class="fa fa-book"></i>
                            </span>
                            <?php 
                                if (isset($input_errors['roll_email'])) {
                                    echo '<span style="color: red">' . $input_errors['roll_email'] .'</span>';
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
                            <input type="submit" class="btn btn-primary btn-block" name="student_login" value="Login">
                        </div>
                        <div class="form-group text-center">
                            <a href="pages_forgot-password.html">Forgot password?</a>
                            <hr/>
                             <span>Don't have an account?</span>
                            <a href="register.php" class="btn btn-block mt-sm">Register</a>
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