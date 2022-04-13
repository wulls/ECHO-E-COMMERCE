<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$unit = $_POST['unit'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];

$selectProduct = "SELECT productName FROM product WHERE productName='$nama' AND merchant_id='$merchant'";
$resultProduct = mysqli_query($con, $selectProduct);
$countProduct = mysqli_num_rows($resultProduct);

if($countProduct==1){
	header("location:produk_edit.php?alert=gagal");
}else if($countProduct==0){
	mysqli_query($con, "UPDATE product SET productName='$nama', category_id='$kategori', productPrice='$harga', productDescription='$keterangan', productUnit_id='$unit',WHERE product_id='$id'");

	if($filename1 != ""){
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../image/Merchant/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		// hapus foto lama
		$lama = mysqli_query($con, "select * from product where product_id='$id'");
		$l = mysqli_fetch_assoc($lama);
		$foto = $l['image'];
		unlink("../image/Merchant/$foto");

		mysqli_query($con,"update product set image='$file_gambar' where product_id='$id'");
	}
}

header("location:produk.php");
}