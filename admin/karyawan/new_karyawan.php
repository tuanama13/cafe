<?php
	//fungsi already header(menangkal warnings)
	session_start();
	// include '../tes.php';
	
	ob_start();

	// DB Connection 
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');
	// include '../init/db.php';
	
	// Sidebar
  	$page_header = "karyawan";
   	$page_li = "tambah_karyawan";
	
	include '../header.php';
	include '../sidebar.php';


	if (isset($_POST['submit'])) {
		// fungsi untuk menghasilkan id autonumber
		// $sql = "SELECT max(id_pegawai) as maxid FROM tbl_pegawai WHERE id_pegawai LIKE 'KRY%'";
		// $row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
		// $idmax=$row['maxid'];
		// $row = mysqli_num_rows(mysqli_query($conn,$sql));
		// if ($row<=0) {
			// $id_karyawan="KRY0000001";
		// }else{
			// $nourut = (int) substr($idmax, 3,7);
			// $nourut++;
			// $id_karyawan = "KRY".sprintf("%07s", $nourut);
		// }
		// tutup fungsi autonumber
		// $id=rand();
		
			$nama = mysqli_real_escape_string($conn,$_POST['nm_karyawan']);
			$tgl = mysqli_real_escape_string($conn,$_POST['tgl_lahir']);
			$alamat = mysqli_real_escape_string($conn,$_POST['alamat']);
			$no_telepon = mysqli_real_escape_string($conn,$_POST['no_telepon']);
			$jabatan = mysqli_real_escape_string($conn,$_POST['jabatan']);
			// $tgl_masuk=date("Y-m-d");
			$logs = 1;
			$insert = "INSERT INTO tbl_pegawai(nama_pegawai,alamat_pegawai,kontak_pegawai,posisi_pegawai,logs) VALUES ('$nama','$alamat','$no_telepon','$jabatan','$logs')";
			if (mysqli_query($conn,$insert)) {
					header('Location: list_karyawan.php');
				}else{
					echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
				}
		
		
	}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Karyawan
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
						<h3 class="box-title">Tambah Karyawan
						<small></small>
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
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control" id="nm_karyawan" name="nm_karyawan" placeholder="Masukan Nama Karyawan" required>
							</div>
							<div class="form-group col-md-7">
								<label for="alamat">Alamat</label>
								<!-- <input type="" class="form-control" id="tipe_barang" name="tipe_barang" placeholder="Masukan Tipe Barang" required> -->
								<textarea class="form-control" rows="5" name="alamat" id="alamat" placeholder="Alamat Karyawan"></textarea>
							</div>
							<!-- <div class="form-group col-md-7">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
							</div> -->
							<div class="form-group col-md-7">
								<label for="no_telepon">Nomor Telepon</label>
								<input type="number" class="form-control" id="no_telepon" name="no_telepon" placeholder="08xxxxxxxxxx" required>
							</div>
							<div class="form-group col-md-7">
								<label for="jabatan">Jabatan</label>
								<select class="form-control" name="jabatan" required>
									<option value="">- Pilih Jabatan -</option>
									<option value="Admin">Administrator</option>
									<option value="Kasir">Kasir</option>
									<option value="Pimpinan">Pimpinan</option>
									
								</select>
								<!-- <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Karyawan" required> -->
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