<?php 
	include '../init/db.php';

	$kode = isset( $_POST['kategori']) ?  strtoupper($_POST['kategori']) : null;

	if (!empty($kode)) {
    	$sql = mysqli_query($conn,"INSERT INTO tbl_kategori(nama_kat) VALUES('$kode')");
    	echo $sql;
	}else{
    	header("Location: /tb/index.php");
  	}