<?php
  session_start();
  //require_once('indexcomponent3.php');
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
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index5.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Home</a>\
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="cart3.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {echo $_SESSION['showAlert'];} else {echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
         <table class="table table-bordered table-striped text-center">
           <thead>
             <tr>
               <td colspan="7">
                 <h4 class="text-center text-info m-0">Products in your cart!</h4>
               </td>
             </tr>
             <tr>

               <th>Image</th>
               <th>Product</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Total Price</th>
               <th>
                 <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
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

                <td><img src="<?= $row['productImage'] ?>" width="50"></td>
                <td><?= $row['productName'] ?></td>
                <td>
                  <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['productPrice'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['productPrice'] ?>">
                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['productQuantity'] ?>" style="width:75px;">
                </td>
                <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['totalPrice'],2); ?></td>
                <td>
                  <a href="action2.php?remove=<?= $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['totalPrice']; ?>
              <?php endwhile; ?>
              <tr>
               <td colspan="3">
                 <a href="index5.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                   Shopping</a>
               </td>
               <td colspan="2"><b>Grand Total</b></td>
               <td><b>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
               <td>
                 <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
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
      var pquantity = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action2.php',
        method: 'post',
        cache: false,
        data: {
          pquantity: pquantity,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
       load_cart_item_number();

       function load_cart_item_number() {
         $.ajax({
           url: 'action2.php',
           method: 'get',
           data: {
             cartItem: "cart_item"
           },
           success: function(response) {
             $("#cart-item").html(response);
           }
         });
       }
     });
   </script>
</body>
</html>
