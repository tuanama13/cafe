<?php
	session_start();
	//fungsi already header(menangkal warnings)
	ob_start();
	$path = realpath(__DIR__ . '/../..');
    include_once($path . '/init/db.php');
	// include (basename(dirname(__FILE__)).'/init/db.php');
	//echo dirname( __DIR__ ) . '/init/db.php' ;
	// include '../init/db.php';
	//include "../admin_login.php";
	// Sidebar
    $page_header = "pengeluaran";
	$page_li = "tambah_penge";
	
	include '../header.php';
	include '../sidebar.php';
	$date = date("Y-m-d");
	if (isset($_POST['submit'])) {
		$tgl_pengeluaran = mysqli_real_escape_string($conn,$_POST['tgl_pengeluaran']);
		$id_user = 1;
		$logs = 1;
		$ket_ = mysqli_real_escape_string($conn,$_POST['ket_pengeluaran']);
		$jumlah_ = str_replace(".", "",mysqli_real_escape_string($conn,$_POST['jumlah_pengeluaran']));			
			
		// $insert = "INSERT INTO tbl_pengeluaran(ket_pengeluaran, jumlah_pengeluaran) VALUES ('$ket_','$jumlah_')";
		$insert = "INSERT INTO tbl_pengeluaran(id_user, tgl_pengeluaran,ket_pengeluaran, jumlah_pengeluaran, logs) VALUES ('$id_user','$tgl_pengeluaran','$ket_','$jumlah_',$logs)";
		if (mysqli_query($conn,$insert)) {
			header('Location: list_pengeluaran.php');
		}
	}

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
			<li><i class="fa fa-home"></i> Home</a></li>
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
					</div>
					<!-- /.box-header -->
					<div class="box-body pad">
						<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							
							<div class="form-group col-md-7">
								<label for="tanggal" id="lb_tanggal">Tanggal Pengeluaran</label>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
									<input type="text" class="form-control" id="tgl_pengeluaran" name="tgl_pengeluaran" aria-describedby="basic-addon1" value="<?php echo $date?>" required>
								</div>
								<script type="text/javascript">
									$(function () {
								        $('#tgl_pengeluaran').datetimepicker({
								        	format:'YYYY-MM-DD'
								        	// minDate:new Date(), 
								        	// disabledDates: [new Date()]
								        });
								    });
								</script>
							</div>
							<div class="form-group col-md-7">
								<label for="keterangan">Keterangan Pengeluaran</label>
								<textarea rows="7" class="form-control" id="ket_pengeluaran" name="ket_pengeluaran" placeholder="Masukan Keterangan Pengeluaran" required></textarea>
							</div>
							<div class="form-group col-md-7">
								<label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
								<!-- <small>Uang yang Dikeluarkan</small> -->
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon4">Rp.</span>
									<input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" placeholder="Masukan Jumlah Pengeluaran" aria-describedby="basic-addon4" required>
								</div>
							</div>
							
							
							<div class="box-footer col-md-7">
								<button type="submit" class="btn btn-primary" name="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
				<!-- /.box -->
			</div>

		<script>
		var total = document.getElementById("jumlah_pengeluaran");

		total.addEventListener("keyup", function(e) {
		  // tambahkan 'Rp.' pada saat form di ketik
		  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		  total.value = formatRupiah(this.value, "");
		  // hutang.value = formatRupiah(this.value, "");
		});


		function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	 
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	 
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
		}
		</script>
		</section>
	</div>
		
	<?php
		include '../footer.php';
	?>