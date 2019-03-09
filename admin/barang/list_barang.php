<?php
session_start();
//fungsi already header(menangkal warnings)
ob_start();
include '../init/db.php';
require '../functions.php';
// include "../admin_login.php";
include '../header.php';
include '../sidebar.php';
//$status = $_GET['status'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Barang
    <!-- <small>Daftar Barang</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i> Home</a></li>
      <li class="">Barang</li>
      <li class="active">Daftar Barang</li>
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
          <div class="box-header" style="margin-bottom: 30px;">
            <h1 class="box-title" style="padding-left: 7px;">Daftar Barang
            <!-- <small>List Barang-Barang yang Sudah Dimasukan</small> -->
            </h1>
            <a href="barang.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Tambah Barang <small>( Shift + X )</small></a>
            <a href="../laporan/cetak_laporan_barang.php" class="btn btn-success pull-right"  style="margin-right: 5px"><i class="fa fa-print"></i> Cetak</a>
          </div>
          
          <!-- Jumlah Aset -->
          <div class="col-md-4" style="margin-bottom:20px">

            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Berdasarkan jumlah stok x harga modal">
                    Aset Saat ini
                  </a>
                </h3>
              </div>
              <div class="panel-body">
                <?php
                  $sql = "SELECT * FROM tbl_brg";
                    $run_sql = mysqli_query($conn,$sql);
                    // $row = mysqli_fetch_assoc($run_sql);
                    $hitung_aset = 0;
                    while($rows = mysqli_fetch_assoc($run_sql)){
                      $hitung_aset = ((int)$rows['harga_beli'] * (int)$rows['stok']) + $hitung_aset;
                    }

                    // $aset_ = ((int)$row['Modal'] * (int)$row ['Stok']);

                    echo "<h2>".rupiah($hitung_aset)."</h2>";
                ?>
              </div>
            </div>
		      </div>		 
           <!-- / Jumlah Aset -->
          <div class="col-md-4" style="margin-bottom:20px">

            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Jumlah Keseluruhan Barang">
                    Total Item
                  </a>
                </h3>
              </div>
              <div class="panel-body">
                <?php
                  $sql = "SELECT COUNT(id_barang) AS Item FROM tbl_brg";
                    $run_sql = mysqli_query($conn,$sql);
                    $hitung_aset = 0;
                    $rows = mysqli_fetch_assoc($run_sql);
                    echo "<h2>".$rows['Item']."</h2>";
                ?>
              </div>
            </div>
          </div>  


          <div class="col-md-4" style="margin-bottom:20px">

            <div class="panel panel-danger">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Stok Total Di Toko">
                    Stok Total Toko
                  </a>
                </h3>
              </div>
              <div class="panel-body">
                <?php
                  $sql = "SELECT stok FROM tbl_brg";
                    $run_sql = mysqli_query($conn,$sql);
                    // $row = mysqli_fetch_assoc($run_sql);
                    $hitung_aset = 0;
                    while($rows = mysqli_fetch_assoc($run_sql)){
                      $hitung_aset = (int)$rows['stok'] + $hitung_aset;
                    }

                    // $aset_ = ((int)$row['Modal'] * (int)$row ['Stok']);

                    echo "<h2>".$hitung_aset."</h2>";
                ?>
              </div>
            </div>
          </div>     
          <!-- /.box-header -->
          <div class="box-body pad" style="margin-top:180px;padding-left: 20px;">
            <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Stok</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Satuan</th>
                  <th>Supplier</th>
                  <th><></th>
                  <th><></th>
                  <!-- <th colspan="2" style="text-align: center">Action</th> -->
                </tr>
              </thead>
              <tbody>
                
                <?php
                $sql = "SELECT * FROM tbl_brg";
                $run_sql = mysqli_query($conn,$sql);
                $no=1;
                while($rows = mysqli_fetch_assoc($run_sql)){
                // $id = $rows['id_brg'];
                echo "
                <tr>
                  <td>".$no."</td>
                  <td>$rows[id_barang]</td>
                  <td>$rows[nama_barang]</td>
                  <td>$rows[stok]</td>
                  <td style='text-align:right'>".rupiah($rows['harga_beli'])."</td>
                  <td style='text-align:right'>".rupiah($rows['harga_jual'])."</td>
                  <td>$rows[satuan]</td>
                  <td>$rows[supplier]</td>
                  
                  <td><a href='update_barang.php?id=$rows[id_barang]' class='btn btn-info'><span class='fa fa-pen'></span></a></td>
                  <td><a onclick=\"return confirm('Yakin $rows[nama_barang] diHapus?')\"href='delete_barang.php?id=$rows[id_barang]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                </tr>
                ";
                $no = $no+1;
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
      "paging": false,
       "dom": '<"pull-left"f>t'
    });
    $('[data-toggle="tooltip"]').tooltip();
  });

//   $(document).keydown(function(evt){
//     if (evt.keyCode==83 && (evt.ctrlKey)){
//         evt.preventDefault();
//         alert('worked');
//     }
// });

  shortcut.add("Shift+X",function() {
    // alert("Hi there!");
    window.location.href ="/tb/barang/barang.php";
  });
  
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });
</script>

<?php
include '../footer.php';
?>