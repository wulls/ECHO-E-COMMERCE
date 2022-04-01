<?php

session_start();

include 'database connection.php';
require_once('indexcomponent3.php');

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
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index5.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Home</a>\
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="cart3.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <div id="message"></div>
  <br>
  <div class="row">
    <div class="col-sm-4 col-md-3">
      <h3>Kategori</h3>
      <div class="list-group">
        <form method="post" action="index5.php">
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
      if(isset($_POST['SemuaProduk'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
        component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if(isset($_POST['Sayur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='1'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['Buah'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='3'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['Dapur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='4'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['Saus'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='5'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['BerasMie'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='6'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['SusuTelur'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='7'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_POST['Daging'])) {
        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='8'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else {
        $sql = "SELECT * FROM product WHERE merchant_id = '6'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      ?>
    </div>
  </div>

<!--
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
-->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function(){

      //send product details in server
      $(".addItemBtn").click(function(e) {
        e.preventDeafult();
        var form = $(this).closest(".form-submit");
        var id = form.find(".pid").val();
        var name = form.find(".pname").val();
        var price = form.find(".pprice").val();
        var image = form.find(".pimage").val();
        var amount = form.find(".pamount").val();
        var unit = form.find(".punit").val();
        var quantity = form.find(".pquantity").val();

        $.ajax({
          url: 'action2.php',
          method: 'post',
            data: {
              pid: pid,
              pname: pname,
              pprice: pprice,
              pimage: pimage,
              pamount: pamount,
              punit: punit,
              pquantity: pquantity
            },
            success: function(response){
              $("#message").html(response);
              window.scrollTo(0,0);
              load_cart_item_number();
            }
          });
        });

    // Load total no.of items added in the cart and display in the navbar
       load_cart_item_number();

       function load_cart_item_number() {
         $.ajax({
           url: 'action2.php',
           method: 'get',
           data: {
             cartItem: "cart_item"
           },
           success: function(response) {
             $("#cart-item").html(response);
           }
         });
       }
     });
  </script>
</body>
</html>