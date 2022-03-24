<?php include "database connection.php";

session_start();
if (isset($_SESSION['user_id'])) {
include_once ('newnavbarlogin.php');
//echo $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TROLLEY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

	<?php include "database connection.php";
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM customer WHERE customer_id = '$user_id'";

	$result = mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		$gender = $row['gender'];
		$email = $row['email'];
		$phone = $row['phone'];
	?>

<div class="container">
		<div class="main-body">

            <br><br>
			<div class="row">
			<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column">
								<div class="mt-3">
									<p><button onclick="replace('address','editProfile')" class="sidebar">Edit Profile</button></p><br>
									<p><button onclick="replace('editProfile','address')" class="sidebar">Address</button></p><br>
									<p><button class="sidebar">Account</button></p>
									<br><br><br><br><br><br><br>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
						<!--***************EDIT PROFLE START***************-->
							<div id="editProfile">
							<form action="userprofile_update.php" method="post">
							<h2>Edit Profile</h2><br>
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
									<input type="submit" class="btn btn-primary px-4" value="Save Changes" style="background-color:#2F86A6">
								</div>
							</div>
							</form>
							</div>
						<!--***************EDIT PROFLE END***************-->

						<!--***************ADDRESS START***************-->
						<div id="address" style="display:none">
						<h2>Address</h2><br>
						<?php
                		$sql3 = "SELECT CA.addressName, CA.recipientName, CA.address FROM customeraddress CA WHERE customer_id='$user_id';"; //return customer address
                		$result3 = mysqli_query($con, $sql3);
                		$countrow = mysqli_num_rows($result3);
                		
						if($countrow > 0){
                			while($custaddress = mysqli_fetch_array($result3)){
                  				$addressName = $custaddress['addressName'];
                  				$recipientName = $custaddress['recipientName'];
                  				$address = $custaddress['address'];
                		?>
                  			<div class="row">
                    			<div class="col-sm-3">
                     				<h6 class="mb-0">Nama Alamat</h6>
                    			</div>
                    			<div class="col-sm-9 text-secondary">
                      				<?php echo $addressName?>
                    			</div>
                  			</div>
                  			<br>
                  			<div class="row">
                    			<div class="col-sm-3">
                     				<h6 class="mb-0">Nama Penerima</h6>
                    			</div>
                    			<div class="col-sm-9 text-secondary">
                      				<?php echo $recipientName?>
                    			</div>
                  			</div>
                  			<br>
                  			<div class="row">
                    			<div class="col-sm-3">
                     				<h6 class="mb-0">Detail Alamat</h6>
                    			</div>
                    			<div class="col-sm-9 text-secondary">
                      				<?php echo $address?>
                    			</div>
                  			</div>
                  			<hr>
                  		<?php } } ?>
                		</div>
						<!--***************ADDRESS END***************-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	function replace(hide1, show){
		document.getElementById(hide1).style.display="none";
		document.getElementById(show).style.display="block";
	}
</script>

<style type="text/css">
body{
    background: #fff;
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
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
	border-radius: .9rem;
}
.me-2 {
    margin-right: .5rem!important;
}
.input-field{
	background-color: #f0f0f0;
	border-radius: 45px;
	border: 0 solid transparent;	
}
.mt-3{
	padding-left: 25px;
	padding-top: 8.5px;
	font-size: 18px;
}
.sidebar{
	border: none;
  	text-decoration: none;
  	background-color: transparent;
	text-align: center;
}
.sidebar:focus{
	font-weight: bold;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>