<?php 
include '../database connection.php';
$nama  = $_POST['nama'];
$username = $_POST['username'];
$hakakses = $_POST ['hak_akses'];
$password = $_POST['password'];


$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($con, "insert into admin values (NULL,'$nama','$username','$hakakses','$password','')");
	header("location:admin.php");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		header("location:admin.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../admin'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($con, "insert into admin values (NULL,'$nama','$username','$hakakses','$password','$file_gambar')");
		header("location:admin.php");
	}
}

