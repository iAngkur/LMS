<?php
require_once('../dbcon.php');

if (isset($_GET['bookid'])) {
    $id = base64_decode($_GET['bookid']);

    $sql_query = "DELETE FROM `books` WHERE `id` = '$id' ";
    mysqli_query($con, $sql_query);

    header('location: manage_books.php');
}

?>