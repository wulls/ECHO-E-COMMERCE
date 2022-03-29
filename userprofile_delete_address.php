<?php include "database connection.php";
$address_id = $_GET['id'];

$deleteAddress = "DELETE FROM customeraddress WHERE address_id='$address_id'";
$query = mysqli_query($con, $deleteAddress);

header("location:test_userprofile.php");

?>