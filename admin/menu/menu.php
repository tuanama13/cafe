<?php  
	session_start();
	//fungsi already header(menangkal warnings)
	ob_start();

	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');

	include_once '../models/Menus.php';

    $database = new Database();
    $db = $database->connect();

    $menu = new Menu($db);
	
	// Menu Sidebar
	$page_header = "menu";
    $page_li = "tambah_menu";
	// include (basename(dirname(__FILE__)).'/init/db.php');
	//echo dirname( __DIR__ ) . '/init/db.php' ;
	// include '../init/db.php';
  //include "../admin_login.php";
	include_once ('../header.php');
  	include '../sidebar.php';


   	if (isset($_POST['submit'])) {

		$menu->id_kat = $_POST['kategori'];
        $menu->nama_produk = $_POST['nama_menu'];
        $menu->desc_produk = $_POST['desc_produk'];
        // $menu->image_produk = $_FILES['myimage'];
        $menu->harga_produk = str_replace(".","",$_POST['harga_jual']);
        $target =  $_FILES['myimage']['name'];
        $menu->status_produk = 1;
		$menu->logs = 1;
		
		if ($menu->createProduks($target)){
			// echo "success";
			header('Location: list_menu.php');
        }else{
			// echo "cancel";
			die(mysqli_error());
        }
		// print_r($_POST);
		// print_r($_FILES);
		// $kode = mysqli_real_escape_string($conn,$_POST['id_barang']);
		// $nama = mysqli_real_escape_string($conn,$_POST['nama_menu']);
		// $kategori = mysqli_real_escape_string($conn,$_POST['kategori']);
		// $desc_produk = mysqli_real_escape_string($conn,$_POST['desc_produk']);
		// $image_produk = $_FILES['myimage']['name'];


    	// $harga_beli = str_replace(".", "",mysqli_real_escape_string($conn,$_POST['harga_beli']));
    	// $harga_jual = str_replace(".", "",mysqli_real_escape_string($conn,$_POST['harga_jual']));
		// $stok = mysqli_real_escape_string($conn,$_POST['stok']);
		// $sup = mysqli_real_escape_string($conn,$_POST['supplier']);


		// $insert = "INSERT INTO tbl_produk(id_kat,nama_produk,desc_produk,image_produk, harga_produk,status_produk,logs) VALUES ('$kategori','$nama','$desc_produk','$image_produk','$harga_jual','1','1')";

		// if (mysqli_query($conn,$insert)) {
		// 		header('Location: list_menu.php');
		// 	}else{
		// 		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Bermasalah (Pastikan ID Barang Belum Terdaftar Pada List Barang !!)</h4></div>';
		// 	}
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
        Menu
        <small>Form Penambahan Menu</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Home</a></li>
        <li class="">Menu</li>
        <li class="active">Tambah Menu</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Tambah Menu
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
	              <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		      		
              <!-- <div class="form-group col-md-7">
                      <label for="judul" id="lb">Id Barang</label>
                      <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Masukan ID Barang" required>
                  </div> -->
              <!-- <div class="form-group col-md-7">
                  		<label for="judul">Kode Barang</label>
                  		<input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Masukan Kode Barang" required autofocus="autofocus">
                	</div> -->

              <div class="form-group col-md-7">
                  		<label for="judul">Nama Menu</label>
                  		<input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukan Nama Menu" required>
                	</div>

                	<!-- <div class="form-group col-md-7">
                  		<label for="stok">Jumlah Barang</label>
                  		<input type="number" class="form-control" id="jumlah_barang" name="stok" placeholder="Masukan Jumlah Stok Barang" required>
                	</div> -->
					<div  class="form-group col-md-4">
						<label for="kategori">Kategori</label>
						<!--<select id="satuan" name="satuan" class="form-control" required >
							<option value="PCS">PCS</option>
							<option value="KG">KG</option>
							<option value="BTG">BTG</option>
							<option value="SAK">SAK</option>
							<option value="ROLL">ROLL</option>
							<option value="M">M</option>
							<option value="SET">SET</option>
						</select> -->
						<div id="kategori">
							
						</div>
						
					</div>
					<div class="col-md-1" >
						<button type="button" id="btn_kat" data-toggle="modal" data-target="#exampleModal" class="" style="margin-top: 29px; margin-left: -15px; background-color: white; border-color: white; border-style: solid;"><i class="fa fa-plus"></i></button>
					</div>         	

                	<!-- <div class="form-group col-md-7" >
                  		<label for="harga-beli">Harga Beli</label>
                  		<div class="input-group">
                  			<span class="input-group-addon" id="basic-addon3">Rp.</span>
                  			<input type="text" class="form-control my-btn" id="harga_beli" name="harga_beli" placeholder="Masukan Harga Beli Barang" aria-describedby="basic-addon3" required>
                  		</div>
                	</div> -->
                	<div class="form-group col-md-7">
                  		<label for="harga">Harga Jual</label>
                  		<div class="input-group">
                  			<span class="input-group-addon" id="basic-addon3">Rp.</span>
                  			<input type="text" class="form-control" id="harga_jual1" name="harga_jual" placeholder="Masukan Harga Jual Menu" required aria-describedby="basic-addon4">
                  		</div>
                	</div>
					<!-- <div class="form-group col-md-7">
                  		<label for="harga">Supplier</label>
                  		<input type="text" class="form-control" id="supplier" name="supplier" placeholder="Masukan Nama Supplier" required>
                	</div> -->
	      			<div class="form-group col-md-7">
					  	<label for="harga">Gambar Menu</label>
						<div class="input-group">
							<input type="file" class="btn btn-primary" name="myimage" placeholder="Browse Your Image" required>
						</div>
					</div>

					<!-- <div class="col-xs-6 col-md-3">						
						<img class="thumbnail" id="img_thumb" src="../Logo2-mini.png" alt="...">						
					</div> -->

					<div class="form-group col-md-7">
                  		<label for="desc_produk">Deskripsi Menu</label>
                  		
                  			<textarea class="form-control" id="desc_produk" name="desc_produk" placeholder="Masukan Deskripsi Menu" rows="5" required ></textarea>
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


   	<!-- Modal Kategori -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title" id="exampleModalLabel">Tambah Kategori</h3>
					
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-7">
                  		<label for="harga">Kategori</label>
                  		<input type="text" class="form-control" id="int_kategori" name="int_kategori" placeholder="Masukan Kategori">
                	</div>
					</div>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
					<button type="button" id="btn_kat" class="btn_kat btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>


	<script>
		// var beli = document.getElementById("harga_beli");
		var jual = document.getElementById("harga_jual1");

		// beli.addEventListener("keyup", function(e) {
		  // tambahkan 'Rp.' pada saat form di ketik
		  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		//   beli.value = formatRupiah(this.value, "");
		  // hutang.value = formatRupiah(this.value, "");
		// });
		jual.addEventListener("keyup", function(e) {
		  // tambahkan 'Rp.' pada saat form di ketik
		  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		  jual.value = formatRupiah(this.value, "");
		  // hutang.value = formatRupiah(this.value, "");
		});


		$(document).ready(function(){
			$("#kategori").load("load_kategori.php");
		});

		$('#exampleModal').on('shown.bs.modal', function () {
			$('#int_kategori').trigger('focus')
		})

		$(document).on('click', '.btn_kat', function (e) {
	    var kategori = $("[name='int_kategori']").val();

	    $.ajax({
	      type  : "POST",
	      data  : "kategori="+kategori,
	      url   : "insert_kategori.php",
	      success : function(result){
	      	// console.log(result);
	      	
	      	$("#kategori").load("load_kategori.php");
	      	$('#exampleModal').modal("hide");

	        // document.getElementById('int_kategori').value="";

	      }
	    });

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


   <?php  
   	include '../footer.php';
   ?>