<?php
session_start();
require('header.php');


if (isset($_POST['issue_book'])) {
    $admin_id = $_SESSION['admin_id'];

    if (!empty($_POST['book_id'])) {
        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];
        $book_issue_date = $_POST['book_issue_date'];

        $issue_sql_insert = "INSERT INTO `issue_books`(`book_id`, `student_id`, `admin_id`, `book_issue_date`) VALUES ('$book_id', '$student_id', '$admin_id', '$book_issue_date')";
        $issue_result_insert = mysqli_query($con, $issue_sql_insert);
        
        
        if ($issue_result_insert) {
            $avaiable_qty_sql_update = "UPDATE `books` SET `available_qty`= `available_qty`-1  WHERE `id` = '$book_id' ";
            $avaiable_qty_result_update = mysqli_query($con, $avaiable_qty_sql_update);
            
            if ($avaiable_qty_result_update) {
                $success = "Book Issued Successfully.";
            } else {
            $error = "Book Issue Faild!";
            }
        } else {
            $error = "Book Issue Faild!";
        }

    } else {
        $error = "Please Select A Book.";
    }

} 

?>
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
    <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="javascript:avoid(0)">Dashboard</a></li>
         <li><a href="javascript:avoid(0)">Issue Book</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>Issue Books</b></h4>
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
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal form-stripe" action="" method="POST">
                                <div class="form-group">
                                    <div class="col-sm-9 mb-2 mb-sm-0">
                                        <select name="student_id" class="form-control" style="width: 100%">
                                            <option value="" hidden >Select Student...</option>
                                            <?php 
                                                $sql_query = "SELECT * FROM `students` WHERE `status` = '1' ";
                                                $result = mysqli_query($con, $sql_query);

                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= ucwords($row['name']).' ('.$row['roll'].')' ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 form-row text-center">
                                        <button name="search" type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        if ( isset($_POST['search']) && !empty($_POST['student_id'])) {
                            $id = $_POST['student_id'];

                            $sql_query = " SELECT * FROM `students` WHERE `id` = '$id' AND `status` = '1' ";
                            $result = mysqli_query($con, $sql_query);
                            $row = mysqli_fetch_assoc($result); ?>
                            <div class="panel">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="">
                                                <div class="form-group">
                                                    <label for="name">Student Name</label>
                                                    <input type="text" class="form-control" name="student_id" id="name" value="<?= ucwords($row['name']) ?>" readonly>
                                                    <input type="hidden" value="<?= $row['id'] ?>" name="student_id">
                                                </div>
                                                <div class="form-group">
                                                    <label for="book_name">Book Name</label>
                                                    <select name="book_id" class="form-control" id="book_name" style="width: 100%">
                                                        <option value="" hidden >Select Book...</option>
                                                        <?php 
                                                            $sql_query = "SELECT * FROM `books` WHERE `available_qty` > 0 ";
                                                            $result = mysqli_query($con, $sql_query);

                                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                                    <option value="<?= $row['id'] ?>"><?= ucwords($row['book_name']).' ('.$row['book_author_name'].')' ?></option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Book Issue Date</label>
                                                    <input type="text" name="book_issue_date" class="form-control" value="<?= date('d-m-Y')?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="issue_book" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
 <?php
    require('footer.php');
 ?>