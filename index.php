<?php

session_start();

include "database connection.php";
require_once ('indexcomponent.php');

if(isset($_POST['add'])){
  //print_r($_POST['productid']);
  if(isset($_SESSION['cart'])){
    $item_array_id = array_column($_SESSION['cart'],'productid');

    if(in_array($_POST['productid'], $item_array_id)){
      echo "<script>alert('Product is already added in the cart...!')</script>";
      echo "<script>window.location = 'index.php'</script>";
    }else{

      $count = count($_SESSION['cart']);
      $item_array = array(
        'productid'=> $_POST['productid']
      );

      $_SESSION['cart'][$count] = $item_array;

    }

  }else{
    $item_array = array(
      'productid'=> $_POST['productid']
    );

    //Create new session variable
    $_SESSION['cart'][0] = $item_array;
    print_r($_SESSION['cart']);
  }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Text -->
    <!-- <link href="http://fonts.cdnfonts.com/css/product-sans" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
<<<<<<< Updated upstream
	<hr /> 
=======
     <?php require_once("Header.php")?>
     <br>
>>>>>>> Stashed changes
     <div class="row">
       <div class="col-sm-4 col-md-3">
         <h3>Kategori</h3>
         <div class="list-group">
           <form method="post" action="index.php">
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
                  component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                }
              }
              else if(isset($_POST['Sayur'])) {
                  $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='1'";
                  $result = mysqli_query($con,$sql);
                  while($row=mysqli_fetch_array($result)){
                    component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                  }
                }
                else if (isset($_POST['Buah'])) {
                    $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='3'";
                    $result = mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($result)){
                      component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                    }
                  }
                  else if (isset($_POST['Dapur'])) {
                      $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='4'";
                      $result = mysqli_query($con,$sql);
                      while($row=mysqli_fetch_array($result)){
                        component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                      }
                    }
                    else if (isset($_POST['Saus'])) {
                        $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='5'";
                        $result = mysqli_query($con,$sql);
                        while($row=mysqli_fetch_array($result)){
                          component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                        }
                      }
                      else if (isset($_POST['BerasMie'])) {
                          $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='6'";
                          $result = mysqli_query($con,$sql);
                          while($row=mysqli_fetch_array($result)){
                            component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                          }
                        }
                        else if (isset($_POST['SusuTelur'])) {
                            $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='7'";
                            $result = mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result)){
                              component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                            }
                          }
                          else if (isset($_POST['Daging'])) {
                              $sql = "SELECT * FROM product WHERE merchant_id = '6' AND category_id ='8'";
                              $result = mysqli_query($con,$sql);
                              while($row=mysqli_fetch_array($result)){
                                component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                              }
                            }
                            else {
                                $sql = "SELECT * FROM product WHERE merchant_id = '6'";
                                $result = mysqli_query($con,$sql);
                                while($row=mysqli_fetch_array($result)){
                                  component($row['productName'], number_format($row['productPrice']), $row['image'], $row['quantity'], $row['unit'], $row['product_id']);
                                }
                              }
            ?>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
