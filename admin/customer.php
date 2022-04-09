<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Customer
      <small>Data Customer</small>
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
            <h3 class="box-title">Customer</h3>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
					<th>CUST ID</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>HP</th>
                    <!-- <th>ALAMAT</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../database connection.php';
                  $no=1;
                  $data = mysqli_query($con,"SELECT * FROM customer");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
					  <td><?php echo $d['customer_id']; ?></td>
                      <td><?php echo $d['username']; ?></td>
                      <td><?php echo $d['email']; ?></td>
                      <td><?php echo $d['phone']; ?></td>
                      
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