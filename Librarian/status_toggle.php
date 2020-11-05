<?php 
require_once('../dbcon.php');

$id = base64_decode($_GET['id']);
$status = !(base64_decode($_GET['status']));

$sql_query = "UPDATE `students` SET `status` = '$status' WHERE `id` = '$id' ";
mysqli_query($con, $sql_query);

header('location: students.php');
exit();

?>