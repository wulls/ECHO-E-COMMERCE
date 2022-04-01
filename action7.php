<?php include "database connection.php";
session_start();

//add items to cart
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

$stmt = $con->prepare('SELECT product_id FROM cart WHERE product_id=?');
$stmt->bind_param('i', $pid);
$stmt->execute();
$res = $stmt->get_result();
$r = $res->fetch_assoc();
$product_id = $r['product_id'] ?? '';

if (!$product_id) {
  $insertCart = "INSERT INTO cart (customer_id, merchant_id, product_id, productName, productPrice, productImage, productAmount, productUnit, productQuantity, totalPrice)
                 VALUES ('$user_id', '$merchant_id', '$pid', '$pname', '$pprice', '$pimage', '$pamount', '$punit', '$pquantity', '$totalPrice')";
  $query = mysqli_query($con, $insertCart);

  $_SESSION['Alert'] = 'block';
  $_SESSION['msg'] = 'Item added to your cart!';
  } else {
  $_SESSION['Alert'] = 'block';
  $_SESSION['msg'] = 'Item already added to your cart!';
}
header('location:index7.php');

//remove single items from cart
if (isset($_GET['remove'])) {
  $cart_id = $_GET['remove'];

  $stmt = $con->prepare('DELETE FROM cart WHERE cart_id=?');
  $stmt->bind_param('i',$cart_id);
  $stmt->execute();

  $_SESSION['showAlert'] = 'block';
  $_SESSION['message'] = 'Item removed from the cart!';
  header('location:cart7.php');
}

//remove all items at once from cart
if (isset($_GET['clear'])) {
  $stmt = $con->prepare('DELETE FROM cart');
  $stmt->execute();
  $_SESSION['showAlert'] = 'block';
  $_SESSION['message'] = 'All Item removed from the cart!';
  header('location:cart7.php');
}

//set total price of the product in the cart table
if (isset($_POST['productQuantity'])) {
  $productQuantity = $_POST['productQuantity'];
  $pid = $_POST['pid'];
  $pprice = $_POST['pprice'];

  $tprice = $productQuantity * $pprice;

  $stmt = $con->prepare('UPDATE cart SET productQuantity=?, totalPrice=? WHERE product_id=?');
  $stmt->bind_param('iii',$productQuantity,$tprice,$pid);
  $stmt->execute();
}
?>