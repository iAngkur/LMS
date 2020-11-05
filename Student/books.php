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
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Books</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <form action="" method="POST">
                    <div class="row pt-md">
                        <div class="form-group col-sm-9 col-lg-10">
                            <span class="input-with-icon">
                            <input type="text" class="form-control" name="search_value" placeholder="Search" required>
                            <i class="fa fa-search"></i>
                        </span>
                        </div>
                        <div class="form-group col-sm-3  col-lg-2 ">
                            <button type="submit" name="search_book" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <?php 
    if (isset($_POST['search_book'])) { 
        $search_value = $_POST['search_value']; ?>
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <?php 
                            $result = mysqli_query($con, "SELECT * FROM `books` WHERE `book_name` LIkE '%$search_value%' ");
                            $temp = mysqli_num_rows($result);
                            if ($temp > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="col-sm-3 col-md-2">
                                        <img width="120px" height="150px" src="../uploaded_images/Books_Images/<?= $row['book_image'] ?>" alt="">
                                        <p><?= $row['book_name'] ?></p>
                                        <span><p>Available: <?= $row['available_qty'] ?></p></span>
                                    </div>
                            <?php } 
                            } else { ?>
                                <div class="col-12">
                                    <h3 class="text-center">No Books Found</h3>
                                </div>    
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <?php 
                            $result = mysqli_query($con, "SELECT * FROM `books`");
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="col-sm-3 col-md-2">
                                    <img width="120px" height="150px" src="../uploaded_images/Books_Images/<?= $row['book_image'] ?>" alt="">
                                    <p><?= $row['book_name'] ?></p>
                                    <span><p>Available: <?= $row['available_qty'] ?></p></span>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

<?php 
require('header.php');
?>