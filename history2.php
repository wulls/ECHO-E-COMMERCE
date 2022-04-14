<?php include "database connection.php";

session_start();
require_once('history_component.php');

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
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>
<body>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="justify-content-center"><br>
                <div class="history">
                    <h3>Daftar Transaksi</h3><br>
                    <form action="" method="get">
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <button type="submit" value="all" name="all" class="btn btn-outline-info button-status">Semua</button>
                            </div>
                            <div class="p-2">
                                <button type="submit" value="1" name="mk" class="btn btn-outline-info button-status">Menunggu Konfirmasi</button>
                            </div>
                            <div class="p-2">
                                <button type="submit" value="2" name="dt" class="btn btn-outline-info button-status">Ditolak</button>
                            </div>
                            <div class="p-2">
                                <button type="submit" value="3" name="dkd" class="btn btn-outline-info button-status">Dikonfirmasi dan Sedang Diproses</button>
                            </div>
                            <div class="p-2">
                                <button type="submit" value="4" name="dk" class="btn btn-outline-info button-status">Dikirim</button>
                            </div>
                            <div class="p-2">
                                <button type="submit" value="5" name="s" class="btn btn-outline-info button-status">Selesai</button>
                            </div>
                        </div><br>
                    </form>
                    <?php
                    if(isset($_GET['Message'])){
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_GET['Message']; ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div id="noOrder" class="card" style="display:none;border-width:5px;border-color:lightgrey;background-color:transparent;border-style: dashed;box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);">
                        <div class="card-body d-flex justify-content-center" style="padding-top:30px;">
                            <img src="image/empty.png" style="height:200px;width:200px;">
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <p style="font-size:20px;">Tidak ada transaksi yang sesuai dengan filter</p>
                        </div>
                    </div>
                    <?php
                        $user_id = $_SESSION['user_id'];

                        //SHOW ALL HISTORY
                        if(isset($_GET['all'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                              FROM orderdetail OD
                                              LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                              JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                              JOIN product PR ON OD.product_id=PR.product_id
                                              JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                              WHERE INV.invoice_customer='$user_id'
                                              GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //MENUNGGU KONFIRMASI
                        if(isset($_GET['mk'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id' && INV.invoice_status='1'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //DITOLAK
                        else if(isset($_GET['dt'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id' && INV.invoice_status='2'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //DIKONFIRMASI DAN SEDANG DIPROSES
                        else if(isset($_GET['dkd'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id' && INV.invoice_status='3'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //DIKIRIM
                        else if(isset($_GET['dk'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id' && INV.invoice_status='4'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //SELESAI
                        else if(isset($_GET['s'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id' && INV.invoice_status='5'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                        //DEFAULT
                        else if(!isset($_GET['all'])){
                            $selectHistory = "SELECT INV.invoice_id, OD.orderDetail_id, DAY(INV.invoice_tanggal) AS day, MONTHNAME(INV.invoice_tanggal) AS month, YEAR(INV.invoice_tanggal) AS yearr, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND(OD.productPrice * OD.quantity, 0) AS totalPrice, SUM(OD.productPrice * OD.quantity) AS totalCost, SUM(OD.productPrice * OD.quantity)+INV.invoice_ongkir AS totalPurchase, COUNT(OD.order_id)-1 AS itemAmount, INV.invoice_nama, INV.invoice_hp, INV.invoice_alamat, INV.invoice_provinsi, INV.invoice_kabupaten, INV.invoice_kurir, INV.invoice_berat, INV.invoice_ongkir, INV.invoice_status, INV.invoice_resi, INV.invoice_bukti, INVS.status
                                          FROM orderdetail OD
                                          LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                          JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                          JOIN product PR ON OD.product_id=PR.product_id
                                          JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                          WHERE INV.invoice_customer='$user_id'
                                          GROUP BY OD.order_id";
                            $resultHistory = mysqli_query($con, $selectHistory);
                            $countHistory = mysqli_num_rows($resultHistory);
                            while($history = mysqli_fetch_array($resultHistory)){
                                history($history['day'], $history['month'], $history['yearr'], $history['invoice_id'], $history['status'], $history['merchantName'], $history['productImage'], $history['productName'], $history['quantity'], $history['productPrice'], $history['itemAmount'], $history['totalCost'], $history['invoice_id'], $history['invoice_id']);
                                //TRANSACTION DETAIL
                                 detail_up($history['invoice_id']);
                                 $selectOrder = "SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice, PU.productUnit, INVS.status
                                                 FROM orderdetail OD
                                                 LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                 JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                 JOIN product PR ON OD.product_id=PR.product_id
                                                 JOIN productunit PU ON PU.productUnit_id=PR.productUnit_id
                                                 JOIN invoicestatus INVS ON INV.invoice_status=INVS.invoiceStatus_id
                                                 WHERE OD.order_id='$history[invoice_id]'";
                                $resultOd = mysqli_query($con, $selectOrder);
                                    while($order = mysqli_fetch_array($resultOd)){
                                        detail1($order['productImage'], $order['productName'], $order['quantity'], $order['productUnit'], $order['productPrice'], $order['totalPrice']);
                                    }
                                    detail2($history['invoice_kurir'], $history['invoice_nama'], $history['invoice_hp'], $history['invoice_alamat'], $history['invoice_provinsi'], $history['invoice_kabupaten'], $history['totalCost'], $history['invoice_ongkir'], $history['totalPurchase'], $history['status']);

                            detail_down();
                             if($countHistory == 0){
                                echo "<script type=\"text/javascript\">
                                      document.getElementById('noOrder').style.display='block';
                                      </script>
                                     ";
                               }
                            }
                        }
                    ?>
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
.button-status:focus{
    background-color:#2F86A6;
    color: white;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>
