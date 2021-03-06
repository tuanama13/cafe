<?php
	
	// if(empty($_SESSION)){
	// 	header('Location:../index.php');
	// }else {
	// 	if ($_SESSION['role_user']!='Kasir') {
	// 	header('Location:../index.php');
	// 	}
	// }
	include_once 'cek.php';
	

	include_once 'models/Karyawans.php';
	$database = new Database();
	$db = $database->connect();

	$peg = new Karyawan($db);
	$result = $peg->readKaryawan($_SESSION['id_peg']);
	$row = $result->fetch(PDO::FETCH_ASSOC); 

?>
<!-- Header Navbar -->
<nav class="navbar navbar-light bg-green">
	<!-- <a href="" class="navbar-brand">Navbar</a> -->
	<div class="container">		
		<a class="navbar-brand" href="index.php">
				<!-- <img src="assets/img/ico.png" width="30" height="30" class="d-inline-block align-top" alt=""> -->
				Inland Cafe
		</a>

		<div class="account pull-right">
			<img src="../dist/img/ico_table.svg" id="link_table" style="width: 30px; height: 30px;  margin-right: 20px; fill: white;">

			<img src="../dist/img/ico_coffee.png" class="img-avatar" alt="avatar">
			<div class="btn-group" style="margin-top:7px;">			

				<button type="button" class="btn btn-default bg-green account-menu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $row['nama_pegawai'] ?> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right" style="margin-top:10px;">
					<li><a href="#"><i class="fas fa-address-card"></i><?php echo $row['nama_pegawai'] ?></a></li>
					<li role="separator" class="divider"></li>
					<li><a href="/cafe/logout.php" class="btn btn-default btn-flat"><i class="fas fa-power-off"></i>LogOut</a></li>
				</ul>
			</div>
		</div>
		<!-- /account -->
		
	</div>	
</nav>