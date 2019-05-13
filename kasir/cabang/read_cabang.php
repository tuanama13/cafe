<?php  
	$path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Cabangs.php';
    include_once '../functions.php';

    $database = new Database();
    $db = $database->connect();

    $cabang = new Cabang($db);
    $result = $cabang->readCabangs();

    foreach ($result as $value) {
        echo ""
            .$value['id_cabang']."<br>"
            .$value['nama_cabang']."<br>"
            .$value['alamat_cabang']."<br>"
            .$value['jumlah_meja']."<br>"
            .$value['id_user']."<br>"
            .$value['logs']."<br>
        ";
    }
?>