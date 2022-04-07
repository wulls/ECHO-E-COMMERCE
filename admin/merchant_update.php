<?php 
include '../database connection.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];



    $sql2 = "UPDATE merchant SET merchantName='$nama' WHERE merchant_id='$id'";
    $query2 = mysqli_query($con, $sql2);
	
	
	if($filename1 != ""){
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../image/logo toko/'.$rand.'_'.$filename1);
		$file_gambar = $rand.'_'.$filename1;

		// hapus foto lama
		$lama = mysqli_query($con, "select * from merchant where merchant_id='$id'");
		$l = mysqli_fetch_assoc($lama);
		$foto = $l['image'];
		unlink("../image/logo toko/$foto");

		mysqli_query($con,"update merchant set image='$file_gambar' where merchant_id='$id'");
	}
}
    header("location:merchant.php");

//mysqli_query($con, "update category set categoryName='$nama' where category_id='$id'");
//header("location:kategori.php");