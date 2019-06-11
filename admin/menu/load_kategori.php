<?php
	// include '../init/db.php';
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');
	
	$sql = "SELECT * FROM tbl_kategori";
	$run_sql = mysqli_query($conn,$sql);
	$row_cnt = mysqli_num_rows($run_sql);

	echo "<select id='kategori_item' name='kategori' class='form-control' required>";
	while($rows = mysqli_fetch_assoc($run_sql)){
		
		echo "<option value='".$rows['id_kat']."' >".$rows['nama_kat']."</option>";
	}
	echo "</select>";