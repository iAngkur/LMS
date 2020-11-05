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
            <li><a href="javascript:avoid(0)">Students</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
 <!--SEARCHING, ORDENING & PAGING-->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <div class="pull-left"><h4 class="section-subtitle"><strong>All Students</strong></h4></div>
        <div class="pull-right"><a href="print_all_students.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a></div>
        <div class="clearfix"></div>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql_query = "SELECT * FROM `students`";
                            $result = mysqli_query($con, $sql_query);

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <img width="45px" height="50px" alt="profile photo" src="../assets/images/avatar/avatar_user.jpg" />
                                    </td>
                                    <td><?= ucwords($row['name']) ?></td>
                                    <td><?= $row['roll'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['status'] ? 'Active' : 'Inacitve' ?></td>
                                    <td>
                                        <?php 
                                            if ($row['status']) { ?>
                                                <a href="status_toggle.php?id=<?= base64_encode($row['id']) ?>&status=<?= base64_encode($row['status'])  ?>" class="btn btn-primary"><i class="fa fa-arrow-down"></i></a>
                                        <?php } else { ?>
                                                <a href="status_toggle.php?id=<?= base64_encode($row['id']) ?>&status=<?= base64_encode($row['status'])  ?>" class="btn btn-danger"><i class="fa fa-arrow-up"></i></a>
                                        <?php
                                        }
                                        ?>
                                        
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