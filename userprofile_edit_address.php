<?php include "database connection.php";

$addressId = $_POST['id'];
$rname = $_POST['name'];
$rphone = $_POST['phone'];
$rlabel = $_POST['label'];
$rcity = $_POST['city'];
$rdistrict = $_POST['district'];
$rdetail = $_POST['detail'];
$rpostal = $_POST['postalcode'];


$updateName = "UPDATE customeraddress SET recipientName='$rname' WHERE address_id='$addressId'";
$name = mysqli_query($con,$updateName);

$updatePhone = "UPDATE customeraddress SET recipientPhone='$rphone' WHERE address_id='$addressId'";
$phone = mysqli_query($con,$updatePhone);

//address name
$updateLabel = "UPDATE customeraddress SET addressName='$rlabel' WHERE address_id='$addressId'";
$label = mysqli_query($con,$updateLabel);

$updateCity = "UPDATE customeraddress SET city='$rcity' WHERE address_id='$addressId'";
$city = mysqli_query($con,$updateCity);

$updateDistrict = "UPDATE customeraddress SET region='$rdistrict' WHERE address_id='$addressId'";
$district = mysqli_query($con,$updateDistrict);

$updateDetail = "UPDATE customeraddress SET addressDetail='$rdetail' WHERE address_id='$addressId'";
$detail = mysqli_query($con,$updateDetail);

$updatePostal = "UPDATE customeraddress SET postalCode='$rpostal' WHERE address_id='$addressId'";
$postal = mysqli_query($con,$updatePostal);

header("Location:test_userprofile.php");

?>