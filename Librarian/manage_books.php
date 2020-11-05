<?php
session_start();
require('header.php');

$librarian_email = $_SESSION['admin_login'];


if (isset($_POST['save_book']) || isset($_POST['update_book'])) {
    $book_name = $_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_publication_name = $_POST['book_publication_name'];
    $book_purchase_date = $_POST['book_purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];

   if (isset($_POST['save_book'])) {

        $image = explode('.', $_FILES['book_image']['name']);
        $image_ext = end($image);
        $image_size = $_FILES['book_image']['size'];
        $uploade_image = Date('Ymdhis.') . $image_ext;

        $sql_query = "INSERT INTO `books`(`book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_email`) VALUES ('$book_name', '$uploade_image', '$book_author_name', '$book_publication_name', '$book_purchase_date', '$book_price', '$book_qty', '$available_qty', '$librarian_email')";
        $result = mysqli_query($con, $sql_query);
        if($result) {
        move_uploaded_file($_FILES['book_image']['tmp_name'], '../uploaded_images/Books_Images/'.$uploade_image);
            $success = "Book Added Successfully";
        } else {
            $error = "Book Added Failed";
        }
   }
   if (isset($_POST['update_book'])) {
        $book_id = $_POST['book_id'];

        $sql_query = "UPDATE `books` SET `book_name`='$book_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name',`book_purchase_date`='$book_purchase_date',`book_price`='$book_price',`book_qty`='$book_qty',`available_qty`='$available_qty' WHERE `id` = '$book_id'";
        $result = mysqli_query($con, $sql_query);
        if($result) {
            $success = "Book Updated Successfully";
        } else {
            $error = "Book Update Failed";
        }
   }
}


?>
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
            <li></i><a href="javascript:avoid(0)">Add Book</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-5">
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
                <div class="alert alert-danger" role="alert">
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
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <h5 class="mb-lg text-bold">Add New Book...</h5>
                            <hr>
                            <div class="form-group">
                                <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_name" id="book_name" placeholder="Book Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="book_image" class="col-sm-4 control-label">Book Image</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="book_image" id="book_image" placeholder="Book Image" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="book_author_name" class="col-sm-4 control-label">Author Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_author_name" id="book_author_name" placeholder="Book Author Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="book_publication_name" class="col-sm-4 control-label">Publication Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_publication_name" id="book_publication_name" placeholder="Book Publication Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="book_purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="book_purchase_date" id="book_purchase_date" placeholder="Book Purchase Date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="book_price" class="col-sm-4 control-label">Book Price</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_price" id="book_price" placeholder="Book Price" pattern="[0-9]+" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="book_qty" class="col-sm-4 control-label">Book Quantity</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="book_qty" id="book_qty" placeholder="Book Quantity" pattern="[0-9]+" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="available_qty" class="col-sm-4 control-label">Available Quantity</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="available_qty" id="available_qty" placeholder="Available Quantity" pattern="[0-9]+" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="librarian_email" class="col-sm-4 control-label">Librarian Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="librarian_email" id="librarian_email" value="<?= $librarian_email ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" name="save_book" class="btn btn-primary">SAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <h4 class="section-subtitle"><strong>All Books</strong></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql_query = "SELECT * FROM `books`";
                            $result = mysqli_query($con, $sql_query);

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <img width="40px" height="50px" src="../uploaded_images/Books_Images/<?= $row['book_image'] ?>" alt="<?= explode(' ', trim($row['book_name']))[0] ?>">
                                    </td>
                                    
                                    <td><?= ucwords(substr(strval($row['book_name']), 0, 16).'...') ?></td>
                                    <td><?= $row['book_author_name'] ?></td>
                                    <td><?= $row['book_price'] ?></td>
                                    <td><?= $row['available_qty'] ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#book-<?= $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#book-edit-<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a>
                                        <a href="delete.php?bookid=<?= base64_encode($row['id']) ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete?')"><i class="fa fa-trash-o"></i></a>
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
<?php
require_once('book_info.modal.php');
require_once('book_edit.modal.php');
?>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<?php
require('footer.php');
?>