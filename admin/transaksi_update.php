<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];

    $sql2 = "UPDATE invoice SET invoice_deskripsi='$nama' WHERE invoice_id='$id'";
    $query2 = mysqli_query($con, $sql2);
    header("location:transaksi.php");

//mysqli_query($con, "update category set categoryName='$nama' where category_id='$id'");
//header("location:kategori.php");