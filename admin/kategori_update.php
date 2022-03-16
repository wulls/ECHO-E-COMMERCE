<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];

$sql = "SELECT categoryName FROM category WHERE categoryName='$nama'";
$query = mysqli_query($con, $sql);
$rows = mysqli_num_rows($query);

    $sql2 = "UPDATE category SET categoryName='$nama' WHERE category_id='$id'";
    $query2 = mysqli_query($con, $sql2);
    header("location:kategori.php");

//mysqli_query($con, "update category set categoryName='$nama' where category_id='$id'");
//header("location:kategori.php");