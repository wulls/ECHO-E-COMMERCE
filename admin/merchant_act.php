<?php 
include '../database connection.php';
$nama  = $_POST['nama'];

$sql = "SELECT merchantName FROM merchant WHERE merchantName='$nama'";
$query = mysqli_query($con, $sql);
$rows = mysqli_num_rows($query);

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];
if($filename1 != ""){
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../image/Merchant/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		mysqli_query($con,"update merchant set image='$file_gambar' where merchant_id='$last_id'");
	}
}
if($rows===1){
    header("location:merchant_tambah.php?alert=gagal");
}else if($rows==0){
    $sql2 = "INSERT INTO merchant (merchantName) VALUES ('$nama');";
    $query2 = mysqli_query($con, $sql2);
    header("location:merchant.php");
}


//mysqli_query($con, "INSERT INTO category (name) VALUES ('$nama')");