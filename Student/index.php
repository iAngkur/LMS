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
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><strong>All Issue Books</strong></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table-bordered table table-striped nowrap table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author Name</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Return Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $student_id = $_SESSION['student_id'];

                            $sql_query = "SELECT `issue_books`.`book_issue_date`, `issue_books`.`book_return_date`, `books`.`book_image`, `books`.`book_name`, `books`.`book_author_name` FROM `books` INNER JOIN `issue_books` ON `issue_books`.`book_id` = `books`.`id` WHERE `issue_books`.`student_id` = '$student_id'";
                            $result = mysqli_query($con, $sql_query);

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <img width="40px" height="50px" src="../uploaded_images/Books_Images/<?= $row['book_image'] ?>" alt="<?= explode(' ', trim($row['book_image']))[0] ?>">
                                    </td>
                                    <td><?= ucwords($row['book_name']) ?></td>
                                    <td><?= $row['book_author_name'] ?></td>
                                    <td><?= $row['book_issue_date'] ?></td>
                                    <td><?php if(empty($row['book_return_date'])) { ?>  
                                        <p class="text-danger"><b>Did not return yet!</b></p> 
                                    <?php } else { ?> 
                                        <p class="text-success"> <?php $row['book_return_date'] ?> </p> 
                                    <?php } ?>
                                    </td>
                                </tr>                            
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
 <?php
    require('footer.php');
 ?>