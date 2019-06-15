<?php
    session_start();
    //fungsi already header(menangkal warnings)
    ob_start();

    $path_ = realpath(__DIR__ . '/../..');
    include_once($path_ . '/init/db.php');

    
    // Sidebar
    $page_header = "laporan";
    $page_li = "penjualan";


    include '../header.php';
    include '../sidebar.php';
    // if ($_SESSION['level']=='1') {
    // include '../sidebar.php';
    // }elseif ($_SESSION['level']=='3') {
    // require '../sidebar_p.php';
    // }
    //$status = $_GET['status'];
    require '../functions.php';
    $path = $path_ . '/init/db.php';//'../init/db.php';
    $tgl_ =  date("Y-m-d");
    $tahun_ = date("Y");
    $bulan_ = date("m");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <h1>
    Form Laporan
    <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!-- <li class="">Post</li> -->
      <li class="">Laporan</li>
      <li class="active">Laporan Pendapatan</li>
    </ol>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <!-- <div class="box box-info"> -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Harian</a></li>
            
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Bulanan</a></li>
            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Tahunan</a></li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="row">
                <div class="col-md-12">
                
                  <div class="row">
                    <!-- Option Pilih Kasir -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pilih Kasir</label>
                        <select class="form-control" name="pilih_kasir">
                          <option value="all">Semua Kasir</option>                          
                        </select>
                      </div>
                    </div>
                    <!-- Tampilkan Pendapatan Bersih total hari ini -->
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php 
                            echo "<h4>Pendapatan Bersih</h4>";                      
                            echo "
                            <h2>".rupiah(total_harian($tgl_,3,$path))."</h2>";
                          ?>
                        </div>
                      </div>
                    </div>
                    <!-- / pendapatan bersih -->

                    <!-- Tampilkan omset hari ini -->
                    <div class="col-md-3">
                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <button type="button" id="btnLihat" class="lihat btn btn-lg btn-primary left" style="
                      ">Lihat       <span class="glyphicon glyphicon-eye-open" style="margin-left: 0.5em"></span></button>
                      <button type="button" id="btnCetak" class="pull-right btn btn-lg btn-success">Cetak      <span class="glyphicon glyphicon-print" style="margin-left: 0.5em"></span></button>
                    </div>
                  </div>
                 


                  <hr style="margin: 2em" />
                  <div class="container">
                  <div class="row">
                    <div class="col-md-12" align="center">
                      <h2>Transaksi Hari Ini</h2>
                      <h5><?php echo date("d/m/Y") ?></h5>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Kode Transaksi</th>
                            <th>Tanggal/jam</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody id="table_perkasir">
                          <tr>
                            <td colspan="3" align="center">Silahkan Pilih Kasir Dahulu</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>


                </div>
              </div>
            </div>
            <!-- /.tab-pane 1-->

            <!-- tab-pane 2 -->
            <div class="tab-pane" id="tab_3">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Option Pilih Bulan -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pilih Bulan</label>
                        <select class="form-control" name="pilih_bulan">
                          <!-- <option value="all">Semua Kasir</option> -->
                          <?php
                          $sql = "SELECT MONTH(tgl_order) AS Bulan FROM tbl_orders WHERE YEAR(tgl_order)=YEAR(CURDATE()) GROUP BY MONTH(tgl_order)";
                          $run_sql = mysqli_query($conn,$sql);
                          $row_cnt = mysqli_num_rows($run_sql);
                          
                          while($rows = mysqli_fetch_assoc($run_sql)){
                            if ($rows['Bulan'] == $bulan_) {
                              $select = "selected";
                            }else{
                              $select = "";
                            }

                            echo "<option ".$select." value='".$rows['Bulan']."' >".bulan((int)$rows['Bulan'])."</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!-- Tampilkan Pendapatan total Bulan ini -->
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body">                          
                          <?php
                            echo "<h4>Pendapatan Bersih ".bulan((int)date("m"))."</h4>";
                            echo "<h2>".rupiah(total_bulanan($tahun_,$bulan_,3,$path))."</h2>";                        
                          ?>
                        </div>
                      </div>
                    </div>
                    <!-- / pendapatan -->
                   
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <!--    <button type="button" id="btnLihat-Bulan" class="lihat-bulan btn btn-lg btn-primary left" style="
                      ">Lihat       <span class="glyphicon glyphicon-eye-open" style="margin-left: 0.5em"></span></button> -->
                      <button type="button" id="btnCetak-Bulan" class="pull-left btn btn-lg btn-success">Cetak      <span class="glyphicon glyphicon-print" style="margin-left: 0.5em"></span></button>
                    </div>
                  </div>
                  <!-- <hr style="margin: 2em" /> -->
                </div>
              </div>
            </div>
            <!-- /.tab-pane 2 -->
            <!-- tab-pane 3 -->
            <div class="tab-pane" id="tab_4">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Option Pilih Kasir -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control" name="pilih_tahun">
                          <!-- <option value="all">Semua Kasir</option> -->
                          <?php
                          $sql = "SELECT YEAR(tgl_order) AS Tahun FROM tbl_orders GROUP BY YEAR(tgl_order)";
                          $run_sql = mysqli_query($conn,$sql);
                          $row_cnt = mysqli_num_rows($run_sql);
                          
                          while($rows = mysqli_fetch_assoc($run_sql)){
                            if ($rows['Tahun'] == $tahun_) {
                                $select = "selected";
                              }else{
                                $select = "";
                              } 
                          echo "<option ".$select." value='".$rows['Tahun']."'>".$rows['Tahun']."</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!-- Tampilkan Pendapatan total Tahun ini -->
                    <div class="col-md-3">
                      <div class="panel panel-default" style="margin-right: 15px;">
                        <div class="panel-body">
                          <?php
                            echo "
                             <h4>Pendapatan Tahun ".$tahun_."</h4>
                             <h2>".rupiah(total_tahunan($tahun_,3,$path))."</h2>";

                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <!-- <button type="button" id="btnLihat-Tahun" class="lihat-tahun btn btn-lg btn-primary left" style="
                      ">Lihat       <span class="glyphicon glyphicon-eye-open" style="margin-left: 0.5em"></span></button> -->
                      <button type="button" id="btnCetak-Tahun" class="pull-left btn btn-lg btn-success">Cetak      <span class="glyphicon glyphicon-print" style="margin-left: 0.5em"></span></button>
                    </div>
                  </div>
                  <!-- <hr style="margin: 2em" /> -->
                </div>
              </div>
            </div>
            <!-- /.tab-pane 3 -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- </div> -->
      </div>
    </div>
    <!-- </div> -->
  </section>
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
<script>
  $(document).ready(function() {
  });

  $(document).on('click', '.detail', function (e) {
    var kode = $(this).attr('data-kode-tran');

    $.ajax({
      type  : "GET",
      data  : "kode="+kode,
      url   : "query_laporan_harian.php",
      success : function(result){
      // console.log(result);
      document.getElementById('table-detail').innerHTML = result;
      }
    });
  });
  // event lihat transaksi harian
  $(document).on('click', '#btnLihat', function (e) {
    var kasir = $("[name='pilih_kasir']").val();
    var waktu = '<?php echo date("Y-m-d") ;?>';

    $.ajax({
      type  : "GET",
      data  : "kasir="+kasir+"&tgl="+waktu,
      url   : "query_laporan_perkasir.php",
      success : function(result){
      // console.log(result);
      document.getElementById('table_perkasir').innerHTML = result;
      }
    });
  });
  // event lihat transaksi Harian
  $(document).on('click', '#btnCetak', function (e) {
    var kasir = $("[name='pilih_kasir']").val();
    var waktu = '<?php echo date("Y-m-d") ;?>';

    window.location.href = "cetak_laporan_perkasir.php?kasir="+kasir+"&tgl="+waktu;
  });

  // event lihat transaksi bulanan
  $(document).on('click', '#btnCetak-Bulan', function (e) {
    var bulan = $("[name='pilih_bulan']").val();
    var tahun = new Date();

    window.location.href = "cetak_laporan_bulanan.php?bulan="+bulan+"&tahun="+tahun.getFullYear();
  });

  $(document).on('click', '#btnCetak-Tahun', function (e) {
    var bulan = $("[name='pilih_tahun']").val();
    var tahun = new Date();
    // console.log(tahun.getFullYear());
    window.location.href = "cetak_laporan_tahunan.php?tahun="+bulan;

  });
  // event lihat transaksi tahunan
  $(document).on('click', '#btnLihat-Tahun', function (e) {
    var tahun = $("[name='pilih_tahun']").val();

    $.ajax({
      type  : "GET",
      data  : "tahun="+tahun,
      url   : "query_laporan_tahunan.php",
      success : function(result){
      // console.log(result);
      document.getElementById('table_pertahun').innerHTML = result;
      }
    });
  });

  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });
</script>

<?php
include '../footer.php';
?>