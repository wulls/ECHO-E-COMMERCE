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
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-15">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {echo $_SESSION['showAlert'];} else {echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          } unset($_SESSION['showAlert']); ?></strong>
        </div>
        <br>
        <div class="table-responsive mt-2">
         <table class="table text-center">
           <thead>
             <tr>
               <th class="border-0 bg-light pull-left">Product</th>
               <th class="border-0 bg-light">Merchant</th>
               <th class="border-0 bg-light">Price</th>
               <th class="border-0 bg-light">Quantity</th>
               <th class="border-0 bg-light">Total Price</th>
               <th class="border-0 bg-light">
                 <a href="action7.php?clear=all" class="p-1 clearall" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>Clear All</a>
               </th>
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
                  <div class = "pull-left">
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
                  <input type="number" min="1" class="form-control itemQty" value="<?= $row['productQuantity'] ?>" style="width:75px;">
                </td>
                <td class="border-0">Rp <?= number_format($row['totalPrice']); ?></td>
                <td class="border-0">
                  <a href="action7.php?remove=<?= $row['cart_id'] ?>" class="text-dan lead " onclick=""><i class="fas fa-trash clear"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['totalPrice']; ?>
              <?php endwhile; ?>
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td><b>Total Price</b></td>
               <td><b>Rp <?= number_format($grand_total); ?></b></td>
               <td>
                 <a href="checkout7.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class=""></i>Place Order</a>
               </td>
             </tr>
           </tbody>
         </table>
       </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

      // Change the item quantity
      $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');

        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var productQuantity = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
          url: 'action7.php',
          method: 'post',
          cache: false,
          data: {
            productQuantity: productQuantity,
            pid: pid,
            pprice: pprice
          },
          success: function(response) {
            console.log(response);
          }
        });
      });
    });
  </script>
</body>
</html>
