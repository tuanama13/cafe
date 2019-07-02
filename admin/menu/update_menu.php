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
	
	$result_kat = $menu->readKategori();
	
	// Menu Sidebar
	$page_header = "menu";

	// include '../init/db.php';
//	include "../admin_login.php";
	include '../header.php';
  	include '../sidebar.php';
	// $id = isset( $_GET['id']) ?  $_GET['id'] : null;
	if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
  	}else{
    	header('Location: list_menu.php');
  	}

	

	// echo $_GET['id'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_produk a JOIN tbl_kategori b USING (id_kat) WHERE a.id_produk='$id'");
	$rows = mysqli_fetch_assoc($query);

	// Kategori
	$query_kat = mysqli_query($conn,"SELECT * FROM tbl_kategori");
	$rows_kat = mysqli_fetch_assoc($query_kat);

	if (isset($_POST['submit'])) {
		$menu->id_kat = $_POST['kategori'];
        $menu->nama_produk = $_POST['nama_menu'];
        $menu->desc_produk = $_POST['desc_produk'];
        // $menu->image_produk = $_FILES['myimage'];
        $menu->harga_produk = str_replace(".","",$_POST['harga_jual']);
        
        $menu->status_produk = $_POST['status_menu'];
		$menu->logs = 1;
		$menu->id_produk = $id;

		if (empty($_FILES['myimage']['name'])) {
			$menu->image_produk = $rows['image_produk'];
			// $target =  $_FILES['myimage']['name'];
			
			if ($menu->updateProduksKos()){
			// echo "success";
				header('Location: list_menu.php');
			}else{
				// echo "cancel";
				die(mysqli_error());
			}
			// echo "...................................................................kosong";
		}else {
			$target =  $_FILES['myimage']['name'];
			if ($menu->updateProduks($target)){
			// echo "success";
				header('Location: list_menu.php');
			}else{
				// echo "cancel";
				die(mysqli_error());
			}
			// echo ".....................................................................ndak";
		}
	  
	}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			Barang
  			<small>Form Barang</small>
  		</h1>
  		<ol class="breadcrumb">
  			<li><i class="fa fa-home"></i> Home</a></li>
  			<li class="">Barang</li>
  			<li class="active">Update Barang</li>
  		</ol>
  	</section>

  	<section class="content">
  		<!-- Main content -->
  		<div class="row">
  			<div class="col-md-8">
  				<div class="box box-info">
  					<div class="box-header">
  						<h3 class="box-title">Update Barang
  							<small>Data Barang Yang Akan Diubah</small>
  						</h3>

  					</div>
  					<!-- /.box-header -->
  					<div class="box-body pad">
  						<form role="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post"
  							enctype="multipart/form-data">

  							<div class="form-group col-md-7">
  								<label for="judul">Nama Menu</label>
  								<input type="text" class="form-control" id="nama_menu" name="nama_menu"
  									placeholder="Masukan Nama Menu" value='<?php echo "$rows[nama_produk]";?>' required>
  							</div>

  							<div class="form-group col-md-4">
  								<label for="kategori">Kategori</label>
								 
  								<select id="kategori" name="kategori" class="form-control">
								
								<?php
									foreach ($result_kat as $value_kat) {
										if ($rows['id_kat']==$value_kat['id_kat']) {
											$select = "selected";
										}else {
											$select = '';
										}
										echo"
											<option ".$select." value='".$value_kat['id_kat']."'>".$value_kat['nama_kat']."</option>
										";
									}
								?>

							 <!-- <option value="PCS">PCS</option> --> -->
								</select>
  								<!-- <div id="kategori">

  								</div> -->

  							</div>
  							<div class="col-md-1">
  								<button type="button" id="btn_kat" data-toggle="modal" data-target="#exampleModal"
  									class=""
  									style="margin-top: 29px; margin-left: -15px; background-color: white; border-color: white; border-style: solid;"><i
  										class="fa fa-plus"></i></button>
  							</div>

  							<div class="form-group col-md-7">
  								<label for="harga">Harga Jual</label>
  								<div class="input-group">
  									<span class="input-group-addon" id="basic-addon3">Rp.</span>
  									<input type="text" class="form-control" id="harga_jual1" name="harga_jual"
  										placeholder="Masukan Harga Jual Menu" value='<?php echo "$rows[harga_produk]";?>' required 
  										aria-describedby="basic-addon4">
  								</div>
  							</div>

  							<div class="form-group col-md-7">
  								<label for="harga">Gambar Menu</label>
  								<div class="input-group">
  									<input type="file" class="btn btn-primary" name="myimage"
  										placeholder="Browse Your Image">
  								</div>
  							</div>

  							<div class="form-group col-md-7">
  								<label for="desc_produk">Deskripsi Menu</label>

  								<textarea class="form-control" id="desc_produk" name="desc_produk"
  									placeholder="Masukan Deskripsi Menu" rows="5"  required><?php echo "$rows[desc_produk]";?></textarea>
  							</div>

							<div class="form-group col-md-3">
								<label for="desc_produk">Status Menu</label>
									<select id="status_menu" name="status_menu" class="form-control">
								<option <?php if ($rows['status_produk']== 1) echo 'selected' ?> value='1'>Tersedia</option>
								<option <?php if ($rows['status_produk']== 0) echo 'selected' ?> value='0'>Tidak Tersedia</option>
							
								</select>
							</div>
  					</div>
  					<div class="box-footer">
  						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
  					</div>
  					</form>
  				
  			</div>
  			<!-- /.box -->
  		</div>

  	</section>
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
			// $("#kategori").load("load_kategori.php");
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