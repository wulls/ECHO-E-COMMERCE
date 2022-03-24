<?php include "database connection.php";

session_start();
if(!isset($_SESSION['user_id'])){
 include_once ('newnavbar.php');
}

if (isset($_SESSION['user_id'])) {
  include_once ('newnavbarlogin.php');
  //echo $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Trolley</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="css/main page.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <!-- Masthead-->
<header class="masthead">
 <div class="container position-relative">
  <div class="row justify-content-center">
   <div class="center">
    <div class="col-xl-6">
     <div class="text-center text-white">
             <!--h1 class="mb-5"></h1-->
    <!--**************************CAROUSEL***********************-->
      <!--?php include 'carousel.php';?-->

      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" style="width:83vw;height:30vw;border-radius: .95rem;">
          <div class="carousel-item active">
            <img src="image/carousel/promo1.jpg" class="d-block w-100" alt="promo">
          </div>
          <div class="carousel-item">
            <img src="image/carousel/promo2.jpg" class="d-block w-100" alt="promo">
          </div>
          <div class="carousel-item">
            <img src="image/carousel/promo1.jpg" class="d-block w-100" alt="promo">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="width:5rem;">
          <span class="carousel-control-prev" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="width:2rem">
          <span class="carousel-control-next" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

     </div>
    </div>
   </div>
  </div>
 </div>
</header>
  <!--******************REKOMENDASI TOKO******************-->

  <section class="features-icons bg-light text-center">

    <div class="container">
      <div class="pstn">
         <input type="text" class="form-control" id="search_address" placeholder="Masukkan alamat pengantaran" />
      </div>

   <h2 class="txtrekomtoko">Rekomendasi Toko</h2>

          <div class="row">
     <?php
      $sql = "SELECT * FROM merchant;";
      $result = mysqli_query($con,$sql);
       while($row=mysqli_fetch_array($result)){?>

      <div class='col-lg-4'>
       <div class='features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3'>
        <div class='features-icons-icon d-flex'>
         <form action="main page2.php" method="get">
         <input type="hidden" name="merchant_id" value=<?php echo $row['merchant_id']?> >
         <!--echo '<a href="index3.php?id='.$row['merchant_id'].'">';-->
         <input type="image" src=<?php echo $row['image']?> alt="logo store" class='text-primary logotoko'>
         <!--"</a>";-->
         </form>
        </div>
       <h4><?php echo $row['merchantName']?></h4>
      </div>
     </div>
    <?php } ?>


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
        <script>
         function activatePlacesSearch(){
           var input = document.getElementById('search_address');
           var autocomplete = new google.maps.places.Autocomplete(input);
         }
         google.maps.event.addDomListener(window, 'load', initialize);
         </script>
         <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_sQp8WSMj7cYX6tpqBxfsDSsYJwauAJ4&libraries=places&callback=activatePlacesSearch">
         </script>
      <!--?php } ?-->
    </body>
</html>
