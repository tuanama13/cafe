<?php  
  session_start();
  //fungsi already header(menangkal warnings)
  ob_start();
  include '../init/db.php';
  require '../functions.php';
  //include "../admin_login.php";
  include '../header.php';
  // include '../sidebar_p.php';
   if ($_SESSION['level']=='1') {
 	include '../sidebar.php';
   }elseif ($_SESSION['level']=='3') {
 	include '../sidebar_p.php';
   }
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
        Form Barang
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="">Laporan</li>
        <li class="active">Laporan Barang </li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Daftar Barang 
	                <small>Daftar Barang</small>
	              </h3>
	              <!-- <button class="pull-right btn btn-success"><span class="fa fa-print"></span> Cetak</button> -->
	              <a href="cetak_laporan_barang.php" class="pull-right btn btn-success"><span class="fa fa-print"></span> Cetak</a>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">

                 <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                	<thead>
		                <tr>
		                  <th>ID Barang</th>
		                  <th>Nama Barang</th>
		                  <th>Jumlah Barang</th>
		                  <th>Satuan</th>
		                  <th>Harga Beli</th>
		                  <th>Harga Jual</th>
		                  <!-- <th>Stok</th> -->
		                </tr>
		              </thead>
		              <tbody>
		                <?php  
		                  $sql = "SELECT * FROM tb_barang";
		                  $run_sql = mysqli_query($conn,$sql); 
		                  while($rows = mysqli_fetch_assoc($run_sql)){
		                    echo "
		                                <tr>
		                                  <td>$rows[id_barang]</td>
		                                  <td>$rows[nama_barang]</td>
		                                  <td>$rows[jumlah_barang]</td>
		                                  <td>$rows[satuan_barang]</td> 
		                                  <td>".rupiah($rows['harga_beli'])."</td>
		                                  <td>".rupiah($rows['harga_jual'])."</td>		                                  
		                                  
		                                  
		                        		</tr>";
		                    }
		                ?>
		              </tbody>
                </table> 
	          </div>
	          <!-- /.box -->
	       </div>
       </div>


	</section>
</div> 
<script>
	 $(document).ready(function() {
        $('#example').DataTable({
        	"ordering": false
        });                   
    });
</script>
  <?php  
    include '../footer.php';
   ?>