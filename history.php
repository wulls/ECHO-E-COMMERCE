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
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $selectHistory = "SELECT OD.order_id, OD.orderDetail_id, DAY(ORD.orderDate) AS day, MONTHNAME(ORD.orderDate) AS month, YEAR(ORD.orderDate) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.image, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice		
                                    FROM orderdetail OD 
                                    JOIN orders ORD ON OD.order_id=ORD.order_id
                                    JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                    JOIN product PR ON OD.product_id=PR.product_id
                                    WHERE ORD.customer_id='$user_id'
                                    GROUP BY OD.order_id";
                    
                    $resultHistory = mysqli_query($con, $selectHistory);

                    $countHistory = mysqli_num_rows($resultHistory);

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
                                        ID: 11111
                                    </p>
                                    <p>
                                        <img src="image/small icons/store.png" style="height:20px;width:20px;">
                                        <b style="padding-left:10px;padding-right:10px;">Foodmart</b>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-start">
                                    <div class="frame">
                                        <img src="image/merchant/FoodhallAS/BerasMie/Macroni.jpeg" class="mb-0 product-display">
                                    </div>
                                    <p class="float-left" style="padding-left:25px;">
                                        <b>La Fonte Macaroni </b> 1 × 
                                        <br>
                                        Rp 10.000
                                        <br><br>
                                        + 10 Other Products
                                    </p>
                                    <div class="ml-auto p-2">
                                        <p class="text-secondary" style="padding-right:2rem;">
                                            Total Price
                                        </p>
                                        <p style="padding-right:2rem;">
                                            <b>Rp 357.460</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="align-items-end text-center" style="padding-right:2rem;">
                                    <div class="float-right">
                                        <button data-toggle="modal" data-target="#exampleModal" class="but-ton">
                                            Order Again
                                        </button>
                                    </div>
                                    <div class="float-right" style="padding-right:8px;">
                                        <button data-toggle="modal" data-target="#exampleModal" class="but-ton">
                                            Transaction Detail
                                        </button>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div><br>
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
