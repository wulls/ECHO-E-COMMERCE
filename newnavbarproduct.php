<!DOCTYPE html>
<html lang="en">
<head>
  <title>TROLLEY</title>
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
  </style>
</head>
<body>

<div id="header">
    <nav class="navbar navbar-expand-lg" style="background-color:#34BE82;">
        <div class="container">
            <a class="navbar-brand" href="main page.php">
                <img src="image/logo2.svg" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style="padding-left: 100px;padding-top:10px">
                <div class="form-floating mb-3">
                    <input name="phone" type="text" class="form-control input-field" id="floatingInputValue" placeholder="Buy From" style="border:0 solid transparent;border-radius:15px;width:210px;box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.25);">
                    <label for="floatingInputValue">Buy from</label>
                </div>
            </div>
            <div style="padding-left: 50px;padding-top:10px">
                <div class="form-floating mb-3">
                    <input name="phone" type="text" class="form-control input-field" id="floatingInputValue" placeholder="Deliver to" style="border:0 solid transparent;border-radius:15px;width:210px;box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.25);">
                    <label for="floatingInputValue">Deliver to</label>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" aria-current="page" href="cart7.php">
                        <i class="fas fa-shopping-cart"></i>
                        <?php
                            require 'database connection.php';
                            $cart_number = 0;
                            $stmt = $con->prepare('SELECT * FROM cart');
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
                                <a class="dropdown-item" href="#">Logout</a>
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
