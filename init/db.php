<?php
	date_default_timezone_set("Asia/Jakarta");  
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$dbase = 'botanical';

	$conn = mysqli_connect($server, $user, $pass, $dbase);

	if(!$conn){
		die("Koneksi Gagal : ".mysqli_connect_error());
	}
?>