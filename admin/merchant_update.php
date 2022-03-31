<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];

    $sql2 = "UPDATE merchant SET merchantName='$nama' WHERE merchant_id='$id'";
    $query2 = mysqli_query($con, $sql2);
    header("location:merchant.php");

//mysqli_query($con, "update category set categoryName='$nama' where category_id='$id'");
//header("location:kategori.php");