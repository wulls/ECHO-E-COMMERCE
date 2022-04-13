<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Produk
      <small>Tambah Produk Baru</small>
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
            <h3 class="box-title">Tambah Produk</h3>
            <a href="produk.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          
          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert'] == "gagal"){
              echo "<div class='alert alert-danger'>Produk sudah ada!</div>";
            }
          }
          ?>

          <div class="box-body">

            <form action="produk_act.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="productName" required="required" placeholder="Masukkan Nama ..">
              </div>

              <div class="form-group">
                <label>Kategori Produk</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select name="category_id" required="required" class="form-control">
                      <option value="">- Pilih Kategori Produk -</option>
                      <?php 
                      include '../database connection.php';
                      $data = mysqli_query($con,"SELECT * FROM category");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <option value="<?php echo $d['category_id']; ?>"><?php echo $d['categoryName']; ?></option>
                        <?php 
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
				
				<div class="form-group">
                <label>Merchant</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select name="merchant_id" required="required" class="form-control">
                      <option value="">- Pilih Merchant -</option>
                      <?php 
                      include '../database connection.php';
                      $data = mysqli_query($con,"SELECT * FROM merchant");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <option value="<?php echo $d['merchant_id']; ?>"><?php echo $d['merchantName']; ?></option>
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
                    <input type="number" class="form-control" name="productPrice" required="required" placeholder="Masukkan Harga ..">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Katerangan</label>
                <textarea name="keterangan" class="form-control textarea" style="resize: none" rows="10"></textarea>
              </div>

              <div class="form-group">
                <label>Satuan</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select name="unit" required="required" class="form-control">
                      <option value="">- Pilih Satuan -</option>
                      <option value="pcs">pcs</option>
                      <option value="paket">paket</option>
                      <option value="g">g</option>
                      <option value="kg">Kg</option>
                      <option value="ml">ml</option>
                      <option value="L">L</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Foto 1 (Foto Utama)</label>
                <input type="file" name="foto1">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>

            </form>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>