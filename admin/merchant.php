<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Merchant
      <small>Data Merchant</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-8">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Merchant</h3>
            <div class="btn-group pull-right">
              <a href="merchant_tambah.php" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah Merchant</a>              
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
					<th>MERCHANT ID</th>
                    <th>NAMA</th>
                    <th width="15%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../database connection.php';
                  $no=1;
                  $data = mysqli_query($con,"SELECT * FROM merchant");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
					  <td><?php echo $d['merchant_id']; ?></td>
                      <td><?php echo $d['merchantName']; ?></td>
                      <td>
                          <a class="btn btn-warning btn-sm" href="merchant_edit.php?id=<?php echo $d['merchant_id'] ?>"><i class="fa fa-cog"></i></a>
                          <a class="btn btn-danger btn-sm" href="merchant_hapus_konfir.php?id=<?php echo $d['merchant_id'] ?>"><i class="fa fa-trash"></i></a>
                        
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