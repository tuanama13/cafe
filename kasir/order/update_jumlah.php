<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Orders.php';

    $database = new Database();
    $db = $database->connect();

    $order = new Order($db);

    $order->jumlah_order = $_POST['jumlah_order'];
    $order->id_order = $_POST['id_order'];
    $order->id_produk = $_POST['id_produk'];

    if ($order->updateJumlah()){
        echo "Update Success";
    }else{
        echo "Update Cancel";
    }

