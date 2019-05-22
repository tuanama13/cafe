<?php
    $path = realpath(__DIR__ . '/..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once 'header.php';
    include_once 'models/Cabangs.php';
    include_once 'functions.php';

    $database = new Database();
    $db = $database->connect();

    $cabang = new Cabang($db);
    $result = $cabang->readJumMeja(1);

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
                <div class='panel-body text-center'>
                    <table class="table">
                        <tr>
                            <td rowspan="0" width="30%"><h2>7</h2></td>
                            <td><h4 style='text-align:left; margin:5px;'>Rp 50.000</h4></td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:left; margin:5px;"><h5>10/05/2019 09.00</h5></td>
                        </tr>                        
                    </table>
                    <table class="table">
                        <tr>
                            <td rowspan="0" width="30%"><h2>1</h2></td>
                            <td><h4 style='text-align:left; margin:5px;'>Rp 18.000</h4></td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:left; margin:5px;"><h5>10/05/2019 09.15</h5></td>
                        </tr>                        
                    </table>
                    <table class="table">
                        <tr>
                            <td rowspan="0" width="30%"><h2>5</h2></td>
                            <td><h4 style='text-align:left; margin:5px;'>Rp 10.000</h4></td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:left; margin:5px;"><h5>10/05/2019 09.30</h5></td>
                        </tr>                        
                    </table>
                    <table class="table">
                        <tr>
                            <td rowspan="0" width="30%"><h2>7</h2></td>
                            <td><h4 style='text-align:left; margin:5px;'>Rp 9.000</h4></td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:left; margin:5px;"><h5>10/05/2019 09.30</h5></td>
                        </tr>                        
                    </table>
                    <table class="table">
                        <tr>
                            <td rowspan="0" width="30%"><h2>10</h2></td>
                            <td><h4 style='text-align:left; margin:5px;'>Rp 5.000</h4></td>
                            
                        </tr>
                        <tr>
                            <td style="text-align:left; margin:5px;"><h5>10/05/2019 09.30</h5></td>
                        </tr>                        
                    </table>
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