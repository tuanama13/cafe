<?php
	session_start();
	//fungsi already header(menangkal warnings)
	ob_start();
	// include (basename(dirname(__FILE__)).'/init/db.php');
	//echo dirname( __DIR__ ) . '/init/db.php' ;
	include '../init/db.php';
	//include "../admin_login.php";
	include '../header.php';
	include '../sidebar.php';

	if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
  	}else{
    	header('Location: list_pengeluaran.php');
  	}

	if (isset($_POST['submit'])) {

		$ket_ = mysqli_real_escape_string($conn,$_POST['ket_pengeluaran']);
		$jumlah_ = mysqli_real_escape_string($conn,$_POST['jumlah_pengeluaran']);			
			
		$insert = "UPDATE tbl_pengeluaran SET ket_pengeluaran = '$ket', jumlah_pengeluaran ='$jumlah' WHERE id_pengeluaran = '$id'";
		if (mysqli_query($conn,$insert)) {
			header('Location: list_pengeluaran.php');
		}else{
	   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
	   }
	}

	$query = mysqli_query($conn,"SELECT * FROM tbl_pengeluaran WHERE id_pengeluaran ='$id'");
	$rows = mysqli_fetch_assoc($query);

?>
	<script type="text/javascript">
	<?php $pw="hello"; ?>
	function kode(){
	document.getElementById("id_barang").value="<?php echo $pw; ?>";
	}
	</script>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Pengeluaran
		<small>Form Pengeluaran</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="">Pengeluaran</li>
			<li class="active">Tambah pengeluaran</li>
		</ol>
	</section>
	<section class="content">
		<!-- Main content -->
		<div class="row">
			<div class="col-md-8">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Tambah Pengeluaran
						<!-- <small>Form Untuk Penambahan Barang Baru</small> -->
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
						<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							
							<div class="form-group col-md-7">
								<label for="tanggal" id="lb_tanggal">Tanggal Pengeluaran</label>
								<input type="text" class="form-control" id="tgl_pengeluaran" name="tgl_pengeluaran" value="<?php echo $rows['tgl_pengeluaran']  ?>" readonly>
							</div>
							<div class="form-group col-md-7">
								<label for="keterangan">Keterangan Pengeluaran</label>
								<textarea rows="7" class="form-control" id="ket_pengeluaran" name="ket_pengeluaran" required><?php echo $rows['ket_pengeluaran']  ?></textarea>
							</div>
							<div class="form-group col-md-7">
								<label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
								<!-- <small>Uang yang Dikeluarkan</small> -->
								<input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" value="<?php echo $rows['jumlah_pengeluaran']  ?>" required>
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