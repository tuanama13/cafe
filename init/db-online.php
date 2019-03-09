<?php  
	$server = '139.99.114.112';
	$user = 'ofieldwe_atk-adm';
	$pass = 'merdekastudio';
	$dbase = 'ofieldwe_atk';

	$conn = mysqli_connect($server, $user, $pass, $dbase);

	if(!$conn){
		die("Koneksi Gagal : ".mysqli_connect_error());
	}
?>