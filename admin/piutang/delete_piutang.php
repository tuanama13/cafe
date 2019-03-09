<?php  
	include '../init/db.php';

if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
    	$query = "DELETE FROM tbl_piutang WHERE kode_piutang = '$id'";
		if(mysqli_query($conn,$query)){
		   		header('Location: list_piutang.php');
		}else{
			die(mysqli_error());
		}
  	}else{
    	header('Location: list_piutang.php');
  	}

?>