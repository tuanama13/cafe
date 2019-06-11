<?php  
	$path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Orders.php';
    include_once '../functions.php';

    $database = new Database();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readOrders();

    foreach ($result as $value) {

        echo"
        <table class='table' style='margin-bottom : 0px;'>
            <tr>
                <td rowspan='0' width='30%'>
                    <h2>".$value['no_meja']."</h2>
                </td>
                <td>
                    <h4 style='text-align:left; margin:5px;'>".$value['grandtotal']."</h4>
                </td>

            </tr>
            <tr>
                <td style='text-align:left; margin:5px;'>
                    <h5>".$value['tgl_order']."</h5>
                </td>
            </tr>
        </table>";

        // echo ""
        //     .$value['id_order']."<br>"
        //     .$value['no_meja']."<br>"
        //     .$value['id_cabang']."<br>"
        //     .$value['id_user']."<br>"
        //     .$value['tgl_order']."<br>"
        //     .$value['grandtotal']."<br>"
        //     .$value['logs']."<br>
        // ";
    }
?>