<?php include "database connection.php";

session_start();
if(!isset($_SESSION['username'])){
 include_once ('navbar.php');
}

if (isset($_SESSION['username'])) {
include_once ('navbarlogin.php');
// echo $_SESSION['username'];
}

// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Trolley</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/main page.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

      <!--php-->
      <!--?php include "database connection.php";
      $username = $_POST["username"];
      $password = $_POST["password"];

      $sql = "SELECT * FROM customer WHERE username='$username' AND password='$password';";
      $query = mysqli_query($con, $sql);
      $rows = mysqli_num_rows($query);

      if($rows<1){
        header("Location:login.php");
      }

      while($data = mysqli_fetch_array($query)){
      ?-->

        <!-- Masthead-->
        <header class="masthead">
         <div class="container position-relative">
          <div class="row justify-content-center">
           <div class="col-xl-6">
            <div class="text-center text-white">
             <!--h1 class="mb-5">Banner</h1--> 
			 <!--**************************CAROUSEL***********************-->
			 

            </div>
           </div>
          </div>
         </div>
        </header>
		
		<!--******************REKOMENDASI TOKO<!--******************-->
        <section class="features-icons bg-light text-center">
		 <h2 class="txtrekomtoko">Rekomendasi Toko</h2>
		
		 <div class="container">
          <div class="row">
		   <?php
		    $sql = "SELECT * FROM merchant;";
		    $result = mysqli_query($con,$sql);
		     while($row=mysqli_fetch_array($result)){
			  echo "<div class='col-lg-4'>";
			  echo "<div class='features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3'>";
			  echo "<div class='features-icons-icon d-flex'>";
			  echo "<img src=".$row['image']." alt='logo store' class='text-primary logotoko'>";
			  echo "</div>";
			  echo "<h4>".$row['merchantName']."</h4>";
			  // echo "<p class='lead mb-0'>Jalan Jalur Sutera Barat Kav. 16</p>";
			  echo "</div>";
			  echo "</div>";
			  }
			  ?>
		  </div>
         </div>
        </section>
		
        <!-- Footer -->
        <footer class="footer bg-light">
         <div class="container">
          <div class="row">
           <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
            <ul class="list-inline mb-2">
             <li class="list-inline-item"><a href="#!">About</a></li>
             <li class="list-inline-item">⋅</li>
             <li class="list-inline-item"><a href="#!">Contact</a></li>
             <li class="list-inline-item">⋅</li>
             <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
             <li class="list-inline-item">⋅</li>
             <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
            </ul>
            
			<p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2021. All Rights Reserved.</p>
           </div>
           
		   <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item me-4">
               <a href="#!"><i class="bi-facebook fs-3"></i></a>
              </li>
              <li class="list-inline-item me-4">
               <a href="#!"><i class="bi-twitter fs-3"></i></a>
              </li>
              <li class="list-inline-item">
               <a href="#!"><i class="bi-instagram fs-3"></i></a>
              </li>
            </ul>
           </div>
          </div>
         </div>
        </footer>
		
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
      <!--?php } ?-->
    </body>
</html>
