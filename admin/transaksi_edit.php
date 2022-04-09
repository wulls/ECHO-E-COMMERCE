<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi
      <small>Edit Deskripsi </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Edit Deskripsi</h3>
            <a href="transaksi.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="transaksi_update.php" method="post">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($con, "select * from invoice where invoice_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>
               <div class="form-group">
                  <label>Deskripsi</label>
                  <input type="hidden" name="id" value="<?php echo $d['invoice_id'] ?>">
                  <input type="text" class="form-control" name="nama" placeholder="Jelaskan Deskripsi Status" value="<?php echo $d['invoice_deskripsi'] ?>">
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>
                <?php 
              }
              ?>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>