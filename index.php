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

        <!-- Untuk menampilkan cart -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    </head>
    <body>

        <!-- Masthead-->
<header class="masthead">
 <div class="container position-relative">
  <div class="d-flex justify-content-center">
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
      <div class="d-flex justify-content-center pstn">
        <input type="text" class="form-control" id="toko" placeholder="Cari Toko" style="border-radius:4px;" />
      </div>
      <h2 class="txtrekomtoko">Rekomendasi Toko</h2>
      <div class="row" id="output">
        <?php
        $sql = "SELECT * FROM merchant;";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_array($result)){?>

          <div class='col-lg-4'>
            <div class='features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3'>
              <div class='features-icons-icon d-flex'>
                <form action="main page2.php" method="get">
                  <input type="hidden" name="merchant_id" value=<?php echo $row['merchant_id']?> >
                  <input type="image" src=<?php echo $row['image']?> alt="logo store" class="text-primary logotoko">
                </form>
              </div>
              <h4 style="padding-top:25px;padding-bottom:30px;"><?php echo $row['merchantName']?></h4>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

        <!-- Footer -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

         <script type="text/javascript">
           $('#toko').on('keyup',searchToko);
          function searchToko(){
            const keyword = $('#toko').val();
            const url = 'searchtoko.php';
            $.get(url, {
              keyword
              }, function(response){
                response = JSON.parse(response);
                let element = '';
                response.forEach((data) => {
                    element += `
                    <div class='col-lg-4'>
                      <div class='features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3'>
                        <div class='features-icons-icon d-flex'>
                          <form action="main page2.php" method="get">
                            <input type="hidden" name="merchant_id" value= "${data.merchant_id}" >
                            <input type="image" src="${data.image}" alt="logo store" class="text-primary logotoko">
                          </form>
                        </div>
                        <h4 style="padding-top:25px;padding-bottom:30px;">${data.merchantName}</h4>
                      </div>
                    </div>
                    `;
                });
                $('#output').html(element);

            });
        }
         </script>



      <!--?php } ?-->
    </body>
</html>
