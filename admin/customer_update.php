<?php 
include '../database connection.php';

$id  = $_POST['id'];
$username  = $_POST['username'];
$email  = $_POST['email'];
$hp  = $_POST['phone'];
$password  = md5($_POST['password']);

if($_POST['password'] == ""){

	mysqli_query($con, "update customer set username='$username', email='$email', phone='$hp', WHERE customer_id='$id'");

}else{
	mysqli_query($con, "update customer set username='$username', email='$email', phone='$hp', WHERE customer_id='$id'");

}

header("location:customer.php");