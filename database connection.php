<?php
$con = mysqli_connect("localhost","root","","trolley");
  if(mysqli_connect_errno()){
	  echo "Database connection failed", mysqli_connect_error();
  }
?>