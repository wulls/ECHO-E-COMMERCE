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
    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Product</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Merchant</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantity</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Total Price</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">
                        <a href="action7.php?clear=all" class="badge-danger p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear</a>
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'database connection.php';
                    $stmt = $con->prepare('SELECT * FROM cart');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()):
                  ?>
                  <tr>
                    <th scope="row" class="border-0">
                      <div class="p-2">
                        <img src="<?= $row['productImage'] ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                        <div class="ml-3 d-inline-block align-middle">
                          <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $row['productName'] ?></a></h5><span class="text-muted font-weight-normal d-block"><?= $row['productAmount'], " ", $row['productUnit'] ?></span>
                        </div>
                      </div>
                    </th>
                    <td class="border-0 align-middle"><strong><?= $row['merchant_id'] ?></strong></td>
                    <td class="border-0 align-middle"><strong> Rp <?= number_format($row['productPrice']) ?></strong></td>
                    <td class="border-0 align-middle"><strong><?= $row['productQuantity'] ?></strong></td>
                    <td class="border-0 align-middle"><strong> Rp <?= number_format($row['totalPrice']) ?></strong></td>
                    <td class="border-0 align-middle"><a href="action7.php?remove=<?= $row['cart_id'] ?>" class="text-dark" onclick="return confirm('Are you sure want to remove this item?');"><i class="fa fa-trash"></i></a></td>
                  </tr>
                  <?php $grand_total += $row['totalPrice']; ?>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
            <div class="p-4">
              <ul class="list-unstyled mb-4">
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>Rp <?= number_format($grand_total); ?></strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>Rp 0</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>Rp 0</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                  <h5 class="font-weight-bold">Rp <?= number_format($grand_total); ?></h5>
                </li>
              </ul><a href="checkout7.php" class="btn">Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
