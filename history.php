<?php include "database connection.php";

session_start();
if (isset($_SESSION['user_id'])) {
include_once ('newnavbarlogin.php');
//echo $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="justify-content-center"><br>
                <div class="history">
                    <h3>Order History</h3><br>
                    <div id="noOrder" class="card" style="display:none;border-width:5px;border-color:lightgrey;background-color:transparent;border-style: dashed;box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);">
                        <div class="card-body d-flex justify-content-center" style="padding-top:30px;">
                            <img src="image/empty.png" style="height:200px;width:200px;">
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <p style="font-size:20px;">Looks like you haven't made your order yet</p>
                        </div>
                    </div>
                    <?php
                    $user_id = $_SESSION['user_id'];

                    $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.image, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti
                                      FROM orderdetail OD 
                                      LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                      JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                      JOIN product PR ON OD.product_id=PR.product_id
                                      WHERE INV.invoice_customer='$user_id'
                                      GROUP BY OD.order_id";
                    $resultHistory = mysqli_query($con, $selectHistory);
                    $countHistory = mysqli_num_rows($resultHistory);

                    if($countHistory == 0){
                        echo "<script type=\"text/javascript\">
                                document.getElementById('noOrder').style.display='block';
                              </script>
                             ";
                    }

                    if($countHistory > 0){
                        while($history = mysqli_fetch_array($resultHistory)){                     
                    ?>
                    <div class="card" style="box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);border:0;">
                        <div class="card-body list-address" style="padding-left:35px;padding-top:30px;">
                            <div class="row">
                                <div class="col-sm-9"> 
                                    <p>
                                        <img src="image/small icons/invoice.png" style="height:20px;width:20px;">
                                        <b style="padding-left:10px;padding-right:10px;"><?php echo $history['day'].' '.$history['month'].' '.$history['yearr']; ?></b>
                                        ID: <?php echo $history['invoice_id']; ?>
                                    </p>
                                    <p>
                                        <img src="image/small icons/store.png" style="height:20px;width:20px;">
                                        <b style="padding-left:10px;padding-right:10px;"><?php echo $history['merchantName']; ?></b>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-start">
                                    <div class="frame">
                                        <img src="<?php echo $history['image']; ?>" class="mb-0 product-display">
                                    </div>
                                    <p class="float-left" style="padding-left:25px;">
                                        <b><?php echo $history['productName'] ?></b> <?php echo $history['quantity']; ?>
                                        <br>
                                        <?php echo "Rp. ".number_format($history['productPrice']).""; ?>
                                        <br><br>
                                        + <?php echo $history['itemAmount']; ?> Other Products
                                    </p>
                                    <div class="ml-auto p-2">
                                        <p class="text-secondary" style="padding-right:2rem;">
                                            Total Price
                                        </p>
                                        <p style="padding-right:2rem;">
                                            <b><?php echo "Rp. ".number_format($history['totalCost']) .""; ?></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="align-items-end text-center" style="padding-right:2rem;">
                                    <div class="float-right">
                                        <form action="order again.php" method="post">
                                            <input type="hidden" name="invoiceID" value=<?php echo $history['invoice_id']; ?>>
                                            <input type="submit" value="Order Again" data-toggle="modal" class="but-ton">
                                        </form>
                                    </div>
                                    <div class="float-right" style="padding-right:8px;">
                                        <button type="button" data-target="#myModal<?php echo $history['invoice_id'];?>" data-toggle="modal" class="but-ton detail">
                                            Transaction Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--************TRANSACTION DETAIL START************-->
                    <div class="modal fade" id="myModal<?php echo $history['invoice_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:40rem;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Transaction Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                                <?php
                                    $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.image, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice
                                                    FROM orderdetail OD 
                                                    LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                    JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                    JOIN product PR ON OD.product_id=PR.product_id
                                                    WHERE OD.order_id='$history[invoice_id]'";
                                    // SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.image, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PR.productUnit
                                    //                 FROM orderdetail OD 
                                    //                 LEFT JOIN orders ORD ON OD.order_id=ORD.order_id
                                    //                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                    //                 JOIN product PR ON OD.product_id=PR.product_id
                                                    
                                    //                 WHERE ORD.order_id='$history[order_id]'";
                                    $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                ?>
                                <div class="modal-body" style="padding-left:30px;padding-right:35px;">
                                    <div class="card w-85" style="box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);border:0;padding:10px;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="d-flex align-items-start">
                                                    <div class="frame-det">
                                                        <img src="<?php echo $order['image']; ?>" class="mb-0 product-display">
                                                    </div>
                                                    <p class="float-left" style="padding-left:25px;">
                                                        <b><?php echo $order['productName']; ?></b> <?php echo $order['quantity']; ?>
                                                        <br>
                                                        <?php echo "Rp. ".number_format($order['productPrice']).""; ?>
                                                    </p>
                                                    <div class="ml-auto p-2">
                                                        <p class="text-secondary" style="padding-right:0.5rem;">
                                                            Total Price
                                                        </p>
                                                        <p style="padding-right:2rem;">
                                                            <b><?php echo "Rp. ".number_format($order['totalPrice']) .""; ?></b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <hr style="border: 5px solid lightgrey;background-color:lightgrey;">
                                <div class="modal-body" style="padding-left:30px;padding-right:35px;height:12rem;">
                                    <h5>Deliver to</h5>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Courier :
                                        </div>
                                        <div class="col-sm-9">
                                            <?php echo $history['invoice_kurir']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Address :
                                        </div>
                                        <div class="col-sm-9">
                                            <p>
                                                <b><?php echo $history['invoice_nama']; ?></b><br>
                                                <?php echo $history['invoice_hp']; ?><br>
                                                <?php echo $history['invoice_alamat']." ".$history['invoice_provinsi']; ?><br>
                                                <?php echo $history['invoice_kabupaten']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border: 5px solid lightgrey;background-color:lightgrey;">
                                <div class="modal-body" style="padding-left:30px;padding-right:35px;">
                                    <h5>Payment detail</h5>
                                    <div class="row">
                                        <div class="col-sm-3 ">
                                            Payment Method                                        
                                        </div>
                                        <div class="col-sm-9 d-flex justify-content-end">
                                            Bank Transfer
                                        </div>
                                    </div>
                                    <hr style="height:1px;background-color:lightGrey;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Total Price                                          
                                        </div>
                                        <div class="col-sm-9 d-flex justify-content-end">
                                            <?php echo "Rp. ".number_format($history['totalCost']).""; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h7>Delivery Fee</h7>                                            
                                        </div>
                                        <div class="col-sm-9 d-flex justify-content-end">
                                            <?php echo $history['invoice_ongkir'] ?>
                                        </div>
                                    </div> 
                                    <hr style="height:.5px;background-color:lightGrey;">                                   
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <b>Total Purchases</b>                                           
                                        </div>
                                        <div class="col-sm-9 d-flex justify-content-end">
                                            <b><?php echo "Rp. ".number_format($history['totalPurchase']).""; ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--***********TRANSACTION DETAIL END***********-->
                    <?php } } ?>
                </div>
            </div> 
        </div>
    </div>
</div>

<style type="text/css">
body{
    color: #1a202c;
    text-align: left;
    background-color: #fff;
}
.main-body {
    padding-top: 15px;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border-radius: .9rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.row{
    padding-bottom: 15px;
}
.history{
    padding-left:25px;
    padding-right:25px;
}
.list-address{
    padding-left:30px;
} 
.frame {
    height:90px;
    width:90px;
    border: 0;
    border-radius: 8px;
    background: #fff;
    padding: 2px 2px;
    box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.frame-det{
    height: 70px;
    width: 70px;
    border: 0;
    border-radius: 8px;
    background: #fff;
    padding: 2px 2px;
    box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.product-display{
    width: 100%;
    height: 100%;
    border-radius: 6px;
}
.but-ton{
    background-color: #2F86A6;
    border-radius: 3px;
    border:0;
    color:white;
    min-width: 8rem;
    max-width: 15rem;
    height: 2.5rem;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>
