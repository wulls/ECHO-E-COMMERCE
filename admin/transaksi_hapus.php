<?php 
include '../database connection.php';
$id = $_GET['id'];

mysqli_query($con, "delete from invoice where invoice_id='$id'");

mysqli_query($con,"delete from transaksi where transaksi_invoice='$id'");

header("location:transaksi.php");