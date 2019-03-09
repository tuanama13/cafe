<?php
	session_start();  
	//fungsi already header(menangkal warnings)
	ob_start();


	include '../init/db.php';
//	include "../admin_login.php";
	include '../header.php';
  	include '../sidebar.php';
	// $id = isset( $_GET['id']) ?  $_GET['id'] : null;
	if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
  	}else{
    	header('Location: list_piutang.php');
  	}

	if (isset($_POST['submit'])) {


		$kode_p = mysqli_real_escape_string($conn,$_POST['kode_piutang']);
		$kode_t = mysqli_real_escape_string($conn,$_POST['kode_transaksi']);
		$tgl1 = mysqli_real_escape_string($conn,$_POST['tgl_masuk']);
		$tempo = mysqli_real_escape_string($conn,$_POST['tempo']);
		$tgl2 = mysqli_real_escape_string($conn,$_POST['tgl_bayar']);
		$total_p = mysqli_real_escape_string($conn,$_POST['total_piutang']);
		$total_d = mysqli_real_escape_string($conn,$_POST['total_dibayar']);
		$sisa = mysqli_real_escape_string($conn,$_POST['sisa']);
		$status = mysqli_real_escape_string($conn,$_POST['status']);


	   $query = "UPDATE tbl_piutang SET kode_piutang = '$kode_p', kode_transaksi = '$kode_t', tgl_masuk ='$tgl1', tempo = '$tempo',tgl_bayar = '$tgl2', total_piutang = '$total_p', total_dibayar = '$total_d', sisa = '$sisa', status = '$status' WHERE kode_piutang = '$id'";


	   // UPDATE `list_brg` SET `nama_brg` = 'sada' WHERE `list_brg`.`id_brg` = 232640912;

	   if(mysqli_query($conn,$query)){
	   		header('Location: list_piutang.php?status=sukses');
	   }else{
	   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
	   }
	  
	}

	// echo $_GET['id'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_piutang WHERE kode_piutang='$id'");
	$rows = mysqli_fetch_assoc($query);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Piutang
        <small>Form Piutang</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Piutang</li>
        <li class="active">Update Piutang</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Update Piutang
	                <small>Data Piutang Yang Akan Diubah</small>
	              </h3>
	              <!-- tools box -->
	              <!-- <div class="pull-right box-tools">
	                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	                  <i class="fa fa-minus"></i></button>
	                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
	                  <i class="fa fa-times"></i></button>
	              </div> -->
	              <!-- /. tools -->
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	              <form role="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
		      		
		      		<div class="form-group col-md-7">
                  		<label for="judul">Kode Piutang</label>
                  		<input type="text" class="form-control" id="kode_piutang" name="kode_piutang" value="<?php echo $rows['kode_piutang'];?>" required>
                	</div>
		      		<div class="form-group col-md-7">
                  		<label for="judul">Kode Transaksi</label>
                  		<input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" value="<?php echo $rows['kode_transaksi'];?>" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="stok">Tanggal Masuk</label>
                  		<input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $rows['tgl_masuk'];?>" required>
                	</div>
                	<div class="form-group col-md-7" >
                  		<label for="harga-beli">Tempo</label>
                  		<input type="number" class="form-control" id="tempo" name="tempo" value="<?php echo $rows['tempo'];?>" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="harga">Tanggal Bayar</label>
                  		<input type="text" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?php echo $rows['tgl_bayar'];?>" required>
                	</div>

					<div class="form-group col-md-7">
                  		<label for="satuan">Total Piutang</label>
                  		<input type="number" class="form-control" id="total_piutang" name="total_piutang" value="<?php echo $rows['total_piutang'];?>" required>
					</div>

					<div class="form-group col-md-7">
                  		<label for="td">Total Dibayar</label>
                  		<input type="number" class="form-control" id="total_dibayar" name="total_dibayar" value="<?php echo $rows['total_dibayar'];?>" required>
					</div>
					<div class="form-group col-md-7">
                  		<label for="sisa">Sisa</label>
                  		<input type="number" class="form-control" id="sisa" name="sisa" value="<?php echo $rows['sisa'];?>" required >              		

                	</div>
                		<div class="form-group col-md-7">
                  		<label for="stat">Status</label>
                  		<input type="number" class="form-control" id="status" name="status" value="<?php echo $rows['status'];?>" required>
                		
                	</div>

                         <div class="box-footer col-md-7">
               			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
              	    </div>
	              </form>
	            </div>
	          </div>
	          <!-- /.box -->
	         </div>

	</section>
   </div>
   <?php  
   	include '../footer.php';
   ?>