<?php
$con = mysqli_connect("localhost","root","root","Trolley");
  if(mysqli_connect_errno()){
	  echo "Database connection failed", mysqli_connect_error();
  }
?>

<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "root";
$db_name = "Trolley";

try {
  $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
  $e->getMessage();
}

?>
