<?php include "database connection.php";
session_start();

$user_id = $_SESSION['user_id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$updateFirstName = "UPDATE customer SET firstName='$firstName' WHERE customer_id='$user_id'";
$query1 = mysqli_query($con,$updateFirstName);

$updatelastName = "UPDATE customer SET lastName='$lastName' WHERE customer_id='$user_id'";
$query2 = mysqli_query($con,$updatelastName);

$updateGender = "UPDATE customer SET gender='$gender' WHERE customer_id='$user_id'";
$query3 = mysqli_query($con,$updateGender);

$updateEmail= "UPDATE customer SET email='$email' WHERE customer_id='$user_id'";
$query = mysqli_query($con,$updateEmail);

$updatePhone = "UPDATE customer SET phone='$phone' WHERE customer_id='$user_id'";
$query = mysqli_query($con,$updatePhone);

header("location:test_userprofile.php");

?>