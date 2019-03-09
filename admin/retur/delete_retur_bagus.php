<?php  
	include '../init/db.php';

	if (isset( $_GET['id_t'])) {
	
    	$id_b = $_GET['id_b'];
    	$id_t = $_GET['id_t'];
    	//$jum = $_GET['jum'];


		$queryX = mysqli_query($conn,"SELECT * FROM tbl_brg WHERE id_barang= '$id_b'");
		$rowsX = mysqli_fetch_assoc($queryX);

		$query_detail_transaksi = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi WHERE id_transaksi = '$id_t' AND id_barang= '$id_b'");
		$rows_detail_transaksi = mysqli_fetch_assoc($query_detail_transaksi);

		$harga_beli = $rows_detail_transaksi['harga_beli'];
		$harga_jual = $rows_detail_transaksi['harga_jual']; 

    	$jum = $rows_detail_transaksi['jumlah'];
    	$stok = $rowsX['stok'];
    	$jumlah = $jum+$stok;


    	$query_transaksi = mysqli_query($conn,"SELECT grandtotal, total_harga_beli, total_harga_jual FROM tbl_transaksi WHERE id_transaksi='$id_t'");
		$rows_transaksi = mysqli_fetch_assoc($query_transaksi);
		$harga_beli_baru = ((int)$jum*(int)$harga_beli); 
		$total_baru = ((int)$jum*(int)$harga_jual);
		// $grandtotal = $rows_transaksi['grandtotal'];
		// $total_jual = $rows_transaksi['total_harga_jual'];
		$total_harga_beli_baru = ((int)$rows_transaksi['total_harga_beli'] - (int)$harga_beli_baru);
		$total_jual_baru = ((int)$rows_transaksi['total_harga_jual'] - (int)$total_baru);
		$grandtotal_baru = ((int)$rows_transaksi['grandtotal'] - (int)$total_baru);

		$query2 = "UPDATE tbl_brg SET stok = '$jumlah' WHERE id_barang = '$id_b'";
    	$query = "DELETE FROM tbl_detail_transaksi WHERE id_transaksi = '$id_t' AND id_barang= '$id_b'";
    	$query_update = "UPDATE tbl_transaksi SET total_harga_beli = '$total_harga_beli_baru', total_harga_jual = '$total_jual_baru', grandtotal = '$grandtotal_baru' WHERE id_transaksi = '$id_t'";

		if(mysqli_query($conn,$query)){
	   		if(mysqli_query($conn,$query2)){
	   			if(mysqli_query($conn,$query_update)){
	   				header('Location: retur_bagus.php?status=sukses, stok telah ditambah');
			   	}else{
			   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Update Pada Transaksi bermasalah</h4>. '.mysqli_error($conn).'</div>';
			   	}	
		   	}else{
		   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Stok bermasalah '.mysqli_error($conn).'</h4></div>';
		   }
	   	}else{
	   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Transaksi Bermasalah'.mysqli_error($conn).'</h4></div>';
	   	}


  	}else{
    	header('Location: retur_bagus.php');
  	}




	//$id =$_GET['id'];
	// mysql_query("UPDATE FROM posts WHERE post_id = '$id'") or die(mysql_error());

?>