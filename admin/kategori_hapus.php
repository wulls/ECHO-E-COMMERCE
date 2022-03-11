<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "delete from category where category_id='$id'");


mysqli_query($con,"update product set category_id='1' where category_id='$id'");

header("location:kategori.php");
