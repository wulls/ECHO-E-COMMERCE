<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "DELETE FROM merchant WHERE merchant_id='$id'");

header("location:merchant.php");
