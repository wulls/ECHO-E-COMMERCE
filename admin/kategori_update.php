<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['name'];

mysqli_query($con, "update category set name='$nama' where category_id='$id'");
header("location:kategori.php");