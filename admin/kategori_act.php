<?php 
include '../database connection.php';
$nama  = $_POST['nama'];

$sql = "SELECT categoryName FROM category WHERE categoryName='$nama'";
$query = mysqli_query($con, $sql);
$rows = mysqli_num_rows($query);

if($rows===1){
    header("location:kategori_tambah.php");
}else if($rows==0){
    $sql2 = "INSERT INTO category (categoryName) VALUES ('$nama');";
    $query2 = mysqli_query($con, $sql2);
    header("location:kategori.php");
}

//mysqli_query($con, "INSERT INTO category (name) VALUES ('$nama')");