<?php 
$sql_query = "SELECT * FROM `books`";
$result = mysqli_query($con, $sql_query);
    while ($row = mysqli_fetch_assoc($result)) { ?>
    <!-- Modal -->
    <div class="modal fade" id="book-<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <img width="180px" height="200px" src="../uploaded_images/Books_Images/<?= $row['book_image'] ?>" alt="<?= explode(' ', trim($row['book_name']))[0] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Book Name</th>
                            <td><?= ucwords($row['book_name']) ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Author</th>
                            <td><?= $row['book_author_name'] ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Publication</th>
                            <td><?= $row['book_publication_name'] ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Purchase Date</th>
                            <td><?= date('d-M-Y', strtotime($row['book_purchase_date'])) ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Price</th>
                            <td><?= $row['book_price'] ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Book Qty.</th>
                            <td><?= $row['book_qty'] ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Available Qty.</th>
                            <td><?= $row['available_qty'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>