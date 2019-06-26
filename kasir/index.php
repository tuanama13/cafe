<?php
	ob_start();  
	$path = realpath(__DIR__ . '/..');
	// var_dump($path);
	$path_image = dirname('/'); 
	include ('header.php');
	include_once($path . '/init/db.pdo.php');
	include_once 'models/Orders.php';
	include('functions.php');

	if (empty($_GET['table'])) {
		header("Location: table.php");
	}else {
		$table = $_GET['table'];
	}

	// id cabang
	$id_cabang_ = 1;

	// id User
	$id_user_ = 1;



	// Keterangan :
	// -> no meja = $table
	// -> nomor order next = $_maxid
	// -> id cabang = $id_cabang_
	// -> id User = $id_user_


	$database = new Database();
    $db = $database->connect();
	$query = $db->prepare("SELECT * FROM tbl_produk WHERE id_kat = 2");
	$query->execute();
	$data = $query->fetchAll(); 

	$order = new Order($db);
	$maxid = $order->cekLastOrder();

?>


<!-- Header Navbar -->
<nav class="navbar navbar-light bg-green" style="padding-right:20px;padding-left:20px;">
	<!-- <a href="" class="navbar-brand">Navbar</a> -->
	<!-- <div class="container">		 -->
		<a class="navbar-brand" href="index.php">
				<!-- <img src="assets/img/ico.png" width="30" height="30" class="d-inline-block align-top" alt=""> -->
				Botanical Cafe
		</a>

		<div class="account pull-right">
			<img src="../dist/img/ico_table.svg" id="link_table" style="width: 30px; height: 30px;  margin-right: 20px; fill: white;">

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
		
	<!-- </div>	 -->
</nav>

<div class="">
	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		<!-- col-8 -->
		<div class="col-md-8" >
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="margin-top: 10px; background-color: white; border: none;">
						<a href="#" title="" class="add-link" style="font-size: 25px;">Menu</a>
						<div class="form-group col-md-4 pull-right">
							<div class="input-group">                  			
	                  			<input type="text" class="form-control my-btn" style="background-color: #faf6f6" id="txtSearch" name="txtSearch" placeholder="Pencarian" onkeyup="searchProd()" aria-describedby="basic-addon3" required>
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
								<div class='col-md-3' id='produk-select' class='produk-select' onclick="myPesan('<?php echo $value['id_produk'];?>','<?php echo $value['nama_produk'];?>','<?php echo $value['harga_produk'];?>')">
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
					<h4> <strong>Checkout Table <?php echo $table; ?> </strong></h4>
					<h6>Trans. #<?php foreach ($maxid as $value) {
											$_maxid = $value['maxid']+1;
        								echo $_maxid ;} ?></h6>
					
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
								<td style="text-align: left;" width='20%'><strong><h3>Total</h3></strong></td>
								<td style="text-align: right;"><strong><h3 id="total_pesan">0</h3></strong></td>
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
			<button type="button" id="btn_pay" data-toggle="modal" data-target="#exampleModal" class="btn bg-green btn-lg" style="display:inline-block; width: 100%;"><span style="font-size: 15px;"><strong>Pay</strong></span></button>
		</div>
	</div>
</div>


<!-- Modal Pay -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title" id="exampleModalLabel">Payment</h3>
					
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-body" style="padding: 10px;">
									
									<table style="padding-left: 10px;">
										<tbody>
											<tr>
												<td><h2 style="margin-bottom: 25px;">Table <?php echo $table; ?></h2></td>
												<div class="divider">
													
												</div>
											</tr>
											<tr>
												<td><h4 style="margin-bottom: 5px;">Total</h4></td>
											</tr>
											<tr>
												<td ><h3 id="txtTotal" style="margin-top: 5px; margin-bottom: 30px;">Rp 0</h3></td>
											</tr>
											<tr>
												<td><h4 style="margin-bottom: 5px;">Bayar</h4></td>
											</tr>
											<tr>
												<td><h3 id="txtBayar" style="margin-top: 5px; margin-bottom: 30px;">Rp 0</h3></td>
											</tr>
											<tr>
												<td><h4 style="margin-bottom: 5px;">Kembalian</h4></td>
											
											</tr>
											<tr>
													<td><h3 id="txtKembalian" style="margin-top: 5px; margin-bottom: 30px;">Rp 0</h3></td>
											</tr>
										</tbody>
									</table>
								
										
								</div>
								<!-- /panel body -->
							</div>
							<!-- /panel -->
						</div>
						<!-- /col-md-4 -->
						<div class="col-md-8">
							<div class="panel panel-default">
								<div class="panel-heading" style="background-color: white; border: none;">
									<div class="form-group col-md-12">
				                  		<div class="input-group" >
				                  			<span class="input-group-addon" id="basic-addon3" style="height: 80px; font-size: 2em">Rp</span>
				                  			<input type="text" style="height: 80px; font-size: 3em; text-align: right;" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" value="0" required aria-describedby="basic-addon4">
				                  		</div>
				                	</div>
												
								</div>
								<div class="panel-body" style="padding: 30px;">								
									<button type="button" class="btn_cal col-md-4" onclick="calc('1')">1</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('2')">2</button>
									<button  type="button" class="btn_cal col-md-4" onclick="calc('3')">3</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('4')">4</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('5')">5</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('6')">6</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('7')">7</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('8')">8</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('9')">9</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('000')">000</button>
									<button type="button" class="btn_cal col-md-4" onclick="calc('0')">0</button>
									<button type="button" class="btn_cal col-md-4" onclick="delCalc()"><</button>
										
								</div>
								<!-- /panel body -->
							</div>
							<!-- /panel -->
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
					<button type="button" id="btn_pay_final" onclick ="pay()" style="width: 150px;" class="btn_pay_final btn btn-lg btn-primary">Pay</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal Pay -->




<script>
	var rowid = 1;
	var sub_total = 0;
	var jumlah_bayar_ = "";
	var txt_jumlahBayar = document.getElementById("jumlah_bayar");
	var txt_bayar = document.getElementById("txtBayar");
	var txt_kembali = document.getElementById("txtKembalian");

	$(document).ready(function(){
			// loadJumlah();
	});

	$('#exampleModal').on('shown.bs.modal', function () {
			$('#int_kategori').trigger('focus')
	})

	// Tombol Table Page
	$(document).on('click', '#link_table', function (e) {

		window.location.href = 'table.php';
	});

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

	// fungsi untuk hitung total
	function loadJumlah(subtotal) {
		var subtotal_ = "Rp "+formatRupiah(subtotal.toString() ,"");
		// if (typeof subtotal == "string") {
		// 	document.getElementById('total_pesan').innerHTML = subtotal;
		// document.getElementById('txtTotal').innerHTML = subtotal;
		// } else {
			document.getElementById('total_pesan').innerHTML = subtotal_;
		document.getElementById('txtTotal').innerHTML = subtotal_;	
		// }
		// console.log(typeof subtotal);
	}


	function loadBayar(jumlahBayar) {
		if (jumlahBayar == "") {
			jumlahBayar = '0';
		}

		txt_jumlahBayar.value = formatRupiah(jumlahBayar,"");
		txt_bayar.innerHTML = "Rp "+formatRupiah(jumlahBayar,"");
		txt_kembali.innerHTML = "Rp "+formatRupiah((jumlahBayar - sub_total).toString(),"");

		// console.log(jumlahBayar);
	}

	function delCalc() {
		var new_jumlah_bayar_ = jumlah_bayar_[jumlah_bayar_.length - 1];

		var jumlah_bayar_new = jumlah_bayar_.replace(new_jumlah_bayar_,"");
		// // console.log(jumlah_bayar_);
		// // console.log();

		// txt_jumlahBayar.value = formatRupiah(jumlah_bayar_new,"")

		// jumlah_bayar_=jumlah_bayar_new;
		// console.log(jumlah_bayar_.length);
		if (jumlah_bayar_.length==1) {
			txt_jumlahBayar.value = 0;
			jumlah_bayar_="";
			loadBayar(jumlah_bayar_);
		} else {
			txt_jumlahBayar.value = formatRupiah(jumlah_bayar_new,"")

			jumlah_bayar_=jumlah_bayar_new;
			loadBayar(jumlah_bayar_new);
		}

	}


	function tambah(rowid, harga_produk, id_produk) {
		// console.log(rowid);
		var qty = $("#jumlah"+rowid).text();
		var idOrder = <?php echo $_maxid; ?>;
		qty = parseInt(qty)+1;

		$.ajax({
				type  	: "POST",
	      		data  	: "jumlah_order="+qty+"&id_order="+idOrder+"&id_produk="+id_produk,
				url		: "order/update_jumlah.php",
				success: function (result) {
					console.log(result);					
				}
			});	
		
		
		// console.log(qty);

		
		// var total = qty*harga_produk;
		sub_total = sub_total + harga_produk;
		// console.log(sub_total);		
		document.getElementById('jumlah'+rowid).innerHTML = qty;

		loadJumlah(sub_total);
	}

	function kurang(rowid, harga_produk, id_produk) {

		var qty = $("#jumlah"+rowid).text();
		var idOrder = <?php echo $_maxid; ?>;

		

		if (qty == 1) {
			qty == 1;
			document.getElementById('jumlah'+rowid).innerHTML = 1;
		} else {
			qty = parseInt(qty)-1;
			sub_total = sub_total - harga_produk;		
			document.getElementById('jumlah'+rowid).innerHTML = qty;
		}

		$.ajax({
				type  	: "POST",
	      		data  	: "jumlah_order="+qty+"&id_order="+idOrder+"&id_produk="+id_produk,
				url		: "order/update_jumlah.php",
				success: function (result) {
					console.log(result);					
				}
			});
		
		loadJumlah(sub_total);	
	}

	function myPesan(id_produk, nama_produk, harga_produk) {

		var table = <?php echo $table; ?>;
		var idCabang = <?php echo $id_cabang_; ?>;
		var idUser = <?php echo $id_user_; ?>;
		var maxID = <?php echo $_maxid; ?>;
		// console.log(table);
		
		
		var row = "<tr id='"+rowid+"'><td width='7%'><i style='font-size: 18px; color: #2ecc71;' class='fa fa-trash' onclick='delPesan("+rowid+","+harga_produk+")'></i></td><td style='font-size: 12px; text-align: left;'>"+nama_produk.substr(0, 9)+"</td><td style='text-align: center;'><i style='font-size: 18px; color: #2ecc71;' class='fa fa-plus-circle' onclick='tambah("+rowid+","+harga_produk+","+id_produk+")'></i><span style='margin-left: 7px; margin-right: 7px;' id='jumlah"+rowid+"'>1</span><i style='font-size: 18px; color: #2ecc71;' class='fa fa-minus-circle' onclick='kurang("+rowid+","+harga_produk+","+id_produk+")'></i></td><td style='text-align: right;'>Rp. "+formatRupiah(harga_produk,"")+"</td></tr>";

		// var markup = "<tr id='" + rowid + "'><td>1</td><td>1000</td><td>1000</td><td>1</td><td><button type='button' class='delete-row btn btn-danger' data-sub='1' data-id_brg='1' data-jumlah='1000' data-row ='" + rowid + "'>Delete Row</button></td></tr>";
		if (rowid == 1) {
			$.ajax({
				type  	: "POST",
	      		data  	: "no_meja="+table+"&id_cabang="+idCabang+"&id_user="+idUser+"&grandtotal="+0,
				url		: "order/create_order.php",
				success: function (result) {
					console.log(result);					
				}
			});	
		}

		$.ajax({
				type  	: "POST",
	      		data  	: "id_order="+maxID+"&id_produk="+id_produk+"&jumlah_order="+1+"&harga_produk="+harga_produk,
				url		: "order/create_detail_order.php",
				success: function (result) {
					console.log(result);					
				}
		});	


		sub_total = sub_total + parseInt(harga_produk);
		loadJumlah(sub_total);
		$("#tbl-pesanan tbody").append(row);

		rowid = rowid + 1;
	}
	function delPesan(rowid, harga_produk) {
		// console.log(rowid);
		var qty = $("#jumlah"+rowid).text();
		var total = parseInt(qty)*harga_produk;
		sub_total = sub_total - total;

		loadJumlah(sub_total);
		$('#'+rowid).remove();
		
	}

	function calc(value) {
		// console.log(value);
		jumlah_bayar_ += value;
		loadBayar(jumlah_bayar_);
	}

	function searchProd() {
		var value = document.getElementById("txtSearch").value;
		// console.log(value);

		if (value=="") {
			$.ajax({
				url: "produks/drinks_menu.php",
				success: function (result) {
					//   console.log(result);
					document.getElementById('menu').innerHTML = result;
				}
			});

		} else {

			$.ajax({
				type  : "GET",
	      		data  : "cari="+value,
				url		: "produks/search_menu.php",
				success: function (result) {
					// console.log(result);
					//   console.log(result);

					if (result=="") {
						document.getElementById('menu').innerHTML = "<h3 class='text-center'>Menu Tidak Ditemukan</h3>";
					} else {
						document.getElementById('menu').innerHTML = result;	
					}
					
				}
			});
		}
	}

	function pay() {
		// console.log(sub_total);
		var idOrder = <?php echo $_maxid; ?>;
		var jumlahBayar = document.getElementById('jumlah_bayar');

		$.ajax({
				type  	: "POST",
	      		data  	: "grandtotal="+sub_total+"&id_order="+idOrder,
				url		: "order/update_orders.php",
				success: function (result) {
					console.log(result);
					window.location.href = 'table.php';					
				}
		});	

		// jumlahBayar.value = 0;
		
		
	}



</script>