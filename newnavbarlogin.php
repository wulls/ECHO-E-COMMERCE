<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .sticky {
    position: fixed;
    top: 0;
    width: 100%;
    }
    #header{
      z-index: 1;
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

<div id="header">
  <nav class="navbar navbar-expand-lg" style="background-color:#34BE82;">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="image/logo2.svg" height="70">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <img src="image/small icons/menu.png" height="30">
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link active" aria-current="page" href="cart.php">
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
              Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="test_userprofile.php">Profil</a>
              </li>
              <li>
                <a class="dropdown-item" href="history2.php">Riwayat</a>
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

  <!--
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
-->
</body>
</html>
