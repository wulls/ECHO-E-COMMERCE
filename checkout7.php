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
  <link rel="stylesheet" href="CSS/cart7.css">
</head>

<body>
  <br>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <div id="">
        <form action="" method="post">
        <h4>PROFILE</h4><br>
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
            <input type="submit" class="btn btn-primary px-4" value="Save" style="background-color:#2F86A6">
          </div>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <br>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h4>ORDER</h4>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-15">
              <div style="display:<?php if (isset($_SESSION['showAlert'])) {echo $_SESSION['showAlert'];} else {echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['message'])) {
                  echo $_SESSION['message'];
                } unset($_SESSION['showAlert']); ?></strong>
              </div>
              <div class="table-responsive mt-2">
               <table class="table text-center">
                 <thead>
                   <tr>
                     <th class="border-0 bg-light picname">PRODUCT</th>
                     <th class="border-0 bg-light">MERCHANT</th>
                     <th class="border-0 bg-light">PRICE</th>
                     <th class="border-0 bg-light">QUANTITY</th>
                     <th class="border-0 bg-light">TOTAL PRICE</th>
                   </tr>
                 </thead>
                 <tbody>
                    <?php
                      require 'database connection.php';
                      $user_id = $_SESSION['user_id'];
                      $stmt = $con->prepare("SELECT * FROM cart WHERE customer_id='$user_id'");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $grand_total = 0;
                      while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                      <td class="border-0">
                        <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                        <div class = "picname">
                          <img src="<?= $row['productImage'] ?>" width="50" height="50">
                          <div class="ml-3 d-inline-block align-middle">
                          <h6 class="mb-0"><?= $row['productName'] ?></h6><span class="text-muted font-weight-normal font-italic d-block"><small><?= $row['productAmount'], " ", $row['productUnit'] ?></small></span>
                          </div>
                       </div>
                      </td>
                      <td class="border-0">
                        <?= $row['merchant_id'] ?>
                      </td>
                      <td class="border-0">
                        <i class=""></i>Rp <?= number_format($row['productPrice']); ?>
                      </td>
                      <input type="hidden" class="pprice" value="<?= $row['productPrice'] ?>">
                      <td class="border-0">
                        <?= $row['productQuantity'] ?>
                      </td>
                      <td class="border-0"><i class=""></i>Rp <?= number_format($row['totalPrice']); ?></td>
                    </tr>
                    <?php $grand_total += $row['totalPrice']; ?>
                    <?php endwhile; ?>
                    <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td><b>SUBTOTAL</b></td>
                     <td><b>Rp <?= number_format($grand_total); ?></b></td>
                   </tr>
                 </tbody>
               </table>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
