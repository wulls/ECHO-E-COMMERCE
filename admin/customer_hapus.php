<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "delete from customer where customer_id='$id'");

$data = mysqli_query($con, "select * from invoice where invoice_customer='$id'");
while($d=mysqli_fetch_array($data)){
	$id_invoice = $d['invoice_id'];

	mysqli_query($con,"delete from transaksi where transaksi_invoice='$id_invoice'");
}

mysqli_query($con, "delete from invoice where invoice_customer='$id'");

header("location:customer.php");