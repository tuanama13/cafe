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
    Pembelian
    <small>Form Pembelian</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i> Home</a></li>
      <li class="">Pembelian</li>
      <li class="active">Daftar Pembelian</li>
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
            <h1 class="box-title">Daftar Pembelian
            <!-- <small>List Barang-Barang yang Sudah Dimasukan</small> -->
            </h1>
            <a href="tambah_piutang.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Tambah <small>( Shift + X )</small></a>
            
             <a href="../laporan/cetak_laporan_pembelian.php" class="btn btn-success pull-right"  style="margin-right: 5px"><i class="fa fa-print"></i> Cetak</a>
          </div>

          <div class="col-md-12" style="margin-bottom: 30px">
	            <?php
            	$sql = "SELECT * FROM tbl_piutang WHERE status != 0";
                $run_sql = mysqli_query($conn,$sql);
            ?>		  	
		  	
		  </div>
		 
          <!-- /.box-header -->
          <div class="box-body pad">
            <table id="example" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!-- <th>Kode Pembelian</th> -->
                  <th>Kode Transaksi</th>
                  <th>Tanggal Masuk</th>
                  <th>Tempo</th>
                  <!-- <th>Tanggal Bayar</th> -->
                  <th>Total Pembelian</th>
                  <th>Total Dibayar</th>
                  <th>Sisa</th>
                  <th>Tanggal Bayar</th>
                  <!-- <th>Status</th> -->
                  <th>Supplier</th>
                  <th><></th>
                  <th><></th>
                  
                  <!-- <th colspan="2" style="text-align: center">Action</th> -->
                </tr>
              </thead>
              <tbody>
                
                <?php
                $sql = "SELECT * FROM tbl_piutang WHERE status != 0";
                $run_sql = mysqli_query($conn,$sql);
                while($rows = mysqli_fetch_assoc($run_sql)){
                // $id = $rows['id_brg'];
                $tagl_m = date_format(date_create($rows['tgl_masuk']),"d-m-Y");
                $tagl_t = date_format(date_create($rows['tgl_jatuh_tempo']),"d-m-Y");
                if ($rows['status'] == '1' && $rows['sisa_hutang']!='0') {
                    $bayar =  "<td><a href='bayar_piutang.php?id=$rows[kode_piutang]' class='btn btn-info'><span class='fa fa-check'></span>Bayar</a></td>";
                  }else{
                    $bayar ="<td></td>";
                  }
                echo "
                <tr>
                  
                  <td>$rows[kode_transaksi]</td>
                  <td>$tagl_m</td>
                  <td>$tagl_t</td>                  
                  <td style='text-align:right'>".rupiah($rows['total_piutang'])."</td>
                  <td style='text-align:right'>".rupiah($rows['total_dibayar'])."</td>
                  <td style='text-align:right'>".rupiah($rows['sisa_hutang'])."</td>
                  <td>$rows[tgl_lunas]</td>                  
                  <td>$rows[supplier]</td>
                  ".$bayar."
                  <td><a onclick=\"return confirm('Yakin Hapus?')\"href='delete_piutang.php?id=$rows[kode_piutang]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                </tr>
                ";
                }

                // Tombol Edit
                // <td><a href='update_piutang.php?id=$rows[kode_piutang]' class='btn btn-info'><span class='fa fa-pencil'></span></a></td>
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

  shortcut.add("Shift+X",function() {
    // alert("Hi there!");
    window.location.href ="/tb/piutang/tambah_piutang.php";
  });

  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });
</script>

<?php
include '../footer.php';
?>