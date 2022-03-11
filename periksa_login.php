<?php 
// menghubungkan dengan koneksi
include 'database connection.php';

// menangkap data yang dikirim dari form
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

$login = mysqli_query($con, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['admin_id'];
	$_SESSION['nama'] = $data['admin_nama'];
	$_SESSION['username'] = $data['admin_username'];
	$_SESSION['status'] = "login";

	header("location:admin/");
}else{
	header("location:loginadmin.php?alert=gagal");
}
