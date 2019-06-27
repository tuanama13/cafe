<?php  
	// include '../init/db.php';
	session_start();
	// include '../tes.php';

	// DB Connection 
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');

	$id =$_GET['id'];

	$query = "DELETE FROM tbl_pegawai WHERE id_pegawai = '$id'";
	if(mysqli_query($conn,$query)){
	   		header('Location: list_karyawan.php');
	}else{
		die(mysqli_error());
	}
?>