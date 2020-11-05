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
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Return Books</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
 <!--SEARCHING, ORDENING & PAGING-->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><strong>All Return Books</strong></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Student Name</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author Name</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Return Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $admin_id = $_SESSION['admin_id'];

                            $sql_query = "SELECT `issue_books`.`id`, `issue_books`.`book_id`, `issue_books`.`book_issue_date`, `issue_books`.`book_return_date`, `students`.`name`, `students`.`roll`, `students`.`phone`, `books`.`book_image`, `books`.`book_name`, `books`.`book_author_name` FROM `issue_books` INNER JOIN `students` ON `issue_books`.`student_id` = `students`.`id` INNER JOIN `books` ON `books`.id = `issue_books`.`book_id` WHERE `issue_books`.`book_return_date` = '' ";
                            $result = mysqli_query($con, $sql_query);

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['roll'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= ucwords($row['book_name']) ?></td>
                                    <td><?= $row['book_author_name'] ?></td>
                                    <td><?= $row['book_issue_date'] ?></td>
                                    <td><a href="return_books.php?issueid=<?= base64_encode($row['id']) ?>&bookid=<?= base64_encode($row['book_id']) ?>">Return Book</a></td>
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

<?php
if (isset($_GET['issueid']) && isset($_GET['bookid'])) {
    $issue_id = base64_decode($_GET['issueid']);
    $book_id = base64_decode($_GET['bookid']);
    $return_date = date('d-m-y');

    $sql_query = "UPDATE `issue_books` SET `book_return_date`= '$return_date' WHERE `id` = '$issue_id'";
    $result = mysqli_query($con, $sql_query);

    if ($result) {
        $avaiable_qty_sql_update = "UPDATE `books` SET `available_qty`= `available_qty`+1  WHERE `id` = '$book_id' ";
        $avaiable_qty_result_update = mysqli_query($con, $avaiable_qty_sql_update);
    ?>
        <script type="text/javascript"> 
            alert("Successfully Returned.");
            javascript:history.go(-1);
        </script>
    <?php
    } else { ?>
        <script type="text/javascript"> 
            alert("Something Wrong!");
        </script>
    <?php
    }
}

?>

<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<?php 
require('footer.php');
?>