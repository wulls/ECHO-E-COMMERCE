<?php 
include '../database connection.php';
$nama  = $_POST['productName'];
$merchant  = $_POST['merchant_id'];
$kategori = $_POST['category_id'];
$harga = $_POST['productPrice'];
$keterangan = $_POST['productDescription'];
$berat = $_POST['unit'];
$jumlah = $_POST['quantity'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];

mysqli_query($con, "INSERT INTO product values (NULL,'$nama','$merchant','$kategori','$harga','$keterangan','$berat','$jumlah','')");


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