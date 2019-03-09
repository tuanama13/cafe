<?php 
	include '../init/db.php';
  require '../functions.php';
	$sql=""; 
	$kode = isset( $_GET['kode']) ?  $_GET['kode'] : null;

	if (!empty($kode)) {
    $sql = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi INNER JOIN tbl_brg USING(id_barang) WHERE id_transaksi='$kode'");

    $sql2= mysqli_query($conn,"SELECT * FROM tbl_transaksi WHERE id_transaksi='$kode'");
	}else{
    header("Location: index.php");
  }

  $row2 = mysqli_fetch_assoc($sql2);
  print "
    <div class='row'>
      <div class='col-md-6'>
        <strong>Kode Transaksi</strong><br>
        ".$row2['id_transaksi']."  
        <br> 
        <strong>Waktu</strong> <br>
        ".$row2['tanggal']."
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
      $total_ = (int)$row['jumlah']*(int)$row['harga_jual'];
  print "          
      <tr>
          <td>".$row['nama_barang']."</td>
          <td style='text-align: right'>".rupiah($row['harga_jual'])."</td>
          <td>".$row['jumlah']."</td>
          <td style='text-align: right'>".rupiah($total_)."</td>         
      </tr>";
    
      }            
    print "
        <tr>
            <td colspan='3' style='text-align: right'><strong>Diskon</strong></td>
            <td style='text-align: right'><strong>".rupiah($row2['diskon'])."</strong></td>
        </tr>
        <tr>
            <td colspan='3' style='text-align: right'><strong>Total</strong></td>
            <td style='text-align: right'><strong>".rupiah($row2['grandtotal'])."</strong></td>
        </tr>
      </tbody>
    </table>";
  ?>