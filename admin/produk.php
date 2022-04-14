<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Produk
      <small>Data Produk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Produk</h3>
            <a href="produk_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Produk Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
					<th>Store</th>
                    <th>NAMA PRODUK</th>
                    <th>KATEGORI</th>
                    <th>HARGA</th>
					<th>SATUAN</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../database connection.php';
                  $no=1;
                  $result = mysqli_query(
                                        $con, "SELECT merchant.merchantName, product.productName, product.product_id, category.categoryName, product.productPrice, product.productUnit_id, product.productImage, productunit.productUnit
                                        FROM product
                                        JOIN merchant ON
                                        product.merchant_id=merchant.merchant_id
                                        JOIN category ON
                                        product.category_ID=category.category_id
										JOIN productunit ON
                                        product.productUnit_id=productunit.productUnit_id"
                                        );
                  while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
					  <td><?php echo $row['merchantName']; ?></td>
                      <td><?php echo $row['productName']; ?></td>
                      <td><?php echo $row['categoryName']; ?></td>
                      <td><?php echo "Rp. ".number_format($row['productPrice']).""; ?></td>
					  <td><?php echo $row['productUnit']; ?></td>
                      <td>
                        <center>
                          <?php if($row['productImage'] == ""){ ?>
                            <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../<?php echo $row['productImage'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="produk_edit.php?id=<?php echo $row['product_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="produk_hapus_konfir.php?id=<?php echo $row['product_id'] ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>