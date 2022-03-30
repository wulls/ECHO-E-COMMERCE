<?php
	session_start();
	require 'database connection.php';
	//require_once('indexcomponent3.php');

  // Add products into the cart table
	if (isset($_POST['pid'])) {
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
	    $query = $con->prepare('INSERT INTO cart (product_id,productName,productPrice,productImage,productAmount,productUnit,productQuantity,totalPrice) VALUES (?,?,?,?,?,?,?,?)');
	    $query->bind_param('isisisii',$pid,$pname,$pprice,$pimage,$pamount,$punit,$pquantity,$totalPrice);
	    $query->execute();

			echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
		$stmt = $con->prepare('SELECT * FROM cart');
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $cart_id = $_GET['remove'];

	  $stmt = $con->prepare('DELETE FROM cart WHERE cart_id=?');
	  $stmt->bind_param('i',$cart_id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart7.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $con->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart7.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['productQuantity'])) {
	  $productQuantity = $_POST['productQuantity'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $productQuantity * $pprice;

	  $stmt = $con->prepare('UPDATE cart SET productQuantity=?, totalPrice=? WHERE cart_id=?');
	  $stmt->bind_param('isi',$pquantity,$tprice,$pid);
	  $stmt->execute();
	}
?>
