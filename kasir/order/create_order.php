<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Orders.php';

    $database = new Database();
    $db = $database->connect();

    $order = new Order($db);
    // $result = $order->createOrder();

    $order->no_meja = $_POST['no_meja'];
    $order->id_cabang = $_POST['id_cabang'];
    $order->id_user = $_POST['id_user'];
    // $order->tgl_order = "2019-06-11 18:00:00";
    $order->grandtotal = $_POST['grandtotal'];;
    $order->logs = 1;

    if ($order->createOrder()){
        echo "success";
    }else{
        echo "cancel";
    }