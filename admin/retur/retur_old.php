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
    RETUR BARANG RUSAK
    <small>Form Retur Barang Rusak</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="">Retur</li>
      <li class="">Retur Rusak</li>
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
            <h3 class="box-title">Retur Barang Rusak
            <small></small>
            </h3>
             </div>
          <!-- /.box-header -->
          <div class="box-body pad">
            <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Transaksi</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Jumlah</th>
                  <th><></th>
                  <th><></th>
                  <!-- <th colspan="2" style="text-align: center">Action</th> -->
                </tr>
              </thead>
              <tbody>
                
                <?php
                $sql = "SELECT * FROM tbl_detail_transaksi JOIN tbl_brg USING(id_barang)";
                $run_sql = mysqli_query($conn,$sql);

                $sql2 = "SELECT * FROM tbl_brg";
                $run_sql2 = mysqli_query($conn,$sql2);
                while($rows = mysqli_fetch_assoc($run_sql) AND $rows2 = mysqli_fetch_assoc($run_sql2)){
                // $id = $rows['id_brg'];
                	if ($rows['jumlah']!=1) {
                		$teks = "<a href='edit_retur.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]' class='btn btn-info'><span class='fa fa-pencil'></span></a>";
                	}else{
                		$teks ="";
                	}
                echo "
                <tr>
                  <td>$rows[id_transaksi]</td>
                  <td>$rows[nama_barang]</td>
                  <td style='text-align:right'>".rupiah($rows['harga_beli'])."</td>
                  <td style='text-align:right'>".rupiah($rows['harga_jual'])."</td>
                  <td>$rows[jumlah]</td>               
                  <td>".$teks."</td>
                  <td><a onclick=\"return confirm('Yakin Hapus?')\"href='delete_retur.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                </tr>
                ";
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
$('#example').DataTable();
} );
$('#myModal').on('shown.bs.modal', function () {
$('#myInput').focus()
});
</script>

<?php
include '../footer.php';
?>