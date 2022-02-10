<!DOCTYPE html>

<html>

<head></head>

<body>

<?php include "database connection.php";

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username2 = $_POST["username2"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password2 = $_POST["password2"];

$sql2 = "SELECT username FROM customer WHERE username='$username2'";
$query2 = mysqli_query($con, $sql2);
$rows2 = mysqli_num_rows($query2);

      if($rows2===1){
    	  echo "fail sign up";
      }
      else if($rows2==0){
    	$sql3 = "INSERT INTO customer (username, password, firstName, lastName, phone, email) VALUES ('$username2','$password2','$firstname','$lastname','$phone','$email');";
		
		$query3 = mysqli_query($con, $sql3);
		
		if($query3){
		 // session_start();
		 // $_SESSION['username2']=$username;
		 header("Location: login.php");
		}else{
		 echo "something went wrong";
		 }
	  }
	  


?>

</body>

</html>