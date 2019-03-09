<?php
	include '../init/db.php';
	if (isset($_GET['id'])) {
    	$id = mysqli_real_escape_string($conn,$_GET['id']); 
    	$id_b = mysqli_real_escape_string($conn,$_GET['id_b']); 
    	$jumlah = mysqli_real_escape_string($conn,$_GET['jumlah']);

    	$query_barang = mysqli_query($conn,"SELECT stok FROM tbl_brg WHERE id_barang='$id_b'");
		$rows_barang = mysqli_fetch_assoc($query_barang);

		$stok_baru = (int)$rows_barang['stok']+(int)$jumlah;  

		$sql_retur = mysqli_query($conn,"UPDATE tbl_retur SET status_retur = 0 WHERE id_faktur = '$id'");
		$sql_barang = mysqli_query($conn,"UPDATE tbl_brg SET stok = '$stok_baru' WHERE id_barang = '$id_b'");
		

		if($sql_barang){
			if($sql_retur){
		   		header('Location: list_retur.php?status=sukses');
			}else{
				echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Retur bermasalah!. '.mysqli_error($conn).'</h4></div>';
			}
		}else {
				echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Barang bermasalah!. '.mysqli_error($conn).'</h4></div>';
		}
	}
?>