<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Produk
      <small>Edit Produk</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Produk</h3>
            <a href="produk.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert'] == "gagal"){
              echo "<div class='alert alert-danger'>Produk sudah ada!</div>";
            }
          }
          ?>

            <?php 
            $id = $_GET['id'];
            $data = mysqli_query($con,"SELECT * from product where product_id='$id'");
            while($d = mysqli_fetch_array($data)){
              ?>

              <form action="produk_update.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="hidden" name="id" value="<?php echo $d['product_id']; ?>">
                  <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama .." value="<?php echo $d['productName']; ?>">
                </div>

                <div class="form-group">
                  <label>Kategori Produk</label>
                  <div class="row">
                    <div class="col-lg-4">
                      <select name="kategori" required="required" class="form-control">
                        <option value="">- Pilih Kategori Produk -</option>
                        <?php 
                        include '../database connection.php';
                        $kategori = mysqli_query($con,"SELECT * FROM category");
                        while($k = mysqli_fetch_array($kategori)){
                          ?>
                          <option <?php if($k['category_id'] == $d['category_ID']){echo "selected='selected'";} ?> value="<?php echo $k['category_id']; ?>"><?php echo $k['categoryName']; ?></option>
                          <?php 
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Harga</label>
                  <div class="row">
                    <div class="col-lg-4">
                      <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga .." value="<?php echo $d['productPrice']; ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Katerangan</label>
                  <textarea name="keterangan" class="form-control textarea" style="resize: none" rows="10"><?php echo $d['productDescription']; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Satuan</label>
                  <div class="row">
                    <div class="col-lg-4">
                      <select name="unit" class="form-control">
                        <option value="">- Pilih Satuan -</option>
				<option <?php if($d['productUnit_id'] == "0"){echo "selected='selected'";} ?> value="0">Tidak Berkategori</option>
                        <option <?php if($d['productUnit_id'] == "1"){echo "selected='selected'";} ?> value="1">pcs</option>
                        <option <?php if($d['productUnit_id'] == "2"){echo "selected='selected'";} ?> value="2">paket</option>
                        <option <?php if($d['productUnit_id'] == "3"){echo "selected='selected'";} ?> value="3">g</option>
                        <option <?php if($d['productUnit_id'] == "4"){echo "selected='selected'";} ?> value="4">Kg</option>
                        <option <?php if($d['productUnit_id'] == "5"){echo "selected='selected'";} ?> value="5">ml</option>
                        <option <?php if($d['productUnit_id'] == "6"){echo "selected='selected'";} ?> value="6">L</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Foto 1 (Foto Utama)</label>
                  <input type="file" name="foto1">

                  <?php if($d['productImage'] == ""){ ?>
                    <img src="../image/produk.png" style="width: 120px;height: auto">
                  <?php }else{ ?>
                    <img src="<?php echo $d['productImage'] ?>" style="width: 120px;height: auto">
                  <?php } ?>

                  <br/>
                  <small class="text-muted">Kosongkan Jika Tidak Ingin Mengubah Foto</small>

                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>

              </form>

              <?php 
            }
            ?>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>