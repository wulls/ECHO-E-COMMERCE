<?php 
include 'header.php';
include '../database connection.php';
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Admin
      <small>Edit Admin</small>
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
            <h3 class="box-title">Edit Admin</h3>
            <a href="admin.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a> 
          </div>
          <div class="box-body">
            <form action="admin_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($con, "select * from admin where admin_id='$id'");
              while($d = mysqli_fetch_array($data)){
                ?>

                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $d['admin_nama'] ?>" required="required">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $d['admin_id'] ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo $d['admin_username'] ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Kosong Jika tidak ingin di ganti">
                  <small class="text-muted">Kosongkan Jika tidak ingin di ganti</small>
                </div>

				<div class="form-group">
                  <label>Hak Akses</label>
                  <div class="row">
                    <div class="col-lg-4">
                      <select name="hak_akses" class="form-control">
                        <option value="">- Pilih akses -</option>
                        <option <?php if($d['admin_akses'] == "ALL Access"){echo "selected='selected'";} ?> value="ALL Access">ALL Access</option>
                        <option <?php if($d['admin_akses'] == "CRUD data pribadi"){echo "selected='selected'";} ?> value="CRUD data pribadi">CRUD data pribadi</option>
                        <option <?php if($d['admin_akses'] == "Melihat Halaman Admin"){echo "selected='selected'";} ?> value="Melihat Halaman Admin">Melihat Halaman Admin</option>
                      </select>
                    </div>
                  </div>
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