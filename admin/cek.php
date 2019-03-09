<?php
	session_start();
	$_SESSION['username'] = $_GET['set1'];
	// $_SESSION['id_karyawan'] = $_GET['set2'];
	$_SESSION['level'] = $_GET['set3'];

	// $level = $_GET['set3'];
	// echo $level;

	// echo $_SESSION['level'];
	if ($_GET['set3'] == '1') {
		// header("Location : http://demo.ofield.web.id/atk/admin.php");
		header("Location: index.php");
		// echo "1";
	} else if ($_GET['set3'] == '2') {
		// header("Location : http://demo.ofield.web.id/atk/kasir.php");
		header("Location: kasir.php");
		// echo "2";
	}else if ($_GET['set3'] == '3') {
		// header("Location : http://demo.ofield.web.id/atk/pimpinan.php");
		header("Location: index_p.php");
		// echo "3";
	}
?>
