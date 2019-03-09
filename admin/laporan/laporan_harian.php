<?php  
  //fungsi already header(menangkal warnings)
  ob_start();
  include '../init/db.php';
  //include "../admin_login.php";
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
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="active">Barang</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Tambah Barang
	                <small>Semua Yang Akan Anda Posting</small>
	              </h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	             <div class="row">
                 <div class="col-md-6">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <div class="radio">
                        <label>
                        <input type="radio" name="lap" id="lap1" value="" onclick= "disableTGL('true')">
                          <i class="fa fa-text-width"></i>
                          <h3 class="box-title">Laporan Perhari</h3>
                        </label>
                      </div>  
                      <!-- <i class="fa fa-text-width"></i>

                      <h3 class="box-title">Laporan Perhari</h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <div class="form-group">
                        <label for="tgl_laporan">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tgl_laporan" name="tgl_laporan" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" id="tgl1" class="tgl1 btn btn-primary" name="submit">Submit</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                 <div class="box box-solid">
                    <div class="box-header with-border">
                      <div class="radio">
                        <label>
                        <input type="radio" name="lap" id="lap2" value="">
                          <i class="fa fa-text-width"></i>
                          <h3 class="box-title">Laporan Hari Berjenjang</h3>
                        </label>
                      </div>                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="form-group col-md-6">
                        <label for="tgl_laporan1">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tgl_laporan1" name="tgl_laporan1" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="tgl_laporan2">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tgl_laporan2" name="tgl_laporan2" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="tgl2 btn btn-primary" name="submit">Submit</button>
                    </div>
                 </div>
                </div>
	            </div>
                
                <?php

                  // $sql = mysqli_query($conn,"SELECT * FROM detail_transaksi WHERE tgl_transaksi = '$id_transaksi'");
                ?>
                <div class="row">
                  <div class="col-md-12" style="text-align: center; margin-bottom: 20px">
                    <h2>Laporan Penjualan</h2>
                    <small id="tgl_txt">Tanggal : xx-xx-xxxx</small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 table-responsive">
                    <table class="table" id="tbl-laporan">
                      
                    </table>
                  </div>
                </div>

	          </div>
	          <!-- /.box -->

          </div>
	       </div>
       </div>
	</section>
</div> 
   <script>
     $(document).ready(function() {
        $('#example').DataTable();

        function disableBTN(r) {
          if (r=='true') {
            document.getElementById('tgl1').disabled=true;
          }else{
           document.getElementById('tgl1').disabled=false; 
          }
        }

        function disableTGL(r){
          if (r=='true') {
            document.getElementById('tgl_laporan1').disabled=true;
          }else{
           document.getElementById('tgl1').disabled=false; 
          }
          
        }

      });

     
     

     

     $(document).on('input change','#tgl_laporan', function (e) {
      disableBTN('false');
     });

     // $(document).on('checked','#lap1', function (e) {
     //  document.getElementById('tgl_laporan1').readOnly=true;
     // });

     $(document).on('click', '.tgl1', function (e) {
        var tgl_laporan = $("[name='tgl_laporan']").val();
        document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tgl_laporan;

            
            $.ajax({
                type  : "GET",
                data  : "tgl_laporan="+tgl_laporan,
                url   : "query_laporan_harian.php",
                success : function(result){
                  console.log(result);
                  // window.location="index.php"
                  document.getElementById('tbl-laporan').innerHTML = result;
                } 
            });

     });

     $(document).on('click', '.tgl2', function (e) {
        var tgl_laporan1 = $("[name='tgl_laporan1']").val();
        var tgl_laporan2 = $("[name='tgl_laporan2']").val();
        document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tgl_laporan1+" - "+tgl_laporan2;
            
            $.ajax({
                type  : "GET",
                data  : "tgl_laporan1="+tgl_laporan1+"&tgl_laporan2="+tgl_laporan2,
                url   : "query_laporan_harian.php",
                success : function(result){
                  console.log(result);
                  // window.location="index.php"
                  document.getElementById('tbl-laporan').innerHTML = result;
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