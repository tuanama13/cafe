<?php
    $path = realpath(__DIR__ . '/..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once 'header.php';
    include_once 'models/Cabangs.php';
    include_once 'models/Orders.php';
    include_once 'functions.php';
    include_once 'navbar.php';

    $database = new Database();
    $db = $database->connect();

    $order = new Order($db);
	// $maxid = $order->cekLastOrder();
	$orders = $order->readOrdersAll();
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
             <div class='panel panel-default'>
                 <div class='panel-heading text-center'>
                     <h3 style='margin:5px;'><h4 style="text-align:left;">Semua Transaksi</h4></h3>
                 </div>
                 <div class='panel-body text-center'>
                     <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0"
                         width="100%">
                         <thead>
                             <tr>
                                 <th style="text-align:center;">No</th>
                                 <th style="text-align:center;">Kode Transaksi</th>
                                 <!-- <th>Kode Menu</th> -->
                                 <th style="text-align:center;">Tanggal Order</th>
                                 <th style="text-align:center;">Nomor Meja</th>
                                 <th style="text-align:center;">Grandtotal</th>
                                 <!-- <th colspan="2" style="text-align: center">Action</th> -->
                             </tr>
                         </thead>
                         <tbody>

                             <?php
                                $no=1;
                                foreach ($orders as $value_all) {
                                    echo "
                                        <tr data-toggle='modal' data-target='#myModal' onclick='detailOrder(".$value_all['id_order'].")'>
                                            <td>".$no."</td>
                                            <td>#".$value_all['id_order']."</td>
                                            <td>".$value_all['tgl_order']."</td>
                                            <td>".$value_all['no_meja']."</td>
                                            <td>".rupiah($value_all['grandtotal'])."</td>
                                        </tr>";
                                        $no++;    
                                }
                            ?>
                         </tbody>
                     </table>
                 </div>
                 <!-- /panel body -->
             </div>
             <!-- /panel -->
        </div>
    </div>
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
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

    $(document).ready(function () {
        $('#example').DataTable({
            "paging": false,
            "dom": '<"pull-left"f>t'
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

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