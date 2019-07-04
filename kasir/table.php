<?php
    header_remove();
    ob_start();
    // session_start();
    $path = realpath(__DIR__ . '/..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once 'header.php';
    include_once 'models/Cabangs.php';
    include_once 'models/Orders.php';
    include_once 'functions.php';
    // include_once 'cek.php';

    // if(empty($_SESSION)){
	// 	header('Location:../index.php');
	// }else {
	// 	if ($_SESSION['role_user']!='Kasir') {
	// 	    header('Location:../index.php');
	// 	    // header_remove("Location: table.php"); 
    //     }
    // }



    include_once 'navbar.php';

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
                        <div class='col-md-3' onclick='tableOrder(\"$i\")'>
                            <div class='panel panel-default'>
                                <div class='panel-heading text-center' style='background-color:white;padding-top:5px;padding-bottom:5px;'><h2 style='margin:5px;'>".$i."</h2></div>
                                <div class='panel-body text-center'>
                                    <img src='../dist/img/icon_table_front.png'  alt='table' style='width:100px; height:100px;'>
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
                <div class="panel-heading" style='background-color:white;'>
                    <div class="row">
                    <div class="col-md-8"><h4>Today Transaction</h4></div>
                    <div class="col-md-4"><h5><a href="transaksi.php">See all >></a></h5></div>
                    </div>
                </div>
                <div class='panel-body text-center' style="padding-top : 0px; padding-bottom : 0px;">
                  <?php 
                    foreach ($orders as $value_order) {
                        echo"
                        <table data-toggle='modal' data-target='#myModal' onclick='detailOrder(".$value_order['id_order'].")' class='table' style='margin-bottom : 0px;'>
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

    <!-- Modal Detail Transaksi -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Detail Transaksi</h4>
        </div>
        <div class="modal-body" id="table-detail">
            
        </div>
        </div>
    </div>
    </div>
    <!-- End Modal Detail Transaksi -->

</div>
<!-- /container -->

<script>

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

    function tableOrder(table) {
        console.log(table);
        window.location.href = 'index.php?table='+table;
    }

    function detailOrder(id_order) {
        console.log(id_order);
        var kode = id_order;        
        $.ajax({
            type  : "GET",
            data  : "kode="+kode,
            url   : "detail_order.php",
            success : function(result){
                // console.log(result);
                document.getElementById('table-detail').innerHTML = result;
            }
        });
    }
</script>
<?php
    include_once 'footer.php';
?>