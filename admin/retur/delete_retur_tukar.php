<?php  
	include '../init/db.php';
	

	if (isset($_GET['id_t'])) {
    	$id_b = mysqli_real_escape_string($conn,$_GET['id_b']);
    	$id_t = mysqli_real_escape_string($conn,$_GET['id_t']);
    	$jumlah = mysqli_real_escape_string($conn,$_GET['jumlah']);

    	$query_dt = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi WHERE id_transaksi = '$id_t' AND id_barang='$id_b'");
		$rows_dt = mysqli_fetch_assoc($query_dt);
		// $jumlah = $rows_dt['jumlah'];
		$harga_jual = $rows_dt['harga_jual'];
		$harga_beli = $rows_dt['harga_beli'];

		$query_brg = mysqli_query($conn,"SELECT stok FROM tbl_brg WHERE id_barang='$id_b'");
		$rows_brg = mysqli_fetch_assoc($query_brg);

		$stok_baru = (int)$rows_brg['stok']-(int)$jumlah;


		// $query_transaksi = mysqli_query($conn,"SELECT grandtotal, total_harga_beli, total_harga_jual FROM tbl_transaksi WHERE id_transaksi='$id_t'");
		// $rows_transaksi = mysqli_fetch_assoc($query_transaksi);
		// $harga_beli_baru = ((int)$jumlah*(int)$harga_beli); 
		// $total_baru = ((int)$jumlah*(int)$harga_jual);
		// // $grandtotal = $rows_transaksi['grandtotal'];
		// // $total_jual = $rows_transaksi['total_harga_jual'];
		// $total_harga_beli_baru = ((int)$rows_transaksi['total_harga_beli'] - (int)$harga_beli_baru);
		// $total_jual_baru = ((int)$rows_transaksi['total_harga_jual'] - (int)$total_baru);
		// $grandtotal_baru = ((int)$rows_transaksi['grandtotal'] - (int)$total_baru);

		// print_r($_GET);	

    	$query2 = "INSERT INTO tbl_retur(id_transaksi, id_barang, harga_beli, harga_jual, jumlah,status_retur) VALUES('$id_t','$id_b', '$harga_beli', '$harga_jual','$jumlah','1')";
    	$query_barang = "UPDATE tbl_brg SET stok = '$stok_baru' WHERE id_barang = '$id_b'";
    	

    	
	   		if(mysqli_query($conn,$query2)){

	   			if(mysqli_query($conn, $query_barang)){
	   				header('Location: retur.php?status=sukses');
	   			}else {
	   				echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Update Barang bermasalah '.mysqli_error($conn).'</h4></div>';
	   			}
			   
		   	}else{
		   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Retur bermasalah '.mysqli_error($conn).'</h4></div>';
		   	}
	   	



  	}else{
    	echo '<div class="alert alert-danger" style="text-align:center"><h4>Delete Bermasalah'.mysqli_error($conn).'</h4></div>';
  	}
?>