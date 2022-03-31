<?php 
include '../database connection.php';
$nama  = $_POST['nama'];

$sql = "SELECT merchantName FROM merchant WHERE merchantName='$nama'";
$query = mysqli_query($con, $sql);
$rows = mysqli_num_rows($query);

if($rows===1){
    header("location:merchant_tambah.php?alert=gagal");
}else if($rows==0){
    $sql2 = "INSERT INTO merchant (merchantName) VALUES ('$nama');";
    $query2 = mysqli_query($con, $sql2);
    header("location:merchant.php");
}

//mysqli_query($con, "INSERT INTO category (name) VALUES ('$nama')");