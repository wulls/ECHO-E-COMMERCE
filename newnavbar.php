<!DOCTYPE html>
<html lang="en">
<head>
  <title>Trolley</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
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

  <nav class="navbar navbar-expand-lg" style="background-color:#34BE82">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="image/logo2.svg" alt="Trolley" height="70">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <i class="fas fa-shopping-cart cart"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profile
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="Login.php">Login</a></li>
              <!--li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li-->
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>
