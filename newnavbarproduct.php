<!DOCTYPE html>
<html lang="en">
<head>
  <title>TROLLEY</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <style>
    .sticky {
    position: fixed;
    top: 0;
    width: 100%;
    }
    #header{
      z-index: 2;
      box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2);
    }
    .cart{
      color:white;
    }
    #navbarDropdown{
      color:white;
    }
    #cart-item{
      background-color: white;
      color: #2F86A6;
    }
  </style>
</head>
<body>

<?php
  //SELECT MERCHANT
  $merchant_id = $_SESSION['merchant_id'];
  $selectmerchant = "SELECT merchantName FROM merchant WHERE merchant_id = '$merchant_id'";
  $resultmerchant = mysqli_query($con,$selectmerchant);
  $merchant = mysqli_fetch_array($resultmerchant);
  $merchantName = $merchant['merchantName'];

  //SELECT ADDRESS
  $user_id = $_SESSION['user_id'];
  $selectAddress = "SELECT addressDetail FROM customeraddress WHERE customer_id='$user_id' GROUP BY addressName";
  $resultAddress = mysqli_query($con,$selectAddress);
  $address = mysqli_fetch_array($resultAddress);
  $count = mysqli_num_rows($resultAddress);

  if($count > 0){
    $addressDetail = $address['addressDetail'];
  }
  if($count == 0){
    $addressDetail = 'Masukkan Alamat';
  }

  //SHORTEN MERCHANT NAME
  if(strlen($merchantName) > 21){
    $maxLength = 20;
    $merchantName = substr($merchantName, 0, $maxLength);
  }

  //SHORTEN ADDRESS DETAIL
  if(strlen($addressDetail) > 21){
    $maxLength = 20;
    $addressDetail = substr($addressDetail, 0, $maxLength);
  }
?>

<div id="header">
    <nav class="navbar navbar-expand-lg" style="background-color:#34BE82;">
        <div class="container">
            <a class="navbar-brand" href="main page.php">
                <img src="image/logo2.svg" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <img src="image/small icons/menu.png" height="30">
            </button>
            <div style="padding-left: 50px;padding-top:10px">
                <div class="form-floating mb-3">
                    <button type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#merchantlist" class="form-control input-field text-left" id="floatingInputValue" placeholder="Jaka" style="border:0 solid transparent;border-radius:15px;width:210px;box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.25);">
                      <?php echo $merchantName ?>...
                    </button>
                    <label for="floatingInputValue">Beli dari</label>
                </div>
            </div>
            <div style="padding-left: 50px;padding-top:10px">
                <div class="form-floating mb-3">
                    <button type="button" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#addresslist" class="form-control input-field text-left" id="floatingInputValue" placeholder="Jaka" style="border:0 solid transparent;border-radius:15px;width:210px;box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.25);">
                      <?php
                        if(isset($_GET['addressID'])){
                          $addressid = $_GET['addressID'];
                          $selectAddress = "SELECT addressDetail FROM customeraddress WHERE address_id='$addressid'";
                          $resultAddress = mysqli_query($con,$selectAddress);
                          $address = mysqli_fetch_array($resultAddress);
                          echo $address['addressDetail'];
                        }if(!isset($_GET['addressID'])){
                          echo $addressDetail;
                        }
                      ?>
                    </button>
                    <label for="floatingInputValue">Antar ke</label>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" aria-current="page" href="cart7.php">
                        <i class="fas fa-shopping-cart cart"></i>
                        <?php
                            require 'database connection.php';
                            $user_id = $_SESSION['user_id'];
                            $cart_number = 0;
                            $stmt = $con->prepare("SELECT * FROM cart WHERE customer_id='$user_id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while ($row = $result->fetch_assoc()):
                        ?>
                        <?php $cart_number += $row['productQuantity'];?>
                        <?php endwhile; ?>
                        <span id="cart-item" class="badge badge-danger"><?= number_format($cart_number); ?></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="test_userprofile.php">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="history.php">History</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="user_logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
  window.onscroll = function() {myFunction()};

  var header = document.getElementById("header");
  var sticky = header.offsetTop;

  function myFunction() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
    } else {
      header.classList.remove("sticky");
    }
  }
  </script>

</body>
</html>
