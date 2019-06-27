<?php
	session_start();	// include '../tes.php';
	
	ob_start();

	// DB Connection 
  	$path = realpath(__DIR__ . '/../..');
  	include_once($path . '/init/db.php');

	// include '../init/db.php';

	// Sidebar
	$page_header = "karyawan";
	  
	include '../header.php';
	include '../sidebar.php';
	$id = $_GET['id'];
	if (isset($_POST['submit'])) {
	
		$nama = mysqli_real_escape_string($conn,$_POST['nm_karyawan']);
		$tgl = mysqli_real_escape_string($conn,$_POST['tgl_lahir']);
		$alamat = mysqli_real_escape_string($conn,$_POST['alamat']);
		$no_telepon = mysqli_real_escape_string($conn,$_POST['no_telepon']);
		$jabatan = mysqli_real_escape_string($conn,$_POST['jabatan']);
	
	$query = "UPDATE tbl_pegawai SET nama_pegawai = '$nama',alamat_pegawai = '$alamat',kontak_pegawai ='$no_telepon',posisi_pegawai = '$jabatan' WHERE id_pegawai = '$id'";
	if(mysqli_query($conn,$query)){
			header('Location: list_karyawan.php?status=sukses');
	}else{
			echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
	}
	
	}
	// echo $_GET['id'];
	$query = mysqli_query($conn,"SELECT * from tbl_pegawai where id_pegawai='$id'");
	$rows = mysqli_fetch_assoc($query);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Ubah data Karyawan
		<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<!-- <li class="">Post</li> -->
			<li class="active">Karyawan</li>
		</ol>
	</section>
	<section class="content">
		<!-- Main content -->
		<div class="row">
			<div class="col-md-8">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Ubah Data Karyawan
						<small>Untuk Merubah Data Karyawan</small>
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
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control" id="nm_karyawan" name="nm_karyawan" value="<?php echo $rows['nama_pegawai']?>" required>
							</div>
							<div class="form-group col-md-7">
								<label for="alamat">Alamat</label>
								<!-- <input type="" class="form-control" id="tipe_barang" name="tipe_barang" placeholder="Masukan Tipe Barang" required> -->
								<textarea class="form-control" rows="5" name="alamat" id="alamat"><?php echo $rows['alamat_pegawai']?></textarea>
							</div>
							<!-- <div class="form-group col-md-7">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php //echo $rows['tgl_lahir']?>" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
							</div> -->
							<div class="form-group col-md-7">
								<label for="no_telepon">Nomor Telepon</label>
								<input type="number" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $rows['kontak_pegawai']?>" required>
							</div>
							<div class="form-group col-md-7">
								<label for="jabatan">Jabatan</label>
								<select class="form-control" name="jabatan" required>
									<?php 
										$s="selected";
									?>
									<option value="Admin" <?php if($rows['posisi_pegawai']=='Admin') { echo "selected";}?> >Administrator</option>
									<option value="Kasir" <?php if($rows['posisi_pegawai']=='Kasir') { echo "selected";}?> >Kasir</option>
									<option value="Pimpinan" <?php if($rows['posisi_pegawai']=='Pimpinan') { echo "selected";} ?> >Pimpinan</option>
									
								</select>
								<!--  -->
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