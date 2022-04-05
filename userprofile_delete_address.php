<?php include "database connection.php";

$id = $_GET['id'];
$deleteAddress = "DELETE FROM customeraddress WHERE address_id='$id'";
$query = mysqli_query($con, $deleteAddress);

header("location:test_userprofile.php");

?>