<?php include "database connection.php";
session_start();

$user_id = $_SESSION['user_id'];
$merchant_id = $_SESSION['merchant_id'];
$pid = $_POST['pid'];
$pname = $_POST['pname'];
$pprice = $_POST['pprice'];
$pimage = $_POST['pimage'];
$pamount = $_POST['pamount'];
$punit = $_POST['punit'];
$pquantity = $_POST['pquantity'];

$totalPrice = $pprice * $pquantity;

$insertCart = "INSERT INTO cart (customer_id, merchant_id, product_id, productName, productPrice, productImage, productAmount, productUnit, productQuantity, totalPrice)
               VALUES ('$user_id', '$merchant_id', '$pid', '$pname', '$pprice', '$pimage', '$pamount', '$punit', '$pquantity', '$totalPrice')";
$query = mysqli_query($con, $insertCart);

/*echo $pid;
echo "<br>";
echo $pname;
echo "<br>";
echo $pprice;
echo "<br>";
echo $pimage;
echo "<br>";
echo $pamount;
echo "<br>";
echo $punit;
echo "<br>";
echo $pquantity;
echo "<br>";
echo $totalPrice;*/
header("location:index7.php");

?>
