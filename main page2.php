<?php include "database connection.php";
session_start();
$_SESSION['merchant_id']=$_GET['merchant_id'];
header("Location:store.php");
?>
