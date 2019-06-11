<?php 
	// include '../init/db.php';
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');

	$kode = isset( $_POST['kategori']) ? $_POST['kategori'] : null;

	if (!empty($kode)) {
    	$sql = mysqli_query($conn,"INSERT INTO tbl_kategori(nama_kat,desc_kat,logs) VALUES('$kode','none','1')");
    	echo $sql;
	}else{
    	header("Location: /cafe/admin/index.php");
  	}