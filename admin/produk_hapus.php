<?php 
include '../database connection.php';
$id = $_GET['id'];
$data = mysqli_query($con, "SELECT * from product where product_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto1 = $d['image'];



mysqli_query($con, "DELETE from product where product_id='$id'");




$data = mysqli_query($con, "select * from transaksi where transaksi_produk='$id'");
while($d=mysqli_fetch_array($data)){
	$id_invoice = $d['transaksi_invoice'];

	mysqli_query($con, "delete from invoice where invoice_id='$id'");
}

mysqli_query($con, "delete from transaksi where transaksi_produk='$id'");

header("location:produk.php");
