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

  /*$folder = "uploads/".$filename;*/
  $folder = "uploads";

  $temp = explode(".", $_FILES["bukti"]["name"]);
  $nama_baru = round(microtime(true)) . '.' . end($temp);

  $insertinvoice = "INSERT INTO invoice (invoice_customer, invoice_nama, invoice_hp, invoice_nama_alamat, invoice_alamat, invoice_provinsi, invoice_kabupaten, invoice_kode_pos, invoice_kurir, invoice_berat, invoice_ongkir, invoice_total_bayar, invoice_status, invoice_deskripsi, invoice_resi, invoice_bukti)
                    VALUES ('$user_id', '$namapenerima', '$handphonepenerima', '$labelalamat', '$detailalamat', '$provinsi', '$kabupaten', '$kodepos' ,'$shippingmethod', '1', '$biayapengiriman', '$purchasetotal', '1', '', '', '$nama_baru')";

  $query = mysqli_query($con,$insertinvoice);

  if (move_uploaded_file($tempname, $folder."/" .$nama_baru)){
    $msg = "Image uploaded successfully ";
  }else{
    $msg = "Failed to upload image";
  }
}

$selectlatest = "SELECT invoice_id FROM invoice ORDER BY invoice_id DESC LIMIT 1";
$query = mysqli_query($con,$selectlatest);
while($row=mysqli_fetch_array($query)){
  $insertorderdetail = "INSERT INTO orderdetail (order_id, product_id, merchant_id, productName, productPrice, quantity)
                        SELECT invoice.invoice_id, product_id, merchant_id, productName, productPrice, productQuantity
                        FROM cart
                        JOIN invoice ON cart.customer_id = invoice.invoice_customer
                        WHERE customer_id='$user_id' AND invoice_id=$row[invoice_id]";

  $insertreward = "UPDATE customerReward set rewardPoint = rewardPoint + 5
                   WHERE customer_id='$user_id'";
  $query = mysqli_query($con,$insertreward);

  $deletecart = "DELETE FROM cart WHERE customer_id='$user_id'";

  $query = mysqli_query($con,$insertorderdetail);
  $query = mysqli_query($con,$deletecart);

  header("location:index.php");
}

?>
