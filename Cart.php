<?php

session_start();

include "database connection.php";
require_once ('indexcomponent.php');

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/index.css">
</head>
<body class="bg-light">
  <?php
  require_once('Header.php');
  ?>

  <div class="container-fluid">
    <div class="row px-5">
      <div class="col-md-7">
        <div class="shopping-cart">
          <h6>My Cart</h6>
          <hr>
          <?php

          if(isset($_SESSION['cart'])){
            $productid = array_column($_SESSION['cart'], 'productid');

            $sql = "SELECT * FROM product WHERE merchant_id = '6'";
            $result = mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($result)){
              foreach($productid as $id){
                if ($row['product_id'] == $id){
                  cartElement($row['image'], $row['productName'], number_format($row['productPrice']));
                }
              }
            }else{
              echo "<h5>Cart is Empty</h5>";
            }
          }

          ?>
        </div>
      </div>
      <div class="col-md-5"></div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
