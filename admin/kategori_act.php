<?php 
include '../database connection.php';
$nama  = $_POST['name'];

mysqli_query($con, "INSERT INTO category values (NULL,'$nama')");

header("location:kategori.php");