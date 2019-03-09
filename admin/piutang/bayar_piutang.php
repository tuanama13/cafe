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

		$tgl_new = date("Y-m-d");

		// $kode_p = mysqli_real_escape_string($conn,$_POST['kode_piutang']);
		// $kode_t = mysqli_real_escape_string($conn,$_POST['kode_transaksi']);
		$tgl1 = mysqli_real_escape_string($conn,$_POST['tgl_masuk']);
		$tempo = mysqli_real_escape_string($conn,$_POST['tempo']);
		$tgl2 = mysqli_real_escape_string($conn,$_POST['tgl_bayar']);
		$status = mysqli_real_escape_string($conn,$_POST['status']);
		$total_p = str_replace(".", "", mysqli_real_escape_string($conn,$_POST['total_piutang']));

		$total_d = str_replace(".", "", mysqli_real_escape_string($conn,$_POST['total_dibayar']));
		$bayar= str_replace(".", "", mysqli_real_escape_string($conn,$_POST['bayar']));
		$total_d_baru=((int)$total_d+(int)$bayar);
		$sisa_baru=((int)$total_p-(int)$total_d_baru);

		$sisa = str_replace(".", "", mysqli_real_escape_string($conn,$_POST['sisa']));

		if ($sisa_baru == '0') {
			$query = "UPDATE tbl_piutang SET tgl_lunas = '$tgl_new', total_dibayar = '$total_d_baru', sisa_hutang = '$sisa_baru', status = '0' WHERE kode_piutang = '$id'";
		}else {
			$query = "UPDATE tbl_piutang SET tgl_lunas = '$tgl_new', total_dibayar = '$total_d_baru', sisa_hutang = '$sisa_baru' WHERE kode_piutang = '$id'";
		}



	   // $query = "UPDATE tbl_piutang SET tgl_bayar = '$tgl2', total_dibayar = '$total_d_baru', sisa = '$sisa_baru' WHERE kode_piutang = '$id'";


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

	// $sisa = ((int)$rows['total_piutang'] - (int)$rows['total_dibayar']);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian
        <small>Form Pembelian</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Home</a></li>
        <li class="">Pembelian</li>
        <li class="active">Bayar Pembelian</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Bayar Pembelian
	                <small>Data Pembelian</small>
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
	            	<div class="col-md-6">
	            		<form role="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
		      		
				      		<div class="form-group col-md-12">
		                  		<label for="judul">Kode Pembelian</label>
		                  		<input type="text" class="form-control" id="kode_piutang" name="kode_piutang" value="<?php echo $rows['kode_piutang'];?>" required readonly>
		                	</div>

							<div class="form-group col-md-12">
		                  		<label for="satuan">Total Pembelian</label>
		                  		<div class="input-group">
		                  			 <span class="input-group-addon" id="basic-addon1">Rp.</span>
		                  			<input type="text" class="form-control" id="total_piutang" name="total_piutang" aria-describedby="basic-addon1" required readonly>
		                  		</div>
							</div>

							<div class="form-group col-md-12">
		                  		<label for="td">Total Dibayar</label>
		                  		<div class="input-group">
		                  			 <span class="input-group-addon" id="basic-addon2">Rp.</span>
		                  			<input type="text" class="form-control" id="total_dibayar" name="total_dibayar" aria-describedby="basic-addon2" required readonly>
		                  		</div>
		                  		<!-- <input type="text" class="form-control" id="total_dibayar" name="total_dibayar" required readonly> -->
							</div>
							<div class="form-group col-md-12">
		                  		<label for="sisa">Sisa</label>
		                  		<div class="input-group">
		                  			 <span class="input-group-addon" id="basic-addon3">Rp.</span>
		                  			<input type="text" class="form-control" id="sisa" name="sisa" aria-describedby="basic-addon3" required readonly>
		                  		</div>
		                  		<!-- <input type="text" class="form-control" id="sisa" name="sisa" required readonly>              		 -->
							</div>
							<div class="form-group col-md-12">
			             		<label for="bayar">Pembayaran</label>
			             		<div class="input-group">
		                  			 <span class="input-group-addon" id="basic-addon4">Rp.</span>
		                  			<input type="text" class="form-control" id="bayar" name="bayar" aria-describedby="basic-addon4" required autofocus>
		                  		</div>
			               		<!-- <input type="text" class="form-control" id="bayar" name="bayar" required autofocus="autofocus"> -->
			               </div>

		                    <div class="box-footer col-md-12">
		               			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
		              	    </div>
			            </form>
	            	</div>
	            	<div class="col-md-6" style="margin-top: 20px;">
	            		<div class="panel panel-danger">
						  <div class="panel-heading">
						    <h3 class="panel-title">Detail Pembelian</h3>
						  </div>
						  <div class="panel-body">
						  	<p><h4>Nomor Nota : <strong><?php echo $rows['kode_transaksi'];?></strong></h4></p>
						    <p><h4>Tanggal Nota Masuk : <strong><?php echo date_format(date_create($rows['tgl_masuk']),"d-m-Y");?></strong></h4></p>
						    <p><h4>Tanggal Jatuh Tempo : <strong><?php echo date_format(date_create($rows['tgl_jatuh_tempo']),"d-m-Y");?></strong></h4></p>						 
						    <p><h4>Supplier : <strong><?php echo $rows['supplier'];?></strong></h4></p>

						  </div>
						</div>
	            	</div>
	              
	            </div>
	          </div>
	          <!-- /.box -->
	         </div>

	</section>
   </div>
   <script>
	   	$(document).ready(function () {
			var total = document.getElementById("total_piutang");
		    var bayar = document.getElementById("total_dibayar");
		    var sisa = document.getElementById("sisa");
		    var sisa_bayar = document.getElementById("bayar");


		    total.value = formatRupiah("<?php echo $rows['total_piutang']; ?>","");
		    bayar.value = formatRupiah("<?php echo $rows['total_dibayar']; ?>","");
		    sisa.value = formatRupiah("<?php echo $rows['sisa_hutang']; ?>","");

		    sisa_bayar.addEventListener("keyup", function(e) {
			  // tambahkan 'Rp.' pada saat form di ketik
			  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			  sisa_bayar.value = formatRupiah(this.value, "");
			  // z.value = formatRupiah(this.value, "");
			});

 
		 	// x.readOnly = true;
		    // y.readOnly = true;
		});
   </script>
   <?php  
   	include '../footer.php';
   ?>