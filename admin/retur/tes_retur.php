<?php  
ob_start();
include '../init/db.php';
require '../functions.php';
		
		$total_baru = (1 * 6000);
		$id_t = 'INV19010006';

		$query_transaksi = mysqli_query($conn,"SELECT grandtotal, total_harga_jual FROM tbl_transaksi WHERE id_transaksi='$id_t'");
		$rows_transaksi = mysqli_fetch_assoc($query_transaksi);

		// $grandtotal = $rows_transaksi['grandtotal'];
		// $total_jual = $rows_transaksi['total_harga_jual'];

		$total_jual_baru = ((int)$rows_transaksi['total_harga_jual'] - (int)$total_baru);
		$grandtotal_baru = ((int)$rows_transaksi['grandtotal'] - (int)$total_baru);
		// $query_retur = "INSERT INTO tbl_retur SET stok = '$jumlah_stok' WHERE id_barang = '$id_b'";

		echo $grandtotal_baru." ".$total_jual_baru;
	   	

		$query_update = "UPDATE tbl_transaksi SET total_harga_jual = '$total_jual_baru', grandtotal = '$grandtotal_baru' WHERE id_transaksi = '$id_t'";

		if (mysqli_query($conn,$query_update)) {
				// header('Location: list_barang.php');
			}else{
				echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Bermasalah (Pastikan ID Barang Belum Terdaftar Pada List Barang !!)</h4>'.mysqli_error($conn).'</div>';
			}


?>