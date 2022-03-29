<?php
session_start();
require_once "database connection2.php";

if(isset($_POST["pid"]) && isset($_POST["pname"]) && isset($_POST["pprice"]) && isset($_POST["pimage"]) && isset($_POST["pamount"])
&& isset($_POST["punit"]) && isset($_POST["pquantity"])){

  //$qty = 1;

  $pid = $_POST['pid'];
  $pname = $_POST['pname'];
  $pprice = $_POST['pprice'];
  $pimage = $_POST['pimage'];
  $pamount = $_POST['pamount'];
  $punit = $_POST['punit'];
  $pquantity = $_POST['pquantity'];

  $totalPrice = $pprice * $pquantity;

  $select_stmt=$con->("SELECT product_id FROM cart WHERE product_id=:pid");
  $select_stmt->execute(array(":pid"=>$pid));
  $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

  $check_code = $row["product_id"];

  if(!$check_code)
  {
    $insert_stmt=$con->prepare("INSERT INTO cart (product_id,productName,productPrice,productImage,productAmount,productUnit,productQuantity,totalPrice) VALUES (:pid,:pname,:pprice,:pimage,:pamount,:punit,:pquantity,:totalPrice)");

    $insert_stmt->bind_param(" :pid", $pid);
    $insert_stmt->bind_param(" :pname", $pname);
    $insert_stmt->bind_param(" :pprice", $pprice);
    $insert_stmt->bind_param(" :pimage", $pimage);
    $insert_stmt->bind_param(" :pamount", $pamount);
    $insert_stmt->bind_param(" :punit", $punit);
    $insert_stmt->bind_param(" :pquantity", $pquantity);

    $insert_stmt->bind_param(" :totalPrice", $totalPrice);
    $insert_stmt->execute();
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
