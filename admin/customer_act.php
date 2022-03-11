<?php 
include '../database connection.php';
$username = $_POST['username'];
$email  = $_POST['email'];
$hp  = $_POST['phone'];
$password  = md5($_POST['password']);

mysqli_query($con, "INSERT into customer values (NULL,'$username','$email','$hp','$password')");
header("location:customer.php");