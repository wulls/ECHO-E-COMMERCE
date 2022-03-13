<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="frontend/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="frontend/css/slick-theme.css" />

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="frontend/css/nouislider.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="frontend/css/style.css" />
</head>

<body>
	<?php
	include 'database connection.php';

	session_start();

	if($file == "checkout.php"){


		if(!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0){

			header("location:Cart2.php?alert=keranjang_kosong");

		}
	}
	?>
	<!-- HEADER -->
	<header>

		<!-- header -->
		<div id="header">

				<div class="pull-right">
					<ul class="header-btns">

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">

							<?php
							if(isset($_SESSION['keranjang'])){
								$jumlah_isi_keranjang = count($_SESSION['keranjang']);
							}else{
								$jumlah_isi_keranjang = 0;
							}
							?>

							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php echo $jumlah_isi_keranjang; ?></span>
								</div>
								<strong class="text-uppercase">Keranjang Belanja :</strong>
								<br>
								<?php
								$total = 0;
								if(isset($_SESSION['keranjang'])){
									$jumlah_isi_keranjang = count($_SESSION['keranjang']);
									for($a = 0; $a < $jumlah_isi_keranjang; $a++){
										$id_produk = $_SESSION['keranjang'][$a]['produk'];
										$isi = mysqli_query($koneksi,"select * from produk where produk_id='$id_produk'");
										$i = mysqli_fetch_assoc($isi);
										$total += $i['produk_harga'];
									}
								}
								?>
								<span><?php echo "Rp. ".number_format($total)." ,-"; ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										<?php
										$total_berat = 0;
										if(isset($_SESSION['keranjang'])){

											$jumlah_isi_keranjang = count($_SESSION['keranjang']);

											if($jumlah_isi_keranjang != 0){
												// cek apakah produk sudah ada dalam keranjang
												for($a = 0; $a < $jumlah_isi_keranjang; $a++){
													$id_produk = $_SESSION['keranjang'][$a]['produk'];
													$isi = mysqli_query($koneksi,"select * from produk where produk_id='$id_produk'");
													$i = mysqli_fetch_assoc($isi);

													$total_berat += $i['produk_berat'];
													?>

													<div class="product product-widget">
														<div class="product-thumb">
															<?php if($i['produk_foto1'] == ""){ ?>
																<img src="gambar/sistem/produk.png">
															<?php }else{ ?>
																<img src="gambar/produk/<?php echo $i['produk_foto1'] ?>">
															<?php } ?>
														</div>
														<div class="product-body">
															<h3 class="product-price"><?php echo "Rp. ".number_format($i['produk_harga']) . " ,-"; ?></h3>
															<h2 class="product-name"><a href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['produk_nama'] ?></a></h2>
														</div>
														<a class="cancel-btn" href="Cart_Remove.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i class="fa fa-trash"></i></a>
													</div>

													<?php

												}
											}else{
												echo "<center>Keranjang Masih Kosong.</center>";
											}


										}else{
											echo "<center>Keranjang Masih Kosong.</center>";
										}
										?>

									</div>
									<div class="shopping-cart-btns">
										<a class="main-btn" href="Cart.php">Keranjang</a>
										<a class="primary-btn" href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->
