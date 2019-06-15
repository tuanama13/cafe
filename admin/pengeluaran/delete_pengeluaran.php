<?php  
	$path = realpath(__DIR__ . '/../..');
    include_once($path . '/init/db.php');
	// include '../init/db.php';
//	include "../admin_login.php";
	
//	if (isset( $_GET['id'])) {
//    	$id = $_GET['id'];
//    	$query = "UPDATE tbl_brg SET del = 1 WHERE id_brg = '$id'";
//		if(mysqli_query($conn,$query)){
//		   		header('Location: list_barang.php');
//		}else{
//			die(mysqli_error());
//		}
//  	}else{
//    	header('Location: list_barang.php');
//  	}


if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
    	$query = "DELETE FROM tbl_pengeluaran WHERE id_pengeluaran = '$id'";
		if(mysqli_query($conn,$query)){
		   		header('Location: list_pengeluaran.php');
		}else{
			die(mysqli_error());
		}
  	}else{
    	header('Location: list_pengeluaran.php');
  	}




	//$id =$_GET['id'];
	// mysql_query("UPDATE FROM posts WHERE post_id = '$id'") or die(mysql_error());

?>