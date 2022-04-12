<?php include "database connection.php";
session_start();

//add items to database
$user_id = $_SESSION['user_id'];
$labelalamat = $_POST['labelalamat'];
$namapenerima = $_POST['namapenerima'];
$handphonepenerima = $_POST['handphonepenerima'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$detailalamat = $_POST['detailalamat'];
$kodepos = $_POST['kodepos'];

$shippingmethod = $_POST['shippingmethod'];
$paymentmethod = $_POST['paymentmethod'];

$grandtotal = $_POST['grandtotal'];
$biayapengiriman = $_POST['biayapengiriman'];
$purchasetotal = $_POST['purchasetotal'];

$msg = "";

if (isset($_POST['submit'])){
  $filename = $_FILES["bukti"]["name"];
  $tempname = $_FILES["bukti"]["tmp_name"];
  $folder = "uploads/".$filename;


$insertinvoice = "INSERT INTO invoice (invoice_customer, invoice_nama, invoice_hp, invoice_nama_alamat, invoice_alamat, invoice_provinsi, invoice_kabupaten, invoice_kurir, invoice_berat, invoice_ongkir, invoice_total_bayar, invoice_status, invoice_resi, invoice_bukti)
                  VALUES ('$user_id', '$namapenerima', '$handphonepenerima', '$labelalamat', '$detailalamat', '$provinsi', '$kabupaten', '$shippingmethod', '1', '$biayapengiriman', '$purchasetotal', '0', '0', '$filename')";

$query = mysqli_query($con,$insertinvoice);

if (move_uploaded_file($tempname, $folder)){
  $msg = "Image uploaded successfully ";
}else{
  $msg = "Failed to upload image";
}

}

echo $labelalamat; echo "<br>";
echo $namapenerima; echo "<br>";
echo $handphonepenerima; echo "<br>";
echo $provinsi; echo "<br>";
echo $kabupaten; echo "<br>";
echo $detailalamat; echo "<br>";
echo $shippingmethod; echo "<br>";
echo $paymentmethod; echo "<br>";
echo $grandtotal; echo "<br>";
echo $biayapengiriman; echo "<br>";
echo $purchasetotal;
?>
