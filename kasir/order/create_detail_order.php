<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Orders.php';

    $database = new Database();
    $db = $database->connect();

    $order = new Order($db);
    // $result = $order->createOrder();

    $order->id_order = $_POST['id_order'];
    $order->id_produk = $_POST['id_produk'];
    $order->jumlah_order = $_POST['jumlah_order'];
    // $order->tgl_order = "2019-06-11 18:00:00";
    $order->harga_produk = $_POST['harga_produk'];
    // $order->logs = 1;

    if ($order->createDetailOrder()){
        echo "success";
    }else{
        echo "cancel";
    }