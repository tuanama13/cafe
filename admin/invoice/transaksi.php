<?php  
  session_start();
  //fungsi already header(menangkal warnings)
  ob_start();
  include '../init/db.php';
  require '../functions.php';
  // include '../admin_login.php';
  include '../header.php';
  include '../sidebar.php';

  //$status = $_GET['status'];

  date_default_timezone_set('Asia/Jakarta');
  $date_now = date("Y-m-d");
 
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
        Cetak Faktur
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="active">Cetak Faktur</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Faktur 
	                <small>Form Faktur Masuk Hari Ini</small>
	              </h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
                <table id="table-transaksi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th><></th>                        
                    </tr>
                </thead>
                <tbody>

                  
                  <?php
                      $sql = "SELECT * FROM tb_transaksi ORDER BY waktu DESC";
                      $run_sql = mysqli_query($conn,$sql); 
                      while($rows = mysqli_fetch_assoc($run_sql)){
                          // $id = $rows['id_brg'];                       
                        echo "
                            <tr>
                              <td>$rows[kode_transaksi]</td>
                              <td>$rows[waktu]</td>
                              <td>$rows[username]</td>
                              <td style='text-align : right'>".rupiah($rows['total'])."</td>
                              <td><button type='button' class='btn btn-info btnCetak' data-id='$rows[kode_transaksi]'>Cetak</button></td>
                            </tr>
                        ";
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
 <!-- Modal Toko-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h4 class="modal-title" id="myModalLabel">Detail Transaksi</h4>
                    </div>
                    <div class="cetakBody">
                      <?php  
                        $sql = "SELECT * FROM transaksi WHERE tgl_transaksi='$date_now' AND grand_total <> 0";
                        $run_sql = mysqli_query($conn,$sql); 
                        $rows = mysqli_fetch_assoc($run_sql);
                            // $id = $rows['id_brg'];
                       
                        echo "<button type='button' class='cetak btn btn-info' id='btnCet'  data-grand_total='$rows[grand_total]'  data-toko='$rows[id_toko]'><span class='fa fa-print'></span> Cetak</button>";
                      ?>
                    </div>
                      
                    
                   
                    <div class="col-md-12 overflow-x:auto;">

                      <table style="margin: 20px;">

                        <tr>
                          <td><b>No. Invoice</b></td>
                          <td width="150px"></td>
                          <td><b>Nama Toko</b></td>
                        </tr>
                        <tr>
                          <td><h4 id="id_invoice"></h4></td>
                          <td></td>
                          <td><h4 id="nama_toko"></h4></td>
                        </tr>
                      </table>                      
                    </div>                    
                    <div class="modal-body"  id="modal-body">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Toko -->

   <script>
    
    var sub_total=0;
    var sisa_hutang=0;

     $(document).ready(function() {
        $('#table-transaksi').DataTable();                   
    });


     // fungsi pilih baris tabel modal supplier
    $(document).on('click', '.pilih', function (e) {
      // $('#myModal').modal('shown');
      var grand_total = $(this).attr('data_grand-total');
      var id_transaksi = $(this).attr('data-invoice');
      var nama_toko = $(this).attr('data-toko');
      console.log(id_transaksi);
      document.getElementById('id_invoice').innerHTML = "#"+id_transaksi;
      document.getElementById('nama_toko').innerHTML = nama_toko;

      $.ajax({
          type  : "GET",
          data  : "id_transaksi="+id_transaksi+"&grand_total="+grand_total,
          url   : "load_transaksi.php",
          success : function(result){
            console.log(result);
            // setInterval(function(){
            //  $("#modal-body").load(result);
            document.getElementById('modal-body').innerHTML = result;
            
            } 
        });
       
     });


    $(document).on('click', '.btnCetak', function (e) { 
      var id_transaksi = $(this).attr('data-id');
      // console.log(id_transaksi);
     
      $.ajax({
          type  : "GET",
          data  : "id="+id_transaksi,
          url   : "cetak_faktur.php",
          success : function(result){  
            // window.location.href = "transaksi.php";          
          } 
        });
       
     });
    </script>
   
  <?php  
    include '../footer.php';
   ?>