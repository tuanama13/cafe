<?php  
	session_start();
	//fungsi already header(menangkal warnings)
	ob_start();
	// date_default_timezone_set('Asia/Jakarta');
	// include (basename(dirname(__FILE__)).'/init/db.php');
	//echo dirname( __DIR__ ) . '/init/db.php' ;
	include '../init/db.php';
  //include "../admin_login.php";
	include '../header.php';
  	include '../sidebar.php';
  	$tgl_new = date("Y-m-d h:i:s");



   	if (isset($_POST['submit'])) {

   		$sql = "SELECT max(kode_piutang) as maxid FROM tbl_piutang WHERE kode_piutang LIKE 'PMB%'";
        $row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        $idmax=$row['maxid'];
        $row = mysqli_num_rows(mysqli_query($conn,$sql));
        if ($row<=0) {
            $kode_p="PMB-0000001";
        }else{
            $nourut = (int) substr($idmax, 4,7);
            $nourut++;
            $kode_p = "PMB-".sprintf("%07s", $nourut);
        }
//		
		// $kode_p = mysqli_real_escape_string($conn,$_POST['kode_piutang']);
		$kode_t = mysqli_real_escape_string($conn,$_POST['kode_transaksi']);
		$tgl_masuk = mysqli_real_escape_string($conn,$_POST['tgl_masuk']);
		$tempo = mysqli_real_escape_string($conn,$_POST['tempo']);
//		$tgl2 = mysqli_real_escape_string($conn,$_POST['tgl_bayar']);
		// $tgl2= date("Y/m/d H:i:s",mktime(date('H'),date('i'),date('s'),date('m'),date('d')+$tempo,date('Y')));
		$total_p = str_replace(".", "", mysqli_real_escape_string($conn,$_POST['total_piutang']));
		$total_d = str_replace(".", "", mysqli_real_escape_string($conn,$_POST['total_dibayar']));
		// $sisa = mysqli_real_escape_string($conn,$_POST['sisa']);
		$status = mysqli_real_escape_string($conn,$_POST['pilih_status']);
		$supplier = mysqli_real_escape_string($conn,$_POST['supplier']);
		
		$sisa = ((int)$total_p - (int)$total_d);

		// print_r($_POST);

		if ($status == '1') {
			$insert = "INSERT INTO tbl_piutang(kode_piutang,kode_transaksi,tgl_masuk,tgl_jatuh_tempo,total_piutang,total_dibayar,sisa_hutang,tgl_lunas,status,supplier) VALUES ('$kode_p','$kode_t','$tgl_masuk','$tempo','$total_p','$total_d','$sisa','$tgl_masuk','$status','$supplier')";
			// $insert = "INSERT INTO tbl_piutang(kode_piutang,kode_transaksi,tgl_jatuh_tempo,total_piutang,total_dibayar,sisa_hutang,status,supplier) VALUES ('$kode_p','$kode_t','$tempo','$total_p','$total_d','$sisa','$status','$supplier')";
		}else{
			$insert = "INSERT INTO tbl_piutang(kode_piutang,kode_transaksi,tgl_masuk,tgl_jatuh_tempo,total_piutang,total_dibayar,sisa_hutang,tgl_lunas,status,supplier) VALUES ('$kode_p','$kode_t','$tgl_masuk','$tempo','$total_p','$total_d','$sisa','$tgl_masuk','$status','$supplier')";
			// $insert = "INSERT INTO tbl_piutang(kode_piutang,kode_transaksi,tgl_jatuh_tempo,total_piutang,total_dibayar,sisa_hutang,tgl_lunas,status,supplier) VALUES ('$kode_p','$kode_t','$tgl1','$total_p','$total_d','$sisa','$tgl1','$status','$supplier')";
		}

		
		if (mysqli_query($conn,$insert)) {
		header('Location: list_piutang.php');
		}else{
		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Bermasalah (Pastikan Kode Piutang Belum Terdaftar Pada List Piutang !!)</h4></div>';
		}
	}

?>
<script type="text/javascript">
<?php $pw="hello"; ?>
function kode(){
document.getElementById("kode_piutang").value="<?php echo $pw; ?>";
}

</script>

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
        <li class="active">Tambah Pembelian</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Tambah Pembelian
	                <!-- <small>Form Untuk Pembelian</small> -->
	              </h3>
	            </div>

	            <div class="box-body pad">
	              <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div class="form-group col-md-6">
						<label for="tgl_masuk">Tanggal Masuk/Pembelian</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
						  <!-- <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1"> -->
						  <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Pilih Tanggal" aria-describedby="basic-addon1" required>
						</div>

						<script type="text/javascript">
							$(function () {
						        $('#tgl_masuk').datetimepicker({
						        	format:'YYYY-MM-DD'
						        	// minDate:new Date(), 
						        	// disabledDates: [new Date()]
						        });
						    });
						</script>
						
						
					</div>
					<div class="form-group date col-md-6">
						<label for="tgl_tempo">Tanggal Jatuh Tempo</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
						  <input type="text" class="form-control" id="tempo" name="tempo" placeholder="Pilih Tanggal Jatuh Tempo" aria-describedby="basic-addon2" required>
						</div>
						

						<script type="text/javascript">
							$(function () {
						        $('#tempo').datetimepicker({
						        	format: 'YYYY-MM-DD'
						        	// minDate:new Date(), 
						        	// disabledDates: [new Date()]
						        });
						    });
						</script>
					</div>
									
					<div class="form-group col-md-6">
						<label for="kode_transaksi">Kode Transaksi</label>
						<input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" placeholder="Masukan Kode Transaksi" required>
					</div>
					
					<!-- <div class="form-group col-md-6">
						<label for="kode_piutang">Kode Pembelian</label>
						<input type="text" class="form-control" id="kode_piutang" name="kode_piutang" placeholder="Masukan Kode Piutang" required autofocus="autofocus">
					</div>	 -->				
					<div class="form-group col-md-6" >
						<label for="harga-beli">Total Pembelian</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon3">Rp.</span>
						  <input type="text" class="form-control" id="total_piutang" name="total_piutang" placeholder="Masukan Total Pembelian" aria-describedby="basic-addon3" required>
						</div>
						
					</div>
					<div class="form-group col-md-6">
						<label for="harga">Supplier</label>
						<input type="text" class="form-control" id="supplier" name="supplier" placeholder="Masukan Supplier" required>
					</div>
					<div class="form-group col-md-6" >
						<label for="harga-beli">Total Dibayar</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon4">Rp.</span>
						  <input type="text" class="form-control" id="total_dibayar" name="total_dibayar" placeholder="Masukan Total Dibayar" aria-describedby="basic-addon4" required>
						</div>
						
					</div>
					<div class="form-group col-md-6">
						<label>Status</label>
						<select class="form-control" id="pilih_status" name="pilih_status">
							<option>Pilih Status</option>
							<option value="0"><strong>Lunas</strong></option>
							<option value="1"><strong>Hutang</strong></option>
						</select>
					</div>	
	      
					
					<div class="box-footer col-md-12">
						<button type="submit" class="btn btn-primary pull-right" name="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	          <!-- /.box -->
	</div>

<script type="text/javascript">
	var total = document.getElementById("total_piutang");
	var hutang = document.getElementById("total_dibayar");

	total.addEventListener("keyup", function(e) {
			  // tambahkan 'Rp.' pada saat form di ketik
			  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			  total.value = formatRupiah(this.value, "");
			  // z.value = formatRupiah(this.value, "");
			});

	hutang.addEventListener("keyup", function(e) {
			  // tambahkan 'Rp.' pada saat form di ketik
			  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			  hutang.value = formatRupiah(this.value, "");
			  // z.value = formatRupiah(this.value, "");
			});

	
	$(document).ready(function () {
		var x = document.getElementById("tempo");
	    var y = document.getElementById("total_dibayar");

	 	// x.readOnly = true;
	    y.readOnly = true;
	});

	$('#pilih_status').on('change', function (e) {
	    var status = $("#pilih_status").val();
	    var x = document.getElementById("tempo");
	    var y = document.getElementById("total_piutang");
	    var z = document.getElementById("total_dibayar");

		// console.log(status);
		switch(status) {
		  case "0":
		  	x.value = "";
		  	z.value = y.value;
		  	// x.readOnly = true;
		    z.readOnly = true;


		    y.addEventListener("keyup", function(e) {
			  // tambahkan 'Rp.' pada saat form di ketik
			  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			  y.value = formatRupiah(this.value, "");
			  z.value = formatRupiah(this.value, "");
			});


		    
		    break;
		  case "1":
		  	z.value = "";
		    // x.readOnly = false;
		    z.readOnly = false;

		    // y.addEventListener("keyup", function(e) {
			  // tambahkan 'Rp.' pada saat form di ketik
			//   // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			//   y.value = formatRupiah(this.value, "");
			//   // z.value = formatRupiah(this.value, "");
			// });

			// z.addEventListener("keyup", function(e) {
			//   // tambahkan 'Rp.' pada saat form di ketik
			//   // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			//   // y.value = formatRupiah(this.value, "");
			//   z.value = formatRupiah(this.value, "");
			// });


		    break;
		}

  	});


 //  	function formatRupiah(angka, prefix){
	// 	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	// 	split   		= number_string.split(','),
	// 	sisa     		= split[0].length % 3,
	// 	rupiah     		= split[0].substr(0, sisa),
	// 	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	 
	// 	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	// 	if(ribuan){
	// 		separator = sisa ? '.' : '';
	// 		rupiah += separator + ribuan.join('.');
	// 	}
	 
	// 	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	// 	return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
	// }
	
</script>



	</section>
   </div>
   <?php  
   	include '../footer.php';
   ?>