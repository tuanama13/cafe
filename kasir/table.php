<?php
    $path = realpath(__DIR__ . '/..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once 'header.php';
    include_once 'models/Cabangs.php';
    include_once 'models/Orders.php';
    include_once 'functions.php';

    $database = new Database();
    $db = $database->connect();

    $cabang = new Cabang($db);
    $result = $cabang->readJumMeja(1);

    $order = new Order($db);
	// $maxid = $order->cekLastOrder();
	$orders = $order->readOrders();

    foreach ($result as $value) {
       $jumlah_meja = $value['jumlah_meja'];
    }

    
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <?php
                for ($i=1; $i <= $jumlah_meja ; $i++) { 
                    echo "
                        <div class='col-md-4' onclick='tableOrder(\"$i\")'>
                            <div class='panel panel-default'>
                                <div class='panel-heading text-center'><h3 style='margin:5px;'>".$i."</h3></div>
                                <div class='panel-body text-center'>
                                    <img src='../dist/img/icon_table_front.png'  alt='table' style='width:120px; height:120px;'>
                                </div>
                                <!-- /panel body -->
                            </div>
                            <!-- /panel -->
                        </div>
                        <!-- /col-8 col-4 -->
                    ";
                }
            ?>          


        </div>
        <!-- /col-8 -->
        <div class="col-md-4">
            <div class='panel panel-default'>
                <div class="panel-heading">
                    <h3>Today Transaction</h3>
                </div>
                <div class='panel-body text-center' style="padding-top : 0px; padding-bottom : 0px;">
                  <?php 
                    foreach ($orders as $value_order) {
                        echo"
                        <table class='table' style='margin-bottom : 0px;'>
                            <tr>
                                <td rowspan='0' width='30%'>
                                    <h2>".$value_order['no_meja']."</h2>
                                </td>
                                <td>
                                    <h4 style='text-align:left; margin:5px;'>".rupiah($value_order['grandtotal'])."</h4>
                                </td>

                            </tr>
                            <tr>
                                <td style='text-align:left; margin:5px;'>
                                    <h5>".$value_order['tgl_order']."</h5>
                                </td>
                            </tr>
                        </table>";
                    }

                  ?>
                </div>
                <!-- /panel body -->
            </div>
            <!-- /panel -->
        </div>
        <!-- /col-4 -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->

<script>
    function tableOrder(table) {
        console.log(table);
        window.location.href = 'index.php?table='+table;
    }
</script>
<?php
    include_once 'footer.php';
?>