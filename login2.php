<?php include "database connection.php";
      $username = $_POST["username"];
      $password = $_POST["password"];

      $sql = "SELECT * FROM customer WHERE username='$username' AND password='$password';";
      $query = mysqli_query($con, $sql);
      $rows = mysqli_num_rows($query);
      $user_id = mysqli_fetch_array($query);

      if($rows<1){
        header("Location:login.php");
      }
	    if($rows==1){
		    session_start();
		    $_SESSION['user_id']=$user_id['customer_id'];
		    header("Location:index.php");
	    }
