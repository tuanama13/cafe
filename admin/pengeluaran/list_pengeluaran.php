<?php
    session_start();
    //fungsi already header(menangkal warnings)
    ob_start();
    // include '../init/db.php';
    $path = realpath(__DIR__ . '/../..');
    include_once($path . '/init/db.php');
    
    // Sidebar Menu
    $page_header = "pengeluaran";
    $page_li = "daftar_penge";


    require '../functions.php';
    // include "../admin_login.php";
    include '../header.php';
    include '../sidebar.php';
    //$status = $_GET['status'];
    $date = date("Y-m-d");
    $month = date("m");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Pengeluaran
    <small>Form Pengeluaran</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i> Home</a></li>
      <li class="">Pengeluaran</li>
      <li class="active">List pengeluaran</li>
    </ol>
  </section>
  <?php
  if (isset($_GET['status'])) {
  echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
    Data Berhasil diupdate.
  </div>';
  }
  ?>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Pengeluaran
            <!-- <small>List Barang-Barang yang Sudah Dimasukan</small> -->
            </h3>
            <a href="pengeluaran.php" class="btn btn-info pull-right" style="margin-left: 5px;"><i class="fa fa-plus"></i> Tambah <small>( Shift + X )</small></a>
            <!-- <a href="../laporan/cetak_laporan_pengeluaran.php" class="btn btn-success pull-right"><i class="fa fa-print"></i> Cetak Pengeluaran</a> -->
            
          </div>
          <!-- /.box-header -->
          <div class="box-body pad">
            <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style='text-align: center;'>No</th>
                  <th style="text-align: center;">Tanggal Pengeluaran</th>
                  <th>Keterangan Pengeluaran</th>
                  <th style="text-align: center;">Jumlah Pengeluaran</th>
                  <!-- <th><></th> -->
                  <th>Delete</th>
                  <!-- <th colspan="2" style="text-align: center">Action</th> -->
                </tr>
              </thead>
              <tbody>
                
                <?php
                $no = 1;
                $sql = "SELECT * FROM tbl_pengeluaran WHERE MONTH(tgl_pengeluaran) = '$month' ORDER BY DATE(tgl_pengeluaran) DESC";
                $run_sql = mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_assoc($run_sql)){
                // $id = $rows['id_brg'];
                echo "
                <tr>
                  <td style='text-align: center;'>$no</td>
                  <td style='text-align: center;'>$rows[tgl_pengeluaran]</td>
                  <td>$rows[ket_pengeluaran]</td>
                  <td style='text-align:right'>".rupiah($rows['jumlah_pengeluaran'])."</td>               
                  
                 
                  <td><a onclick=\"return confirm('Yakin $rows[ket_pengeluaran] diHapus?')\"href='delete_pengeluaran.php?id=$rows[id_pengeluaran]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                </tr>
                ";
                $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    $('#example').DataTable({
       "order":false,
       "paging": false,
       "dom": '<"pull-left"f>t'
    });
  });

  shortcut.add("Shift+X",function() {
    // alert("Hi there!");
    window.location.href ="/tb/pengeluaran/pengeluaran.php";
  });
</script>

<?php
include '../footer.php';
?>