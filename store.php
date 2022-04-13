<?php

session_start();
include 'database connection.php';
require_once('storecomponent.php');

if(!isset($_SESSION['user_id'])){
 include_once ('newnavbar.php');
}

if (isset($_SESSION['user_id'])) {
  include_once ('newnavbarproduct.php');
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shopping Cart</title>

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
        <form method="get" action="store.php">
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
        <form method="post" action="store.php">
          <div class="input-group">
            <input type="text" class="form-control" name="searchName" placeholder="Cari Produk" style="width: 925px;">
            <button class="btn btn-outline-success" style="z-index:1;" name="search" type="submit" value="search"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>

  <div class="container">
    <div class="row text-center py-5">
      <?php
      $merchant_id = $_SESSION['merchant_id'];

      if(isset($_GET['SemuaProduk'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
        component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if(isset($_GET['Sayur'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='1'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Buah'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='3'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Dapur'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='4'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Saus'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='5'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['BerasMie'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='6'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['SusuTelur'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='7'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      else if (isset($_GET['Daging'])) {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND category_id ='8'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
  	  else if (isset($_POST['search'])) {
          $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id' AND productName like '%" . $_POST['searchName'] . "%'";
          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($result)) {
            component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
          }
          if (mysqli_num_rows($result) < 7) {
            for ($i = mysqli_num_rows($result); $i < 7; $i++) {
              componentKosong();
            }
          }
  	  }
      else {
        $sql = "SELECT *, productUnit.productUnit FROM product JOIN productUnit ON product.productUnit_id = productUnit.productUnit_id WHERE merchant_id = '$merchant_id'";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){
          component($row['productName'], number_format($row['productPrice']), $row['productImage'], $row['productAmount'], $row['productUnit'], $row['product_id'], $row['productQuantity'], $row['productPrice']);
        }
      }
      ?>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="merchantlist" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 1rem;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Pilih Supermarket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <?php
                $sql = "SELECT * FROM merchant;";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($result)){
              ?>
              <div class="col-md-4 d-flex justify-content-center" style="padding-top:10px;">
                <form action="main page2.php" method="get">
                  <div class="card" style="width:10rem;height:10rem;border-radius:.9rem;">
                    <input type="image" src=<?php echo $row['image'];?> class="card-img-top" style="width:10rem;height:10rem;">
                    <div class="card-body">
                      <h5 class="text-center" style="font-size:15px;padding-bottom:40px;"><?php echo $row['merchantName']; ?></h5>
                      <input type="hidden" name="merchant_id" value=<?php echo $row['merchant_id']; ?> >
                    </div>
                  </div><br><br><br>
                </form>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="addresslist" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 1rem;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Pilih Alamat Pengantaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div id="noAddress" style="display:none;">
              <div class="d-flex justify-content-center">
                <img src="image/document.png" width="200px;">
              </div>
              <div class="d-flex justify-content-center">
                <p style="padding-top:15px;">Belum ada alamat yang tersimpan</p>
              </div>
              <div class="d-flex justify-content-center">
                <form action="test_userprofile.php">
                  <input class="but-ton" type="submit" value="Tambah Alamat">
                </form>
              </div>
            </div>
              <?php
                $sql = "SELECT * FROM customeraddress WHERE customer_id='$user_id';";
                $result = mysqli_query($con,$sql);
                $count = mysqli_num_rows($result);

                if($count == 0){
                  echo "<script type=\"text/javascript\">
                          document.getElementById('noAddress').style.display='block';
                        </script>
               ";
                }

                if($count > 0){
                  while($row=mysqli_fetch_array($result)){
              ?>
              <div class="card" style="width:100%;">
                <div class="card-body" style="padding-top:30px;">
                  <div class="row">
                    <div class="col-sm-9" style="width:40rem;">
                      <b><?php echo $row['addressName']; ?></b>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-9" style="width:40rem;">
                      <?php echo $row['recipientName']; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-9" style="width:40rem;">
                      <?php echo $row['addressDetail']; ?>
                    </div>
                  </div>
                  <div class="ml-auto p-2 d-flex justify-content-end">
                    <form action="" method="get">
                      <input type="submit" value="Pilih Alamat">
                      <input type="hidden" name="addressID" value=<?php echo $row['address_id']; ?>>
                    </form>
                  </div>
                </div>
              </div><br>
              <?php } } ?>
            </div>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <style type="text/css">
    .logotoko{
	    border-radius: 10px;
    }
    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid transparent;
      border-radius: .9rem;
    }
    .card {
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
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
</body>
</html>
