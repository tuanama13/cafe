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
    Daftar Retur
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i> Home</a></li>
      <li class="">Retur</li>
      <li class="active">Daftar Retur</li>
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
          <h1 class="box-title">Daftar Retur
          <!-- <small>List Barang-Barang yang Sudah Dimasukan</small> -->
          </h1>
          <a href="retur.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Tambah <small>( Shift + X )</small></a>
          <a href="../laporan/cetak_laporan_retur.php" class="btn btn-success pull-right"  style="margin-right: 5px"><i class="fa fa-print"></i> Cetak</a>
        </div>
        <!-- <div class="col-md-12" style="margin-bottom: 20px">
          <h2><a href="#" data-toggle="tooltip" data-placement="top" title="Berdasarkan jumlah stok x harga modal">
            Aset Saat ini:
          </a></h2> -->

            <?php
            	// $sql = "SELECT * FROM tbl_retur";
             //    $run_sql = mysqli_query($conn,$sql);
             //    // $row = mysqli_fetch_assoc($run_sql);
             //    $hitung_aset = 0;
             //    while($rows = mysqli_fetch_assoc($run_sql)){
             //    	$hitung_aset = ((int)$rows['harga_beli'] * (int)$rows['stok']) + $hitung_aset;
             //    }

             //    // $aset_ = ((int)$row['Modal'] * (int)$row ['Stok']);

             //    echo "<h1>".rupiah($hitung_aset)."</h1>";
            ?>		  	
		  	
		  <!-- </div> -->
		 
          <!-- /.box-header -->
          <div class="box-body pad">
            <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <!-- <th>Kode Retur</th> -->
                  <th>Tanggal Retur</th>
                  <th>Kode Transaksi</th>
                  <th>Nama Barang</th>
                  <!-- <th>Harga Beli</th> -->
                  <th>Harga Jual</th>
                  <th>Jumlah</th>
                  <th><></th>
                  <!-- <th colspan="2" style="text-align: center">Action</th> -->
                </tr>
              </thead>
              <tbody>
                
                <?php
                $sql = "SELECT * FROM tbl_retur JOIN tbl_brg USING(id_barang) WHERE status_retur = 1";
                $run_sql = mysqli_query($conn,$sql);
                $no=1;
                while($rows = mysqli_fetch_assoc($run_sql)){
                // $id = $rows['id_brg'];
                echo "
                <tr>
                  <td>".$no."</td>
                  
                  <td>$rows[tgl_faktur]</td>
                  <td>$rows[id_transaksi]</td>
                  <td>$rows[nama_barang]</td>
                  <td style='text-align:right'>".rupiah($rows['harga_jual'])."</td>
                  <td>$rows[jumlah]</td>
                  
                  
                  <td><a onclick=\"return confirm('Anda Yakin Akan Melakukan Retur?')\" href='update_status.php?id_b=$rows[id_barang]&amp;id=$rows[id_faktur]&amp;jumlah=$rows[jumlah]' class='btn btn-info'><span class='fa fa-pen'></span></a></td>
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
    window.location.href ="/tb/retur/retur.php";
  });
</script>

<?php
include '../footer.php';
?>