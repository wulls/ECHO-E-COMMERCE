<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
   include_once ('newnavbar.php');
  }

  if (isset($_SESSION['user_id'])) {
    include_once ('newnavbarlogin.php');
    //echo $_SESSION['user_id'];
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="CSS/.css">
</head>

<body>
  <br>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <div id="">
        <form action="" method="post">
        <h2>Checkout</h2><br>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Recipient Name</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="text" name="Name" class="form-control input-field" value="">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Recipient Phone Number</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Kabupaten/Kota</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Provinsi</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Detail Alamat</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Kode Pos</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-3">
            <h6 class="mb-0">Payment Method</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <select class="form-control input-field" name="paymentMethod">
              <option value="Debit" >Debit</option>
              <option value="Credit" >Credit</option>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-9 text-secondary">
            <input type="submit" class="btn btn-primary px-4" value="Checkout" style="background-color:#2F86A6">
          </div>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
