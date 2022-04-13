<!DOCTYPE html>
<html>
<head>
	<title>INVOICE TRANSACTION</title>
</head>
<body>

	<?php 
	session_start();
	include '../database connection.php';
	?>

	<style>
		body{
			font-family: sans-serif;
		}

		.table{
			border-collapse: collapse;
		}
		.table th,
		.table td{
			padding: 5px 10px;
			border: 1px solid black;
		}
		h3 {
			text-align: right;
		}
		p {
			text-align: right;
		}
	</style>

	<div>

		<?php 
		$id_invoice = $_GET['id'];
		$invoice = mysqli_query($con,"select * from invoice where invoice_id='$id_invoice' order by invoice_id desc");
		while($i = mysqli_fetch_array($invoice)){
			?>


			<div>
			<img src="../image/Trolley1.png" height="100">
				<h3>INV/TRE/<?php echo date('ymd', strtotime($i['invoice_tanggal'])); ?>/000<?php echo $i['invoice_id'] ?></h3>

			<b>Diterbitkan Oleh</b></br>
				<a>TROLLEY MARKETPLACE</a>		
			
			<p>
				Nama 		: <?php echo $i['invoice_nama']; ?><br/>
				Alamat 		: <?php echo $i['invoice_alamat']; ?><br/>
				Provinsi	: <?php echo $i['invoice_provinsi']; ?><br/>
				<?php echo $i['invoice_kabupaten']; ?><br/>
				Hp			: <?php echo $i['invoice_hp']; ?><br/>
				<br/>
				</p>
				
				<table class="table">
					<thead>
						<tr>
							<th class="text-center" width="1%">NO</th>
							<th colspan="2">Produk</th>
							<th class="text-center">Harga</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Total Harga</th>
						</tr>
					</thead>
					<tbody>
						 <?php 
                    $no = 1;
                    $total = 0;
                    $transaksi = mysqli_query($con,"SELECT OD.order_id, OD.orderDetail_id, OD.merchant_id, ME.merchantName, OD.productName, OD.productPrice, OD.quantity, PR.productImage, ROUND (OD.productPrice * OD.quantity, 0) AS totalPrice
                                                    FROM orderdetail OD 
                                                    LEFT JOIN invoice INV ON INV.invoice_id=OD.order_id
                                                    JOIN merchant ME ON OD.merchant_id=ME.merchant_id
                                                    JOIN product PR ON OD.product_id=PR.product_id
                                                    WHERE OD.order_id='$i[invoice_id]'");
                    while($d=mysqli_fetch_array($transaksi)){
                      $total += $d['totalPrice'];
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td>
                          <center>
                            <?php if($d['productImage'] == ""){ ?>
                              <img src="../gambar/sistem/produk.png" style="width: 50px;height: auto">
                            <?php }else{ ?>
                              <img src="../image/Merchant/<?php echo $d['productImage'] ?>" style="width: 50px;height: auto">
                            <?php } ?>
                          </center>
                        </td>
                        <td><?php echo $d['productName']; ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($d['productPrice']); ?></td>
                        <td class="text-center"><?php echo number_format($d['quantity']); ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($d['productPrice'] * $d['quantity']); ?></td>
                      </tr>
                      <?php 
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Berat</th>
                      <td class="text-center"><?php echo number_format($i['invoice_berat']); ?> Kg</td>
                    </tr>
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Total Belanja</th>
                      <td class="text-center"><?php echo "Rp. ".number_format($total); ?></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Ongkir (<?php echo $i['invoice_kurir'] ?>)</th>
                      <td class="text-center"><?php echo "Rp. ".number_format($i['invoice_ongkir']); ?></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Total Bayar</th>
                      <td class="text-center"><?php echo "Rp. ".number_format ($total + $i['invoice_ongkir']); ?></td>
                    </tr>
                  </tfoot>
                </table>


				<h5>STATUS :</h5> 
				<?php 
				if($i['invoice_status'] == 0){
					echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
				}elseif($i['invoice_status'] == 1){
					echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
				}elseif($i['invoice_status'] == 2){
					echo "<span class='label label-danger'>Ditolak</span>";
				}elseif($i['invoice_status'] == 3){
					echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
				}elseif($i['invoice_status'] == 4){
					echo "<span class='label label-warning'>Dikirim</span>";
				}elseif($i['invoice_status'] == 5){
					echo "<span class='label label-success'>Selesai</span>";
				}
				?>

			</div>	


			<?php 
		}
		?>
	</div>


	<script>
		window.print();
	</script>
</body>
</html>