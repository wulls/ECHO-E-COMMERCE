<?php 
include '../database connection.php';
$id = $_GET['id'];
$data = mysqli_query($con, "select * from admin where admin_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['admin_foto'];
unlink("../gambar/user/$foto");
mysqli_query($con, "delete from admin where admin_id='$id'");
header("location:admin.php");
