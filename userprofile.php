<?php include "database connection.php";

session_start();
if (isset($_SESSION['username'])) {
include_once ('navbarlogin.php');
//echo $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <div class="main-body">

          <br>

          <?php include "database connection.php";
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM customer WHERE username = '$username'";
          $result = mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($result)){
              $firstName = $row['firstName'];
              $lastName = $row['lastName'];
              $email = $row['email'];
              $phone = $row['phone'];
          ?>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://cdn-icons.flaticon.com/png/512/1144/premium/1144709.png?token=exp=1646875224~hmac=5a418fff0c97d1440fa605bd6799f44d" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <?php echo '<h4>'.$firstName.' '.$lastName.'</h4>' ?>
                      <p class="text-secondary mb-1">Flower - 325 pts</p>
                      <p class="text-muted font-size-sm">Membership</p>
                      <!--button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">

                <br>

                  <div class="row">
                    <div class="col">
                      <button onclick="myFunction()"><h6 class="mb-0">Data Diri</h6></a>
                    </div>
                    <div class="col">
                      <h6>Data Alamat</h6>
                    </div>
                    <div class="col">
                      <h6>Akun</h6>
                    </div>
                  </div>

                  <br>
                  <!--***************DATA DIRI START***************-->
                  <div id="dataDiri">
                   <div class="row">
                    <div class="col-sm-3">
                     <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $firstName.' '.$lastName ?>
                    </div>
                  </div>

                  <!--hr--><br>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Female
                    </div>
                  </div>

                  <!--hr--><br>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $email ?>
                    </div>
                  </div>

                  <!--hr--><br>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $phone ?>
                    </div>
                  </div>

                  <!--hr--><br>

                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit Profile</a>
                    </div>
                  </div>
                </div>
                <!--***************DATA DIRI END***************-->

              </div>
            </div>

            </div>
          </div>
        <?php } ?>
        </div>
    </div>

    <script>

    </script>

<style type="text/css">
body{
    color: #1a202c;
    text-align: left;
    background-color: #fff;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #C9C9C9;
    border-radius: .9rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

</style>

<script type="text/javascript">

</script>
</body>
</html>
