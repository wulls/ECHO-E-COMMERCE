<?php 
include '../database connection.php';
$invoice  = $_POST['invoice'];
$status  = $_POST['status'];

mysqli_query($con, "update invoice set invoice_status='$status' where invoice_id='$invoice'");

header("location:transaksi.php");