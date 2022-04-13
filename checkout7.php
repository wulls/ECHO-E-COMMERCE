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
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="CSS/cart7.css">
  <link rel="stylesheet" href="CSS/checkout.css">

</head>

<body>

  <?php
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
  ?>
  <form action="checkoutaction.php" method="post" enctype="multipart/form-data">
    <div class="grid-container">


      <br>
      <div class="col-lg-12 billing">
        <div class="card">
          <div class="card-body">
            <h4>Alamat Pengririman</h4>
            <small class="text-muted"> Isi alamat pengiriman atau pilih alamat yang tersimpan di profile anda </small>
            <hr>
            <div class="modal fade bd-example-modal-lg" id="addresslist" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="border-radius: 1rem;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Pilih Alamat Pengiriman</h5>
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
                          <p class="text-muted"><small>Tambahkan alamat di halaman profile anda</small></p>
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
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="border-0"><h4><?php echo $row['addressName']; ?></h4></th>
                                  <th class="border-0"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><strong>Nama Penerima</strong></td>
                                  <td><?php echo $row['recipientName'];?></td>
                                </tr>
                                <tr>
                                  <td><strong>No. Handphone Penerima</strong></td>
                                  <td><?php echo $row['recipientPhone'];?></td>
                                </tr>
                                <tr>
                                  <td><strong>Provinsi</strong></td>
                                  <td><?php echo $row['region'];?></td>
                                </tr>
                                <tr>
                                  <td><strong>Kabupaten/Kota</strong></td>
                                  <td><?php echo $row['city'];?></td>
                                </tr>
                                <tr>
                                  <td><strong>Detail Alamat</strong></td>
                                  <td><?php echo $row['addressDetail'];?></td>
                                </tr>
                                <tr>
                                  <td><strong>Kode Pos</strong></td>
                                  <td><?php echo $row['postalCode'];?></td>
                                </tr>
                              </tbody>
                            </table>
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
            <div>
                <div class="mb-3">
                    <input type="button" value="Pilih Alamat Pengiriman" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#addresslist" class="" id="floatingInputValue" placeholder="Jaka" style="width:210px;">
                </div>
            </div>
            <?php
              if(isset($_GET['addressID'])){
                $addressid = $_GET['addressID'];
                $selectAddress = "SELECT * FROM customeraddress WHERE address_id='$addressid'";
                $resultAddress = mysqli_query($con,$selectAddress);
                while ($address = mysqli_fetch_array($resultAddress)){
            ?>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <select name="labelalamat" class="form-control input-field" id="floatingInputValue" required>
                    <option value="Rumah" <?php if($address['addressName']=='Rumah') echo 'selected="selected"'; ?>>Rumah</option>
                    <option value="Apartemen" <?php if($address['addressName']=='Apartemen') echo 'selected="selected"'; ?>>Apartemen</option>
                    <option value="Kantor" <?php if($address['addressName']=='Kantor') echo 'selected="selected"'; ?>>Kantor</option>
                </select>
                <label for="floatingSelectGrid" class="label">Label Alamat</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <input type="text" name="namapenerima" id="floatingInputValue" class="form-control input-field" value="<?php echo $address['recipientName']; ?>" required>
                <label for="floatingInputValue" class="label">Nama Penerima</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <input type="text" name="handphonepenerima" id="floatingInputValue" class="form-control input-field" value="<?php echo $address['recipientPhone']; ?>" required>
                <label for="floatingInputValue" class="label">No. Handphone Penerima</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <select name="provinsi" class="form-control input-field" id="floatingInputValue" required>
                    <option value="Banten" <?php if($address['region']=='Banten') echo 'selected="selected"'; ?>>Banten</option>
                </select>
                <label for="floatingSelectGrid" class="label">Provinsi</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <select name="kabupaten" class="form-control input-field" id="floatingInputValue" required>
                    <option value="Kabupaten Tangerang" <?php if($address['city']=='Kabupaten Tangerang') echo 'selected="selected"'; ?>>Kabupaten Tangerang</option>
                    <option value="Kota Tangerang" <?php if($address['city']=='Kota Tangerang') echo 'selected="selected"'; ?>>Kota Tangerang</option>
                    <option value="Kota Tangerang Selatan" <?php if($address['city']=='Kota Tangerang Selatan') echo 'selected="selected"'; ?>>Kota Tangerang Selatan</option>
                </select>
                <label for="floatingSelectGrid" class="label">Kabupaten/Kota</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <input type="text" name="detailalamat" id="floatingInputValue" class="form-control input-field" value="<?php echo $address['addressDetail']; ?>"  required>
                <label for="floatingInputValue" class="label">Detail Alamat</label>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-floating mb-3">
                <input type="text" name="kodepos" id="floatingInputValue" class="form-control input-field" value="<?php echo $address['postalCode']; ?>"  required>
                <label for="floatingInputValue" class="label">Kode Pos</label>
              </div>
            </div>
            <?php } } ?>
            <?php
            if(!isset($_GET['addressID'])){
              /*echo $addressDetail;*/

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<select name=\"labelalamat\" id=\"floatingInputValue\" class=\"form-control input-field\" required>";
              echo "<option value=\"Rumah\">Rumah</option>";
              echo "<option value=\"Apartmen\">Apartemen</option>";
              echo "<option value=\"Kantor\">Kantor</option>";
              echo "</select>";
              echo "<label for=\"floatingSelectGrid\" class=\"label\">Label Alamat</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<input type=\"text\" name=\"namapenerima\" id=\"floatingInputValue\" class=\"form-control input-field\" value=\"\" required>";
              echo "<label for=\"floatingInputValue\" class=\"label\">Nama Penerima</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<input type=\"text\" name=\"handphonepenerima\" id=\"floatingInputValue\" class=\"form-control input-field\" value=\"\" required>";
              echo "<label for=\"floatingInputValue\" class=\"label\">No. Handphone Penerima</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<select name=\"provinsi\" id=\"floatingInputValue\" class=\"form-control input-field\" required>";
              echo "<option value=\"Banten\">Banten</option>";
              echo "</select>";
              echo "<label for=\"floatingSelectGrid\" class=\"label\">Provinsi</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<select name=\"kabupaten\" id=\"floatingInputValue\" class=\"form-control input-field\" required>";
              echo "<option value=\"Kabupaten Tangerang\">Kabupaten Tangerang</option>";
              echo "<option value=\"Kota Tangerang\">Kota Tangerang</option>";
              echo "<option value=\"Kota Tangerang Selatan\">Kota Tangerang Selatan</option>";
              echo "</select>";
              echo "<label for=\"floatingSelectGrid\" class=\"label\">Kabupaten/Kota</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<input type=\"text\" name=\"detailalamat\" id=\"floatingInputValue\" class=\"form-control input-field\" value=\"\" required>";
              echo "<label for=\"floatingInputValue\" class=\"label\">Detail Alamat</label>";
              echo "</div>";
              echo "</div>";

              echo "<div class=\"col-sm-9\">";
              echo "<div class=\"form-floating mb-3\">";
              echo "<input type=\"text\" name=\"kodepos\" id=\"floatingInputValue\" class=\"form-control input-field\" value=\"\" required>";
              echo "<label for=\"floatingInputValue\" class=\"label\">Kode Pos</label>";
              echo "</div>";
              echo "</div>";
            }
            ?>
          </div>
        </div>
      </div>

      <br>
      <div class="col-lg-12 method">
        <div class="card">
          <div class="card-body">
            <div class="shipping-methods">
              <div class="section-title">
                <h4 class="title">Metode Pengiriman</h4>
              </div>
              <div class="input-checkbox">
                <input type="radio" name="shippingmethod" id="shipping-1" value="GoSend" checked>
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
                <h4 class="title">Metode Pembayaran</h4>
              </div>
              <div class="input-checkbox">
                <input type="radio" name="paymentmethod" id="payments-1" value="Bank Transfer" checked>
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
                  <hr>
                  <!-- <form action="customer_pembayaran_act.php" method="post" enctype="multipart/form-data"> -->
          					<div class="form-group">
                      <input type="hidden" name="id" value="<?php echo $id_invoice; ?>">
                      <h4 class="title label">Upload Bukti Pembayaran</h4>
                      <small class="text-muted">File yang diperbolehkan hanya file gambar berfomat .png, .jpg, & .jpeg.</small><br>
          						<input type="file" class="inputfile" name="bukti" required="required" accept="image/png, image/jpg, image/jpeg"><br>
          					</div>
                    <!-- <input type="submit" class="btn btn-primary px-4" value="Upload Bukti Pembayaran"> -->
      				    <!-- </form> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <br>
      <div class="col-lg-12 review">
        <div class="card">
          <div class="card-body">
            <h4>Review Pesanan</h4>
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
                         <th class="border-0 bg-light pull-left">Produk</th>
                         <th class="border-0 bg-light">Toko</th>
                         <th class="border-0 bg-light">Harga</th>
                         <th class="border-0 bg-light">Jumlah</th>
                         <th class="border-0 bg-light">Total Harga</th>
                       </tr>
                     </thead>
                     <tbody>
                        <?php
                          require 'database connection.php';
                          $user_id = $_SESSION['user_id'];
                          $stmt = $con->prepare("SELECT *, cart.productQuantity, merchant.merchantName, product.productUnit_id, productUnit.productUnit
                            FROM cart
                            JOIN merchant ON cart.merchant_id = merchant.merchant_id
                            JOIN product ON cart.product_id = product.product_id
                            JOIN productUnit ON product.productUnit_id = productunit.productUnit_id
                            WHERE customer_id='$user_id'");
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $grand_total = 0;
                          while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                          <td class="border-0">
                            <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                            <div class = "pull-left">
                              <img src="<?= $row['productImage'] ?>" width="50" height="50">
                              <div class="ml-3 d-inline-block align-middle">
                              <h6 class="mb-0"><?= $row['productName'] ?></h6><span class="text-muted font-weight-normal font-italic d-block"><small><?= $row['productAmount'], " ", $row['productUnit'] ?></small></span>
                              </div>
                           </div>
                          </td>
                          <td class="border-0">
                            <?= $row['merchantName'] ?>
                          </td>
                          <td class="border-0">
                            Rp <?= number_format($row['productPrice']); ?>
                          </td>
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
                         <td class="text-muted pull-left"><small>Total Harga</td>
                         <td class="text-muted pull-right"><small>Rp <?= number_format($grand_total); ?></td>
                         <input type ="hidden" name="grandtotal" value="<?= $grand_total; ?>">
                       </tr>
                       <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-muted pull-left"><small>Biaya Pengiriman</td>
                        <td class="text-muted pull-right"><small>Rp 10,000</td>
                        <input type ="hidden" name="biayapengiriman" value="10000">
                       </tr>
                       <tr>
                        <?php $purchase_total = $grand_total + 10000; ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="pull-left"><b>Total Belanja</b></td>
                        <td class="pull-right"><b>Rp <?= number_format($purchase_total); ?></b></td>
                        <input type ="hidden" name="purchasetotal" value="<?= $purchase_total; ?>">
                       </tr>
                       <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="pull-right">
                          <input type="submit" name="submit" class="btn btn-primary px-4" style="width:210px;" value="Beli">
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
    </div>
  </form>

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
      box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
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
