<?php 
include '../database connection.php';
$nama  = $_POST['productName'];
$merchant  = $_POST['merchant_id'];
$kategori = $_POST['category_id'];
$harga = $_POST['productPrice'];
$keterangan = $_POST['keterangan'];
$unit = $_POST['unit'];
$jumlah = $_POST['quantity'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];

$selectProduct = "SELECT productName FROM product WHERE productName='$nama' AND merchant_id='$merchant'";
$resultProduct = mysqli_query($con, $selectProduct);
$countProduct = mysqli_num_rows($resultProduct);

if($countProduct==1){
	header("location:produk_tambah.php?alert=gagal");
}else if($countProduct==0){
	mysqli_query($con, "INSERT INTO product values (NULL,'$merchant','$nama','$kategori','1','$jumlah','$unit','$harga','$keterangan','')");

	$last_id = mysqli_insert_id($con);

	if($filename1 != ""){
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../image/Merchant/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		mysqli_query($con,"update product set image='$file_gambar' where product_id='$last_id'");
	}
}
header("location:produk.php");
}