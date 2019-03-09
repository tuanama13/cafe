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
      <li><i class="fa fa-home"></i> Home</a></li>
      <li class="">Retur</li>
      <li class="active">Retur Rusak</li>
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
        <!-- <div class="box box-info"> -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active bg-primary"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Tukar Barang</strong></a></li>
            
            <li class="bg-danger"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><strong>Kembali Uang</strong></a></li>

            
          </ul>
          <div class="tab-content">
            <!-- tab-pane 1 -->
            <div class="tab-pane active" id="tab_1">
              <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                  <h3>Retur Tukar Barang</h3>
                </div>
                <div class="col-md-12">
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
                      $sql_1 = "SELECT * FROM tbl_detail_transaksi JOIN tbl_brg USING(id_barang) WHERE jumlah != 0";
                      $run_sql_1 = mysqli_query($conn,$sql_1);

                      
                      while($rows = mysqli_fetch_assoc($run_sql_1)){
                      // $id = $rows['id_brg'];
                        if ($rows['jumlah']!=1) {
                          $teks = "<a href='edit_retur_tukar.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]' class='btn btn-info'><span class='fa fa-pen'></span></a>";
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
                        <td><a onclick=\"return confirm('Yakin Anda Akan Melakukan Retur Tukar Barang?')\"href='delete_retur_tukar.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]&amp;jumlah=$rows[jumlah]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                      </tr>
                      ";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.tab-pane 1-->

            <!-- tab-pane 2 -->
            <div class="tab-pane" id="tab_3">
              <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                  <h3>Retur Kembali Uang</h3>
                </div>
                <div class="col-md-12">
                  <table id="example_2" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
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
                      $sql = "SELECT * FROM tbl_detail_transaksi JOIN tbl_brg USING(id_barang) WHERE jumlah !=0";
                      $run_sql = mysqli_query($conn,$sql);

                      // $sql2 = "SELECT * FROM tbl_brg";
                      // $run_sql2 = mysqli_query($conn,$sql2);
                      while($rows = mysqli_fetch_assoc($run_sql)){
                      // $id = $rows['id_brg'];
                        if ($rows['jumlah']!=1) {
                          $teks1 = "<a href='edit_retur_uang.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]' class='btn btn-info'><span class='fa fa-pen'></span></a>";
                        }else{
                          $teks1 ="";
                        }
                      echo "
                      <tr>
                        <td>$rows[id_transaksi]</td>
                        <td>$rows[nama_barang]</td>
                        <td style='text-align:right'>".rupiah($rows['harga_beli'])."</td>
                        <td style='text-align:right'>".rupiah($rows['harga_jual'])."</td>
                        <td>$rows[jumlah]</td>               
                        <td>".$teks1."</td>
                        <td><a onclick=\"return confirm('Yakin Anda Akan Melakukan Retur Kembali Uang?')\"href='delete_retur_uang.php?id_t=$rows[id_transaksi]&amp;id_b=$rows[id_barang]&amp;jumlah=$rows[jumlah]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                      </tr>
                      ";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.tab-pane 2 -->
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
    $('#example').DataTable({
        "paging": false,
        "dom": '<"pull-left"f>t'
    });
    $('#example_2').DataTable({
        "paging": false,
        "dom": '<"pull-left"f>t'
    });
  });

</script>

<?php
include '../footer.php';
?>