<?php
session_start();
//fungsi already header(menangkal warnings)
ob_start();

    $path_ = realpath(__DIR__ . '/../..');
    include_once($path_ . '/init/db.php');
// include '../init/db.php';
// include "../admin_login.php";

// Sidebar
    $page_header = "laporan";
    $page_li = "pengeluaran";
    
    include '../header.php';
    include '../sidebar.php';
// if ($_SESSION['level']=='1') {
// include '../sidebar.php';
// }elseif ($_SESSION['level']=='3') {
// require '../sidebar_p.php';
// }
//$status = $_GET['status'];
require '../functions.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <h1>
    Form Laporan Pengeluaran
    <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!-- <li class="">Post</li> -->
      <li class="">Laporan</li>
      <li class="active">Laporan Pengeluaran</li>
    </ol>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <!-- <div class="box box-info"> -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <!-- <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Harian</a></li> -->
            
            <li class="active"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Bulanan</a></li>
            <!-- <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Tahunan</a></li> -->
            
          </ul>
          <div class="tab-content">
            <!-- tab Pane Bulanan -->
            <div class="tab-pane active" id="tab_3">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Option Pilih Kasir -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pilih Bulan</label>
                        <select class="form-control" name="pilih_bulan">
                          <!-- <option value="all">Semua Kasir</option> -->
                          <?php
                          $sql = "SELECT MONTH(tgl_pengeluaran) AS Bulan FROM tbl_pengeluaran WHERE YEAR(tgl_pengeluaran)=YEAR(CURDATE()) GROUP BY MONTH(tgl_pengeluaran)";
                          $run_sql = mysqli_query($conn,$sql);
                          $row_cnt = mysqli_num_rows($run_sql);
                          
                          while($rows = mysqli_fetch_assoc($run_sql)){
                            if ($rows['Bulan'] == $bulan_) {
                                $select = "selected";
                            }else{
                                $select = "";
                            } 
                            echo "<option ".$select." value='".$rows['Bulan']."'>".bulan((int)$rows['Bulan'])."</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!-- Tampilkan Pendapatan total Bulan ini -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <?php
                        $sql = "SELECT * FROM tbl_pengeluaran WHERE MONTH(tgl_pengeluaran) = MONTH(CURDATE())";
                        $run_sql = mysqli_query($conn, $sql);
                        $total_retur = 0;
                        while($rows = mysqli_fetch_assoc($run_sql)){
                        // echo "<option value='".$rows['bulan']."'>".$rows['Bulan']."</option>";
                          $total_retur = (int)$rows['jumlah_pengeluaran'] + $total_retur;
                        }
                          echo "
                          <h3>Pengeluaran Bulan ".bulan((int)date("m"))."</h3>
                          <h1>".rupiah($total_retur)."</h1>";
                        
                        ?>
                      </div>
                    </div>
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
            <!-- /.tab-pane Bulanan -->
            
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- </div> -->
      </div>
    </div>
    <!-- </div> -->
  </section>
</div>

<script>
  $(document).ready(function() {

  });


  // event lihat transaksi bulanan
  $(document).on('click', '#btnCetak-Bulan', function (e) {
    var bulan = $("[name='pilih_bulan']").val();
    var tahun = new Date();
    window.location.href = "cetak_laporan_pengeluaran.php?bulan="+bulan;
  });

   
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
  });
</script>

<?php
include '../footer.php';
?>