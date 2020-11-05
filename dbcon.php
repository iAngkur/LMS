<?php
$servername = "";
$username = "";
$pwd = "";
$database = "";

$con = mysqli_connect($servername, $username, $pwd, $database);

mysqli_query($con,'SET CHARACTER SET utf8');
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");
?>