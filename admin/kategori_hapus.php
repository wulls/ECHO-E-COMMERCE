<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "DELETE FROM category WHERE category_id='$id'");

header("location:kategori.php");
