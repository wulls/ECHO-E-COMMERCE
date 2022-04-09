<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "DELETE FROM category WHERE category_id='$id'");

mysqli_query($con, "UPDATE product SET category_ID='0' where category_ID='$id'");

header("location:kategori.php");
