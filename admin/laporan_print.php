<!DOCTYPE html>
<html>
<head>
  <p align="right">TROLLEY </p>
 </head>
<body>

  <style type="text/css">
    body{
      font-family: sans-serif;
    }

    .table{
      width: 100%;
    }

    th,td{
    }
    .table,
    .table th,
    .table td {
      padding: 5px;
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>

    
  <center>
    <h2>Laporan Penjualan TROLLEY SUPERMARKET E-COMMERCE</h2>
	<h3>PT. ECHO TECHNOLOGY - TROLLEY</h3>
	<td>Jl. M.H. Thamrin Boulevard</td>
	<td>Tangerang, Banten 15810</td>

  </center>
<br>

  <?php 
  include '../database connection.php';
  if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    ?>
    <br/>

    <table class="">
      <tr>
        <td width="20%">DARI TANGGAL</td>
        <td width="1%">:</td>
        <td><?php echo $tgl_dari; ?></td>
      </tr>
      <tr>
        <td>SAMPAI TANGGAL</td>
        <td>:</td>
        <td><?php echo $tgl_sampai; ?></td>
      </tr>
    </table>

    <br/>

    <table class="table table-bordered table-striped" id="table-datatable">
      <thead>
        <tr>
          <th width="1%">NO</th>
          <th>INVOICE</th>
          <th>TANGGAL MASUK</th>
          <th>NAMA CUSTOMER</th>
          <th>JUMLAH</th>
          <th>STATUS</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no=1;
        $data = mysqli_query($con,"SELECT * FROM invoice,customer WHERE invoice_customer=customer_id and date(invoice_tanggal) >= '$tgl_dari' AND date(invoice_tanggal) <= '$tgl_sampai'");
        while($i = mysqli_fetch_array($data)){
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td>INV/TRE/<?php echo date('ymd', strtotime($i['invoice_tanggal'])); ?>/000<?php echo $i['invoice_id'] ?></td>
            <td><?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])); ?></td>
            <td><?php echo $i['username'] ?></td>
            <td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." " ?></td>
            <td>
              <?php 
              if($i['invoice_status'] == 0){
                echo "Menunggu Pembayaran";
              }elseif($i['invoice_status'] == 1){
                echo "Menunggu Konfirmasi";
              }elseif($i['invoice_status'] == 2){
                echo "Ditolak";
              }elseif($i['invoice_status'] == 3){
                echo "Dikonfirmasi & Sedang Diproses";
              }elseif($i['invoice_status'] == 4){
                echo "Dikirim";
              }elseif($i['invoice_status'] == 5){
                echo "Selesai";
              }
              ?>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>

    <?php 
  }else{
    ?>

    <div class="alert alert-info text-center">
      Silahkan Filter Laporan Terlebih Dulu.
    </div>

    <?php
  }
  ?>
</body>

<script>
  window.print();
</script>
</html>