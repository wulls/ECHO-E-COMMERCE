<?php include "database connection.php";
session_start();

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$label = $_POST['label'];
$city = $_POST['city'];
$region = $_POST['region'];
$detail = $_POST['detail'];
$postalcode = $_POST['postalcode'];

$insertAddress = "INSERT INTO customeraddress (customer_id, addressCategory, addressName, recipientName, recipientPhone, addressDetail, city, region, postalCode)
                  VALUES ('$user_id', 'Not Main', '$label', '$name', '$phone', '$detail', '$city', '$region', '$postalcode')";
$query = mysqli_query($con,$insertAddress);

?>