<?php  
	$path = realpath(__DIR__ . '/..');
	// var_dump($path);
	$path_image = dirname('/'); 
	include ('header.php');
	include_once($path . '/init/db.pdo.php');
	include('functions.php');

	$database = new Database();
    $db = $database->connect();
	$query = $db->prepare("SELECT * FROM tbl_produk WHERE id_kat = 2");
	$query->execute();
	$data = $query->fetchAll(); 
?>


<!-- Header Navbar -->
<nav class="navbar navbar-light bg-green">
	<!-- <a href="" class="navbar-brand">Navbar</a> -->
	<div class="container">		
		<a class="navbar-brand" href="index.php">
				<!-- <img src="assets/img/ico.png" width="30" height="30" class="d-inline-block align-top" alt=""> -->
				Botanical Cafe
		</a>

		<div class="account pull-right">
			<img src="../dist/img/ico_coffee.png" class="img-avatar" alt="avatar">
			<div class="btn-group" style="margin-top:7px;">
				<button type="button" class="btn btn-default bg-green account-menu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Antony <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right" style="margin-top:10px;">
					<li><a href="#"><i class="fas fa-address-card"></i>Antony Jarot</a></li>
					<li><a href="#"><i class="fas fa-clock"></i>Member Since 2018</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#"><i class="fas fa-power-off"></i>Log Out</a></li>
				</ul>
			</div>
		</div>
		<!-- /account -->
		
	</div>	
</nav>

<div class="">
	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		<!-- col-8 -->
		<div class="col-md-8" >
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="margin-top: 10px; background-color: white; border: none;">
						<a href="" title="" class="add-link" style="font-size: 16px;">+ Add New Menu</a>
						<div class="form-group col-md-4 pull-right">
							<div class="input-group">                  			
	                  			<input type="text" class="form-control my-btn" style="background-color: #faf6f6" id="txtSearch" name="txtSearch" placeholder="Pencarian" aria-describedby="basic-addon3" required>
	                  			<span class="input-group-addon my-btn bg-green" id="basic-addon3" style="font-size: 18px;"><i class="fas fa-search"></i></span>
		                  	</div>		                  		
						</div>						
					</div>
					<div class="panel-body" style=" width: 100%; height: 350px; overflow-y: auto;">
						
						<div class="row">
							<div id="menu">
							<?php 
								foreach ($data as $value): 
							?>
								<!-- col 3 -->
								<div class="col-md-3" id="produk-select" class="produk-select">
									<div class="panel panel-default">
									<div class="panel-body ">
										<img src="<?php echo '..'.$value['image_produk']?>" class="img-responsive img-rounded" alt="<?php echo $value['nama_produk']?>" style="width: 100%">
										<div class="title-menu">
												<h4 id="nama-produk"><?php echo $value['nama_produk']?></h4>
												<p id="p-harga" class="p-harga"><?php echo rupiah($value['harga_produk']) ?></p>
										</div>							   
									</div>
									</div>					
								</div>
								<!-- / col 3 -->

								<?php endforeach; ?>
							</div>
							<!-- menu -->
						</div>
						<!-- /row -->
							
					</div>
					<!-- /panel body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col 12 -->
			<!-- col 12 -->
			<div class="col-md-12" style="padding: 0px;">
				<div class="col-md-4">
					<button type="button" id="btn-menu-drink" class="btn btn-menu btn-lg btn-block"><img src="../dist/img/ico_coffee.png" alt=""><br><strong>Drink</strong></button>
				</div>
				<div class="col-md-4">
					<button type="button" id="btn-menu-snack" class="btn btn-menu btn-lg btn-block"><img src="../dist/img/ico_snack.png" alt=""><br><strong>Snack</strong></button>
				</div>
				<div class="col-md-4">
					<button type="button" id="btn-menu-food" class="btn btn-menu btn-lg btn-block"><img src="../dist/img/ico_food.png" alt=""><br><strong>Food</strong></button>
				</div>					
			</div>
			<!-- /col 12 -->
		</div>
		<!-- end col-8 -->

		<!-- col-4 -->
		<div class="col-md-4">
			<div class="panel panel-default" style="height: 450px;"	 >
				<div class="panel-heading" style="background-color: white; border: none; text-align: center;">
					<h4>Checkout</h4>
					<h6>Trans. #20190300001</h6>
					
				</div>
				<div style="padding-left:15px; padding-right:15px;">
					<table class="table table-header">
						<!-- <caption>table title and/or explanatory text</caption> -->
						<thead>
							<tr>
								<th style="width:7%;"></th>
								<th style="text-align: left; width:97.65px;">Name</th>
								<th style="text-align: center; width:122.483px;">Qty</th>
								<th style="text-align: right;">Price</th>
							</tr>
						</thead>
					</table>
				</div>
				
				<div class="panel-body" style="padding-top:0px; width: 100%; height:300px; overflow-y: auto;">
					<table class="table" id ="tbl-pesanan">
						<!-- <caption>table title and/or explanatory text</caption> -->
						<!-- <thead>
							<tr>
								<th></th>
								<th style="text-align: left;">Name</th>
								<th style="text-align: center;">Qty</th>
								<th style="text-align: right;">Price</th>
							</tr>
						</thead> -->
						<tbody>
							<div>
								<!-- <tr>
									<td width="7%"><a href="" title=""><i style="font-size: 18px; color: #2ecc71;" class="fa fa-trash"></i></a></td>
									<td style="text-align: left;">Teh Es</td>
									<td style="text-align: center;">
										<a href="" title=""><i style="font-size: 18px; color: #2ecc71;" class="fa fa-plus-circle"></i></a> 
										<span style="margin-left: 7px; margin-right: 7px;">1</span> 
										<a href="" title=""><i style="font-size: 18px; color: #2ecc71;" class="fa fa-minus-circle"></i>
									</td>
									<td style="text-align: right;">Rp. 5.000</td>
								</tr> -->
								
							</div>
						</tbody>
					</table>
				</div>
				<div class="panel-footer" style="background-color: white;">
					<table class="table" style="margin-bottom: 0px; font-size: 18px;">
						<!-- <caption>table title and/or explanatory text</caption> -->
						<thead>
							<tr>
								<td style="text-align: center;"><strong>Total</strong></td>
								<td style="text-align: right;"><strong>Rp. 65.000</strong></td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- end col-4 -->
		
	</div>
	<div class="row" style="margin-left: 10px; margin-right: 10px; margin-top: 15px;" >
		<div class="col-md-8" style="padding-right: 30px;">			
			<button type="submit" class="btn bg-btn-hold btn-lg pull-right" style="margin-left: 10px;"><span style="font-size: 15px;"><strong>Hold Order</strong></span></button>
			<button type="submit" class="btn bg-btn-cancel btn-lg pull-right"><span style="font-size: 15px;"><strong>Cancel Order</strong></span></button>
		</div>
		<div class="col-md-4">
			<button type="submit" class="btn bg-green btn-lg" style="display:inline-block; width: 100%;"><span style="font-size: 15px;"><strong>Pay (Rp. 65.000)</strong></span></button>
		</div>
	</div>
</div>


<script>
	var rowid = 1;

	// Tombol Menu Minuman
	$(document).on('click', '#btn-menu-drink', function (e) {

		$.ajax({
			url: "produks/drinks_menu.php",
			success: function (result) {
				//   console.log(result);
				document.getElementById('menu').innerHTML = result;
			}
		});

		//   loadJumlah(sub_total);
	});

	// Tombol Menu Snack
	$(document).on('click', '#btn-menu-snack', function (e) {
		// console.log("snack");
		$.ajax({
			url: "produks/snacks_menu.php",
			success: function (result) {
				//   console.log(result);
				document.getElementById('menu').innerHTML = result;
			}
		});

	});

	// Tombol Menu Makanan
	$(document).on('click', '#btn-menu-food', function (e) {
		// console.log("Food");
		$.ajax({
			url: "produks/foods_menu.php",
			success: function (result) {
				//   console.log(result);
				document.getElementById('menu').innerHTML = result;
			}
		});

	});

	// fungsi menambah pesanan dalam tabel
	$("#produk-select").click(function () {
		// var nama_produk = getElementsByClassName("nama-produk").value;
		console.log("tes");
		
		// var a = $('#subtotal_brg').val();
		// var a = $('#jumlah').val();
		// if (a == '' || a == 0) {
		// 	swal("Jumlah Barang Tidak Boleh Kosong");
		// 	// }else if(cekStok()) {
		// 	//swal("Jumlah Barang Tidak Boleh Kosong");
		// } else {
		// 	//$("#lookup-brg tbody").load("load_brg.php");
		// 	var barang = $("#barang").val();
		// 	var harga = $("#harga").val();
		// 	var jumlah = $("#jumlah").val();
		// 	//console.log(stok_brg);
		// 	// var stok = stok_brg;
		// 	var sub = harga * jumlah;
		// 	sub_total = sub_total + sub;
			// $.ajax({
			// 	type: "POST",
			// 	data: "id_transaksi=" + id_transaksi + "&id_barang=" + id_brg + "&harga_brg=" + harga + "&jumlah_brg=" + jumlah + "&sub_harga=" + sub + "&stok_brg=" + stok_brg,
			// 	url: "user_transaksi.php",
			// 	success: function (result) {
			// 		console.log(result);
			// 	}
			// });

			// fungsi untuk menambah row tabel pesanan
			// document.getElementById("jumlah_total").value = sub_total;
			var row = "<tr><td width='7%'><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-trash'></i></a></td><td style='text-align: left;'>Teh Es</td><td style='text-align: center;'><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-plus-circle'></i></a><span style='margin-left: 7px; margin-right: 7px;'>1</span><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-minus-circle'></i></td><td style='text-align: right;'>Rp. 5.000</td></tr>";
			// var markup = "<tr id='" + rowid + "'' ><td>" + barang + "</td><td>" + harga + "</td><td>" + jumlah + "</td><td>" + sub + "</td><td><button type='button' class='delete-row btn btn-danger' data-sub='" + sub + "' data-id_brg='" + id_brg + "' data-jumlah='" + jumlah + "' data-row ='" + rowid + "'>Delete Row</button></td></tr>";
			var markup = "<tr id='" + rowid + "'><td>1</td><td>1000</td><td>1000</td><td>1</td><td><button type='button' class='delete-row btn btn-danger' data-sub='1' data-id_brg='1' data-jumlah='1000' data-row ='" + rowid + "'>Delete Row</button></td></tr>";
			$("#tbl-pesanan tbody").append(row);
			// loadJumlah(sub_total);
			rowid = rowid + 1;
			// document.getElementById("add-row").disabled = true;
			// document.getElementById("jumlah").disabled = true;
		// }
	});
	// tutup menambah pesanan dalam tabel

</script>