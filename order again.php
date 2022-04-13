<?php include "database connection.php";
session_start();

    $invoice_id = $_POST['invoiceID'];
    $user_id = $_SESSION['user_id'];

    //RE-ORDER
    //product_id customer_id merchant_id productName productImage productPrice productAmount productQuantity totalPrice
    $insertCart = "INSERT INTO cart (product_id, customer_id, merchant_id, productName, productImage, productPrice, productAmount, productQuantity, totalPrice)
                   SELECT product.product_id, customer.customer_id, merchant.merchant_id, product.productName, product.productImage, product.productPrice, product.productQuantity, orderdetail.quantity, orderdetail.quantity * orderdetail.productPrice
                   FROM orderdetail
                   JOIN product ON product.product_id = orderdetail.product_id
                   JOIN merchant ON merchant.merchant_id = orderdetail.merchant_id
                   JOIN invoice ON invoice.invoice_id = orderdetail.order_id
                   JOIN customer ON customer.customer_id = invoice.invoice_customer
                   WHERE orderdetail.order_id = '$invoice_id'";
    $cart = mysqli_query($con,$insertCart);
    
    $Message = urlencode("Produk berhasil ditambahkan ke dalam keranjang");
    header("Location:history.php?Message=".$Message);
    die;
?>