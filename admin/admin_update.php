<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$username = $_POST['username'];
$hakakses = $_POST ['hak_akses'];
$pwd = $_POST['password'];
$password = $_POST['password'];

// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($pwd=="" && $filename==""){
	mysqli_query($con, "update admin set admin_nama='$nama', admin_username='$username', admin_akses='$hakakses' where admin_id='$id'");
	header("location:admin.php");
}elseif($pwd==""){
	if(!in_array($ext,$allowed) ) {
		header("location:admin.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../image/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($con, "update admin set admin_nama='$nama', admin_username='$username', admin_akses='$hakakses', admin_foto='$x' where admin_id='$id'");		
		header("location:admin.php?alert=berhasil");
	}
}elseif($filename==""){
	mysqli_query($con, "update admin set admin_nama='$nama', admin_username='$username', admin_akses='$hakakses', admin_password='$password' where admin_id='$id'");
	header("location:admin.php");
}

