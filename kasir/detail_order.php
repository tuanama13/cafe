<?php 
  // include '../init/db.php';
  $path = realpath(__DIR__ . '/..');
  include_once($path . '/init/db.php');
  require 'functions.php';
  
  // $sql=""; 
	$kode = isset( $_GET['kode']) ?  $_GET['kode'] : null;

	if (!empty($kode)) {
    $sql = mysqli_query($conn,"SELECT * FROM tbl_detail_order INNER JOIN tbl_produk USING(id_produk) WHERE id_order='$kode'");

    $sql2= mysqli_query($conn,"SELECT * FROM tbl_orders WHERE id_order='$kode'");
	}else{
    header("Location: index.php");
  }

  $row2 = mysqli_fetch_assoc($sql2);
  print "
    <div class='row'>
      <div class='col-md-6'>
        <strong>Kode Transaksi</strong><br>
        ".$row2['id_order']."  
        <br> 
        <strong>Waktu</strong> <br>
        ".$row2['tgl_order']."
        <br>
        <br>  
      </div>
      <div class='col-md-3'>       
        <strong>Nomor Meja</strong><br>
        <h1 style='margin-top:5px';>".$row2['no_meja']."</h1> 
      </div>
      <div class='col-md-3'>       
        <a href='order/cetak_order_1.php?id_order=".$row2['id_order']."' class='btn btn-success'><i class='fa fa-print'></i> <label>Cetak</label></a>
      </div>
    </div>
  
        
     
  <table id='tbl_detail' class='table table-striped table-bordered dt-responsive'>	
    <thead>
       <tr>
         <th style='text-align: center'>No</th>
         <th>Nama Barang</th>
         <th style='text-align: right'>Harga Barang</th>
         <th style='text-align: center'>Qty</th>
         <th style='text-align: right'>Subtotal</th>                   
         </tr>
    </thead>
    <tbody>";                            
   
    $no = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
                      // $id=$row['id_supplier'];
      $total_ = (int)$row['jumlah_order']*(int)$row['harga_produk'];
  print "          
      <tr>
          <td style='text-align: center'>$no</td>
          <td>".$row['nama_produk']."</td>
          <td style='text-align: right'>".rupiah($row['harga_produk'])."</td>
          <td style='text-align: center'>".$row['jumlah_order']."</td>
          <td style='text-align: right'>".rupiah($total_)."</td>         
      </tr>";
        $no++;
      }

    print "
        <tr>
            <td colspan='4' style='text-align: right'><h4><strong>Total</strong></h4></td>
            <td style='text-align: right'><h4><strong>".rupiah($row2['grandtotal'])."</strong></h4></td>
        </tr>
      </tbody>
    </table>";
  ?>