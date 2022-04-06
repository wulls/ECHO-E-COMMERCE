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
  <link rel="stylesheet" href="CSS/checkout.css">
  
</head>

<body>
<div class="grid-container">
<form action="" method="post">

  <br>
  <div class="col-lg-8 billing">
    <div class="card">
      <div class="card-body">
        <h4>Billing Details</h4><br>
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
            <h6 class="mb-0">Provinsi</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="tel" name="Phone" class="form-control input-field" value="" readonly>
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
      </div>
    </div>
  </div>

  <br>
  <div class="col-lg-8 method">
    <div class="card">
      <div class="card-body">
        <div class="shipping-methods">
          <div class="section-title">
            <h4 class="title">Shipping Methods</h4>
          </div>
          <div class="input-checkbox">
            <input type="radio" name="shipping" id="shipping-1" checked>
            <label for="shipping-1"><strong>GoSend</strong></label>
            <div class="caption">
              <p>Barang belanja dikirim langsung oleh pengantar GoSend.
                <p>
            </div>
          </div>
        </div>
        <br>
        <div class="payments-methods">
          <div class="section-title">
            <h4 class="title">Payments Methods</h4>
          </div>
        <div class="input-checkbox">
          <input type="radio" name="payments" id="payments-1" checked>
          <label for="payments-1"><strong>Bank Transfer</strong></label>
          <div class="caption">
            <p>Silahkan lakukan pembayaran ke nomor rekening berikut:</p>
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nomor Rekening</th>
                    <td>041-222-3333</td>
                </tr>
                <tr>
                    <th>Atas Nama</th>
                    <td>PT. ECHO TECHNOLOGY</td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td>BCA</td>
                </tr>
              </table>
			  <form action="customer_pembayaran_act.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input type="hidden" name="id" value="<?php echo $id_invoice; ?>">
									<label>Upload Bukti Pembayaran</label><br>
									<input type="file" name="bukti" required="required"><br>
									<small class="text-muted">File yang diperbolehkan hanya file gambar.</small>
								</div>
								<input type="submit" class="btn btn-primary px-4" value="Upload Bukti Pembayaran" style="background-color:#2F86A6">
							</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br>
  <div class="col-lg-8 review">
    <div class="card">
      <div class="card-body">
        <h4>Order Review</h4>
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
                        Rp <?= number_format($row['productPrice']); ?>
                      </td>
                      <input type="hidden" class="pprice" value="<?= $row['productPrice'] ?>">
                      <td class="border-0">
                        <?= $row['productQuantity'] ?>
                      </td>
                      <td class="border-0">Rp <?= number_format($row['totalPrice']); ?></td>
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
                   <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>SHIPPING FEE</b></td>
                    <td><b>Rp 5,000</b></td>
                   </tr>
                   <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>TOTAL</b></td>
                    <td><b></b></td>
                   </tr>
                   <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <input type="submit" class="btn btn-primary px-4" value="Place Order" style="background-color:#2F86A6">
                    </td>
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

</form>
</div>
</body>
</html>
