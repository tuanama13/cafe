<?php 
  // include '../init/db.php';
  $path = realpath(__DIR__ . '/../..');
  include_once($path . '/init/db.php');
  require '../functions.php';
  
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
      <div class='col-md-6'>       
             
      </div>
    </div>
  
        
     
  <table id='tbl_detail' class='table table-striped table-bordered dt-responsive'>	
    <thead>
       <tr>
         <th>Nama Barang</th>
         <th style='text-align: right'>Harga Barang</th>
         <th>Jumlah Barang</th>
         <th style='text-align: right'>Subtotal</th>                   
         </tr>
    </thead>
    <tbody>";                            
   
    while ($row = mysqli_fetch_assoc($sql)) {
                      // $id=$row['id_supplier'];
      $total_ = (int)$row['jumlah_order']*(int)$row['harga_produk'];
  print "          
      <tr>
          <td>".$row['nama_produk']."</td>
          <td style='text-align: right'>".rupiah($row['harga_produk'])."</td>
          <td>".$row['jumlah_order']."</td>
          <td style='text-align: right'>".rupiah($total_)."</td>         
      </tr>";
    
      }            
    print "
        <tr>
            <td colspan='3' style='text-align: right'><h4><strong>Total</strong></h4></td>
            <td style='text-align: right'><h4><strong>".rupiah($row2['grandtotal'])."</strong></h4></td>
        </tr>
      </tbody>
    </table>";
  ?>