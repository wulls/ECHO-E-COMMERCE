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

<?php
    $user_id = $_SESSION['user_id'];
    $selectCustomer = "SELECT * FROM customer WHERE customer_id = '$user_id'";
    $selectReward = "SELECT CR.rewardPoint, RL.levelName, ROUND ((CR.rewardPoint - RL.lowerLimit) / 49 * 100, 0) AS pointPercent, RL.upperLimit-CR.rewardPoint+1 AS pointUntil, RL.image
                    FROM customerreward CR
                    JOIN rewardlevel RL ON CR.rewardPoint
                    BETWEEN RL.lowerLimit AND RL.upperLimit
                    WHERE CR.customer_id='$user_id'";

    $resultCustomer = mysqli_query($con, $selectCustomer);
    $resultReward = mysqli_query($con, $selectReward);

    $countReward = mysqli_num_rows($resultReward);
    if($countReward == 0){
        $insertPoint = "INSERT INTO customerreward (customer_id, rewardPoint) VALUES ('$user_id','0')";
        $insert = mysqli_query($con,$insertPoint);
        header("Location: test_userprofile.php");
    }

    $customer = mysqli_fetch_array($resultCustomer);
    $reward = mysqli_fetch_array($resultReward);
?>

<div class="container">
    <div class="main-body"><br>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="image/magician.png" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <?php echo '<h4>'.$customer['username'].'</h4>'; ?>
                                <p class="text-secondary mb-1"><?php echo $reward['levelName'];?> - <?php echo $reward['rewardPoint'];?></p>
                            </div><br>
                            <img src=<?php echo $reward['image'];?> class="level-icon">
                        </div><br>
                        <div class="progress bg-progress">
                            <div class="progress-bar" style="background-color:#34BE82;width:<?php echo $reward['pointPercent']?>%"></div>
                        </div>
                        <p>
                            <?php
                                if($reward['rewardPoint'] < 150){
                                    echo $reward['pointUntil']. " XP to your next level";
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
                    <div class="card-body"><br>
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0"><button onclick="replace('dataAlamat','dataAkun','dataDiri')" class="navProfile">Profile</button></p>
                                </div>
                                <div class="col">
                                    <p class="mb-0"><button onclick="replace('dataDiri','dataAkun','dataAlamat')" class="navProfile navMid">Address</button></p>
                                </div>
                                <div class="col">
                                    <p class="mb-0"><button onclick="replace('dataDiri','dataAlamat','dataAkun')"class="navProfile">Account</button></p>
                                </div>
                            </div>
                        </div><br>
                        <!--*************************DATA DIRI START*************************-->
                        <div id="dataDiri" style="padding-left:25px;padding-right:25px;">
                            <form action="userprofile_update.php" method="post">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">First Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="firstName" class="form-control input-field" value="<?php echo $customer['firstName']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Last Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="lastName" class="form-control input-field" value="<?php echo $customer['lastName']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="gender" class="form-control input-field">
                                            <option value="Female" <?php if($customer['gender']=='Female') echo 'selected="selected"'; ?>>Female</option>
                                            <option value="Male" <?php if($customer['gender']=='Male') echo 'selected="selected"'; ?>>Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="mail" name="email" class="form-control input-field" value="<?php echo $customer['email']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="tel" name="phone" class="form-control input-field" value="<?php echo $customer['phone']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-info but-ton" value="SAVE CHANGES">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--*************************DATA DIRI END*************************-->

                        <!--***********************DATA ALAMAT START***********************-->
                        <div id="dataAlamat" class="data-alamat">
                            <div class="d-flex flex-column align-items-end text-center">
                                <button id="addAddress" disabled="disabled" data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-primary px-4 but-ton">ADD ADDRESS</button>
                                <br><p id="alert" style="display:none;color:red;">Maximum number of addresses has been reached</p>
                            </div>
                            <br>
                            <?php
                                $selectAddress = "SELECT CA.addressName, CA.recipientName, CA.addressDetail, CA.address_id FROM customeraddress CA WHERE customer_id='$user_id';";
                                $resultAddress = mysqli_query($con, $selectAddress);
                                $countAddress = mysqli_num_rows($resultAddress);

                                if($countAddress == 5){
                                    echo "<script type=\"text/javascript\">
                                            document.getElementById('addAddress').disabled = true;
                                            document.getElementById('alert').style.display='block';
                                          </script>
                                         ";
                                }else if($countAddress <= 5){
                                    echo "<script type=\"text/javascript\">
                                            document.getElementById('addAddress').disabled = false;
                                         </script>
                                         ";
                                }

                                if($countAddress > 0){
                                    while($address = mysqli_fetch_array($resultAddress)){
                            ?>
                            <div class="card">
                                <div class="card-body list-address" style="padding-left:35px;padding-top:30px;">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <b><?php echo $address['addressName']; ?></b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <?php echo $address['recipientName']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <?php echo $address['addressDetail']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="align-items-end text-center" style="padding-right:35px;">
                                            <div class="float-right">
                                                <a href="#myModal" class="trash" data-id="<?php echo $address['address_id']; ?>" data-toggle="modal">
                                                    <img src="image/small icons/trash.png" alt="Delete" width="29px" height="29px">
                                                </a>
                                            </div>
                                            <div class="float-right" style="padding-right:8px;">
                                                <button type="button" class="editAddress" data-target="#editAddress<?php echo $address['address_id'];?>" data-toggle="modal" style="background-color:transparent;border:0;">
                                                    <img src="image/small icons/write.png" alt="Edit" width="25px" height="25px">
                                                </button>
                                            </div>
                                        </div>
                                        <!--****DELETE ADDRESS CONFIRMATION START****-->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Deleting Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this address? This action is irreversible.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a class="del-yes btn btn-primary" href="userprofile_delete_address.php" id="modalDelete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--*****DELETE ADDRESS CONFIRMATION END*****-->
                                    </div>
                                </div>
                            </div><br>
                        <!--*****DATA ALAMAT EDIT START*****-->
                        <div class="modal fade" id="editAddress<?php echo $address['address_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <form action="userprofile_edit_address.php" method="post">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content" style="border-radius: .9rem;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $selectDetailAddress = "SELECT * FROM customeraddress WHERE address_id='$address[address_id]'";
                                            $resultDetail = mysqli_query($con, $selectDetailAddress);
                                            $detail = mysqli_fetch_array($resultDetail);
                                            ?>
                                            <input name="id" type="hidden" value="<?php echo $address['address_id']; ?>" required>
                                            <div class="form-floating mb-3">
                                                <input name="name" type="text" value="<?php echo $detail['recipientName']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Recipient Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="phone" type="tel" value="<?php echo $detail['recipientPhone']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Recipient Phone Number</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select name="label" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                    <option value="Home" <?php if($detail['addressName']=='Home') echo 'selected="selected"'; ?>>Home</option>
                                                    <option value="Apartment" <?php if($detail['addressName']=='Apartment') echo 'selected="selected"'; ?>>Apartment</option>
                                                    <option value="Office" <?php if($detail['addressName']=='Office') echo 'selected="selected"'; ?>>Office</option>
                                                </select>
                                                <label for="floatingSelectGrid">Address Label</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="city" type="text" value="<?php echo $detail['city']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">City</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="district" type="text" value="<?php echo $detail['region']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">District</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="detail" type="text" value="<?php echo $detail['addressDetail']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Address Details</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="postalcode" type="text" value="<?php echo $detail['postalCode']; ?>" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Postal Code</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 45px;">Close</button>
                                                <input type="submit" class="btn btn-primary" style="background-color:#2F86A6;border-radius: 45px;" value="Save Address">
                                            </div>
                                            <?php ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--*****DATA ALAMAT EDIT END*****-->
                        <?php } } ?>
                        </div>
                        <!--************************DATA ALAMAT END************************-->

                        <!--*********************DATA ALAMAT ADD START********************-->
                        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content" style="border-radius: .9rem;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Address</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="userprofile_add_address.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input name="name" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Recipient Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="phone" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Recipient Phone Number</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select name="label" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                    <option value="Home">Home</option>
                                                    <option value="Apartment">Apartment</option>
                                                    <option value="Office">Office</option>
                                                </select>
                                                <label for="floatingSelectGrid">Address Label</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="city" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">City</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="district" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">District</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="detail" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
                                                <label for="floatingInputValue">Address Details</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="postalcode" type="text" class="form-control input-field" id="floatingInputValue" placeholder="name@example.com" required>
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
                        <!--**********************DATA ALAMAT ADD END*********************-->

                        <!--************************DATA AKUN START***********************-->
                        <div id="dataAkun" class="data-akun">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class=mb-0>Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="username" class="form-control input-field" value="<?php echo $customer['username']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="password" class="form-control input-field" value="<?php echo $customer['password']; ?>">
                                </div>
                            </div>
                        </div>
                        <!--*************************DATA AKUN END*************************-->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    //ACCOUNT/ADDRESS/ACCOUNT
    function replace(hide1, hide2, show){
        document.getElementById(hide1).style.display="none";
        document.getElementById(hide2).style.display="none";
        document.getElementById(show).style.display="block";
    }

    //DELETE CONFIRMATION
    $('.trash').click(function(){
        var id = $(this).data('id');
        $('#modalDelete').attr('href','userprofile_delete_address.php?id='+id);
    });
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
.navProfile{
    border: none;
    text-decoration: none;
    background-color: transparent;
    text-align: center;
}
.navProfile:focus{
	font-weight: bold;
}
.navMid{
    padding-left: 90px;
    padding-right: 90px;
}
.level-icon{
    height: 25%;
    width: 25%;
}
.bg-progress{
    border-radius:.9rem;
    background-color:lightgrey;
}
.input-field{
	background-color: #f0f0f0;
	border-radius: 45px;
	border: 0 solid transparent;
}
.row{
    padding-bottom: 15px;
}
.but-ton{
    background-color: #2F86A6;
    border-radius: 45px;
    height: 3rem;
    font-weight: bold;
    width: 35%;
}
.data-alamat{
    display:none;
    padding-left:25px;
    padding-right:25px;
}
.list-address{
    padding-left:30px;
}
.data-akun{
    display:none;
    padding-left:25px;
    padding-right:25px;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>
