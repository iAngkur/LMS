<?php 
$sql_query = "SELECT * FROM `books`";
$result = mysqli_query($con, $sql_query);
    while ($row = mysqli_fetch_assoc($result)) { ?>
    <!-- Modal -->
    <div class="modal fade" id="book-edit-<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Update Book</h4>
                </div>
                <div class="modal-body">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="book_name" value="<?= ucwords($row['book_name']) ?>" id="book_name" placeholder="Book Name" required>
                                                <input type="hidden" name="book_id" value="<?= $row['id'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_author_name" class="col-sm-4 control-label">Author Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="book_author_name" value="<?= $row['book_author_name'] ?>" id="book_author_name" placeholder="Book Author Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_publication_name" class="col-sm-4 control-label">Publication Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="book_publication_name" value="<?= $row['book_publication_name'] ?>" id="book_publication_name" placeholder="Book Publication Name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="book_purchase_date" value="<?= $row['book_purchase_date'] ?>" id="book_purchase_date" placeholder="Book Purchase Date" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_price" class="col-sm-4 control-label">Book Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="book_price" value="<?= $row['book_price'] ?>" id="book_price" placeholder="Book Price" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_qty" class="col-sm-4 control-label">Book Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="book_qty" value="<?= $row['book_qty'] ?>" id="book_qty" placeholder="Book Quantity" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="available_qty" class="col-sm-4 control-label">Available Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="available_qty" value="<?= $row['available_qty'] ?>" id="available_qty" placeholder="Available Quantity" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-10">
                                                <button type="submit" name="update_book" class="btn btn-warning">UPDATE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>