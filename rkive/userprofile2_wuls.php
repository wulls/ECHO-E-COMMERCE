<?php include "database connection.php";

session_start();
if (isset($_SESSION['user_id'])) {
include_once ('newnavbarlogin.php');
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
          $user_id = $_SESSION['user_id'];
          $sql = "SELECT * FROM customer WHERE customer_id = '$user_id'";
          $sql2 = "SELECT CR.rewardPoint, RL.levelName, ROUND ((CR.rewardPoint - RL.lowerLimit) / 49 * 100, 0) AS pointPercent, RL.upperLimit-CR.rewardPoint+1 AS pointUntil, RL.image
                  FROM customerreward CR
                  JOIN rewardlevel RL ON CR.rewardPoint
                  BETWEEN RL.lowerLimit AND RL.upperLimit
                  WHERE CR.customer_id='$user_id'"; //return customer level
          
          $result2 = mysqli_query($con, $sql2);
          $result = mysqli_query($con,$sql);
          $custreward = mysqli_fetch_array($result2);
          $row = mysqli_fetch_array($result);

          $levelname = $custreward['levelName'];
          $levelpoint = $custreward['rewardPoint'];
          $pointUntil = $custreward['pointUntil'];
          $pointPercent = $custreward['pointPercent'];
          $levelImage = $custreward['image'];
          $firstName = $row['firstName'];
          $lastName = $row['lastName'];
          $username = $row['username'];
          $email = $row['email'];
          $phone = $row['phone'];
          $gender = $row['gender'];
          ?>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center"><br>
                    <img src="image/magician.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <?php echo '<h4>'.$username.'</h4>' ?>
                      <p class="text-secondary mb-1"><?php echo $levelname?> - <?php echo $levelpoint?></p>
                    </div>
                    <br>
                      <img src=<?php echo $levelImage?> style="height:25%;width:25%">
                  </div>
                  <br>
                  <div class="progress" style="border-radius:.9rem;background-color:lightgrey;">
                    <div class="progress-bar" style="background-color:#34BE82;width:<?php echo $pointPercent?>%"></div>
                  </div>
                  <p>
                    <?php
                      if($levelpoint < 150){
                        echo $pointUntil." XP to your next level";
                      }else{
                        echo "You have reached the highest level";
                      }
                    ?>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">

                  <br>
                  <div class="d-flex flex-column align-items-center text-center">
                    <div class="row">
                      <div class="col">
                        <p class="mb-0"><button onclick="replace('dataAlamat','dataAkun','dataDiri')" class="navProfile">Profile</button></p>
                      </div>
                      <div class="col">
                        <p class="mb-0" style="padding-left:90px;padding-right:90px;"><button onclick="replace('dataDiri','dataAkun','dataAlamat')" class="navProfile">Address</button></p>
                      </div>
                      <div class="col">
                        <p class="mb-0"><button onclick="replace('dataDiri','dataAlamat','dataAkun')" class="navProfile">Account</button></p>
                      </div>
                    </div>
                  </div>

                  <!--***************DATA DIRI START***************-->
                  <br>
                  <div id="dataDiri" style="padding-left:25px;padding-right:25px;">
							      <form action="userprofile_update.php" method="post">
							        <div class="row mb-3">
								        <div class="col-sm-3">
									        <h6 class="mb-0">First Name</h6>
								        </div>
								        <div class="col-sm-9 text-secondary">
									        <input type="text" name="firstName" class="form-control input-field" value="<?php echo $firstName?>">
								        </div>
							        </div>
							        <div class="row mb-3">
								        <div class="col-sm-3">
									        <h6 class="mb-0">Last Name</h6>
								        </div>
								        <div class="col-sm-9 text-secondary">
									        <input type="text" name="lastName" class="form-control input-field" value="<?php echo $lastName?>">
								        </div>
							        </div>
							        <div class="row mb-3">
								        <div class="col-sm-3">
									        <h6 class="mb-0">Gender</h6>
								        </div>
								        <div class="col-sm-9 text-secondary">
									        <select class="form-control input-field" name="gender">
										        <option value="Female" <?php if($gender=="Female") echo 'selected="selected"'; ?>>Female</option>
										        <option value="Male" <?php if($gender=="Male") echo 'selected="selected"'; ?>>Male</option>
									        </select>
								        </div>
							        </div>
							        <div class="row mb-3">
								        <div class="col-sm-3">
									        <h6 class="mb-0">Email</h6>
								        </div>
								        <div class="col-sm-9 text-secondary">
									        <input type="text" name="email" class="form-control input-field" value="<?php echo $email?>">
								        </div>
							        </div>
							        <div class="row mb-3">
								        <div class="col-sm-3">
									        <h6 class="mb-0">Phone Number</h6>
								        </div>
								        <div class="col-sm-9 text-secondary">
									        <input type="text" name="phone" class="form-control input-field" value="<?php echo $phone?>">
								        </div>
							        </div>
							        <br>
							        <div class="row">
								        <div class="col-sm-3"></div>
								          <div class="col-sm-9 text-secondary">
									          <input type="submit" class="btn btn-primary px-4" value="Save Changes" style="background-color:#2F86A6;border-radius: 45px;">
								          </div>
							          </div>
							      </form>
							    </div>
                <!--***************DATA DIRI END***************-->
                
                <!--***************DATA AKUN START***************-->
                <div id="dataAkun" style="display:none;padding-left:25px;padding-right:25px;">
                  <div class="row">
                    <div class="col-sm-3">
                     <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $username?>
                    </div>
                  </div>
                  <br>
                </div>
                <!--***************DATA AKUN END***************-->

                <!--***************DATA ALAMAT START*************-->
                <div id="dataAlamat" style="display:none;padding-left:25px;padding-right:25px;">
                  <div class="d-flex flex-column align-items-end text-center">
                   <button id="addAddress" data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-primary px-4" style="background-color:#2F86A6;border-radius: 45px;">Add New Address</button>
                  </div><br>
                <?php
                $sql3 = "SELECT CA.addressName, CA.recipientName, CA.address FROM customeraddress CA WHERE customer_id='$user_id';"; //return customer address
                $result3 = mysqli_query($con, $sql3);
                $countrow = mysqli_num_rows($result3);
                if($countrow > 0){
                while($custaddress = mysqli_fetch_array($result3)){
                  $addressName = $custaddress['addressName'];
                  $recipientName = $custaddress['recipientName'];
                  $address = $custaddress['addressDetail'];
                ?>
                <div class="card">
                  <div class="card-body" style="padding-left:30px">
                  <div class="row">
                    <div class="col-sm-9 text-secondary">
                      <?php echo $addressName?>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-9 text-secondary">
                      <?php echo $recipientName?>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-9 text-secondary">
                      <?php echo $address?>
                    </div>
                  </div>
                  </div>
                </div><br>
                <?php } } ?>
                </div>
                <!--***************DATA ALAMAT END***************-->

                <!--***************ADD & EDIT ADDRESS START***************-->
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content" style="border-radius: .9rem;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body"><br>
                        <form action="userprofile_add_address.php" method="post">
                          <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">Recipient Name</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input name="phone" type="tel" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">Recipient Phone Number</label>
                          </div>
                          <div class="form-floating mb-3">
                            <select name="label" class="form-select input-field" id="floatingSelectGrid" placeholder="name@example.com" value="">
                              <option value="Home">Home</option>
                              <option value="Home">Apartment</option>
                              <option value="Home">Office</option>
                            </select>
                            <label for="floatingSelectGrid">Address Label</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input name="city" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">City</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">Region</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">Address Details</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" value="">
                            <label for="floatingInputValue">Postal Code</label>
                          </div>
						              <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 45px;">Close</button>
                            <input type="submit" class="btn btn-primary" style="background-color:#2F86A6;border-radius: 45px;" value="Save Address">
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
				</div>
				<!--***************ADD & EDIT ADDRESS END***************-->
            </div>

            </div>
          </div>
        </div>
    </div>
</div>
    <script>
      function replace(hide1, hide2, show){
        document.getElementById(hide1).style.display="none";
        document.getElementById(hide2).style.display="none";
        document.getElementById(show).style.display="block";
      }
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
.navProfile{
  border: none;
  text-decoration: none;
  background-color: transparent;
	text-align: center;
}
.navProfile:focus{
	font-weight: bold;
}
.card {
  box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
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
.input-field{
	background-color: #f0f0f0;
	border-radius: 45px;
	border: 0 solid transparent;	
}

</style>

<script type="text/javascript">

</script>
</body>
</html>
