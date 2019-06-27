<?php
	session_start();
	// include '../tes.php';
	// include '../init/db.php';

	// DB Connection 
  	$path = realpath(__DIR__ . '/../..');
  	include_once($path . '/init/db.php');

if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
    	$query = "DELETE FROM tbl_user WHERE id_user = '$id'";
		if(mysqli_query($conn,$query)){
		   		header('Location: list_user.php');
		}else{
			die(mysqli_error());
		}
  	}else{
    	header('Location: list_user.php');
  	}

?>