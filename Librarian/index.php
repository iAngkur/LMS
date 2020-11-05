<?php
session_start();
require('header.php');


?>
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
    <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="javascript:avoid(0)">Dashboard</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12">
        <div class="row">
            <?php 
                $students = mysqli_query($con, "SELECT * FROM `students`");              
                $total_students = mysqli_num_rows($students);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                    <a href="students.php">
                        <div class="panel-content">
                            <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?= $total_students ?> </h1>
                            <h4 class="subtitle color-darker-1">Total Students</h4>
                        </div>
                    </a>
                </div>
            </div>
            <?php 
                $issue_books = mysqli_query($con, "SELECT * FROM `issue_books` WHERE `book_return_date` = '' ");
                $total_issue_books = mysqli_num_rows($issue_books);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel widgetbox wbox-1 bg-darker-1">
                    <a href="javascript:avoid(0)">
                        <div class="panel-content">
                            <h1 class="title color-w"> <i class="fas fa-book-open"></i> <?= $total_issue_books ?> </h1>
                            <h4 class="subtitle color-lighter-1">Total Books Issued</h4>
                        </div>
                    </a>
                </div>
            </div>

            <?php 
                $unique_books = mysqli_query($con, "SELECT * FROM `books`");
                $total_unique_books = mysqli_num_rows($unique_books);
                
                $books_qty = mysqli_query($con, "SELECT SUM(`book_qty`) as total FROM `books` ");
                $total_books = mysqli_fetch_assoc($books_qty);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel widgetbox wbox-1 bg-darker-1">
                    <a href="manage_books.php">
                        <div class="panel-content">
                            <h1 class="title color-w"> <i class="fa fa-book"></i> <?= $total_books['total'] . ' (' . $total_unique_books . ')' ?>  </h1>
                            <h4 class="subtitle color-lighter-1">Total Books</h4>
                        </div>
                    </a>
                </div>
            </div>

            <?php 
                $books_available_qty = mysqli_query($con, "SELECT SUM(`available_qty`) as total_available FROM `books` ");
                $total_available_books = mysqli_fetch_assoc($books_available_qty);
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel widgetbox wbox-1 bg-darker-1">
                    <a href="manage_books.php">
                        <div class="panel-content">
                            <h1 class="title color-w"> <i class="fa fa-book"></i> <?= $total_available_books['total_available'] ?>  </h1>
                            <h4 class="subtitle color-lighter-1">Total Available Books</h4>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
 <?php
    require('footer.php');
 ?>