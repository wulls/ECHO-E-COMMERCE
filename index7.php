<?php

session_start();
include 'database connection.php';
require_once('indexcomponent7.php');

if(!isset($_SESSION['user_id'])){
 include_once ('newnavbar.php');
}

if (isset($_SESSION['user_id'])) {
  include_once ('newnavbarproduct.php');
  //echo $_SESSION['user_id'];
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shopping Cart</title>

  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" /> -->

  <!-- Bootstrap CDN -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
  <div style="display:<?php if (isset($_SESSION['Alert'])) {echo $_SESSION['Alert'];} else {echo 'none';} unset($_SESSION['Alert']); ?>" class="alert alert-success alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
    } unset($_SESSION['Alert']); ?></strong>
  </div>
  <br>
  <div class="row">
    <div class="col-sm-4 col-md-3">
      <h3>Kategori</h3>
      <div class="list-group">
        <form method="get" action="index7.php">
          <input type="submit" name="SemuaProduk" value="Semua Produk" class="Kategori"><br>
          <input type="submit" name="Sayur" value="Sayur" class="Kategori"><br>
          <input type="submit" name="Buah" value="Buah" class="Kategori"><br>
          <input type="submit" name="Dapur" value="Dapur" class="Kategori"><br>
          <input type="submit" name="Saus" value="Saus" class="Kategori"><br>
          <input type="submit" name="BerasMie" value="Beras & Mie" class="Kategori"><br>
          <input type="submit" name="SusuTelur" value="Susu & Telur" class="Kategori"><br>
          <input type="submit" name="Daging" value="Daging" class="Kategori"><br>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row text-center py-5">
      <?php
      $merchant_id = $_SESSION['merchant_id'];
      //echo $merchant_id;

      if(isset($_GET['SemuaProduk'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
        component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if(isset($_GET['Sayur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='1'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['producPrice']);
        }
      }
      else if (isset($_GET['Buah'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='3'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productprice']);
        }
      }
      else if (isset($_GET['Dapur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='4'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Saus'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='5'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['BerasMie'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='6'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['SusuTelur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='7'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Daging'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id' AND category_id ='8'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else {
        $sql = "SELECT * FROM product WHERE merchant_id = '$merchant_id'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      ?>
    </div>
  </div>
</body>
</html>
