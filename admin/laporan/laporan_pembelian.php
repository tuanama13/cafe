<?php  
  session_start();
  //fungsi already header(menangkal warnings)
  ob_start();
  include '../init/db.php';
  //include "../admin_login.php";
  include '../header.php';
  // include '../sidebar_p.php';
  //$status = $_GET['status'];
  if ($_SESSION['level']=='1') {
    include '../sidebar.php';
  }elseif ($_SESSION['level']=='3') {
    include '../sidebar_p.php';
  }

 
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
        Form Laporan 
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="">Laporan</li>
        <li class="active">Laporan Pembelian</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Laporan Pembelian
	                <small>Untuk Melihat Daftar Pembelian</small>
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
                          <!-- <input type="radio" name="lap" id="lap1" value="" onclick= "disableTGL('true')"> -->
                          <i class="fa fa-text-width"></i>
                          <h3 class="box-title"> Laporan Pembelian</h3>
                        </label>
                      </div>  
                    </div>
                    <!-- /.box-header -->
                      <div class="box-body">
                           <div class="form-group">
                            <label for="tgl_laporan">Pilih Tahun</label>
                            <select class="form-control" name="tahun">
                            <?php  
                              
                              $sql = "SELECT YEAR(tgl_pembelian) AS tahun FROM pembelian_brg GROUP BY  YEAR(tgl_pembelian) ASC";
                              $run_sql = mysqli_query($conn,$sql);
                              while($rows = mysqli_fetch_array($run_sql)){
                                 echo "<option value='".$rows['tahun']."'>".$rows['tahun']."</option>";
                              }
                            ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="tgl_laporan">Pilih Bulan</label>
                            <select class="form-control" name="bulan">
                            <?php  
                              $sql = "SELECT MONTHNAME(tgl_pembelian) AS Bulan, MONTH(tgl_pembelian) AS bulan FROM pembelian_brg GROUP BY  MONTH(tgl_pembelian) ASC";
                              $run_sql = mysqli_query($conn,$sql);
                               while($rows = mysqli_fetch_array($run_sql)){
                                 echo "<option value='".$rows['bulan']."'>".$rows['Bulan']."</option>";
                               }
                            ?>
                            </select>
                          </div>
                      </div>
                    <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" id="tgl1" class="tgl1 btn btn-primary" name="submit">Lihat</button>
                        <button type="submit" id="cetak" class="cetak btn btn-success pull-right" name="submit"><span class="fa fa-print"> Cetak</span></button>
                      </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-solid">
                    
                    <!-- /.box-header -->
                      <div class="box-body">
                        <h2>Pembelian Total Tahun : <?php echo date("Y"); ?></h2>
                        <?php 
                          $tahun_ini= date('Y');
                          $sql = "SELECT SUM(grand_total) AS laba FROM pembelian_brg WHERE YEAR(tgl_pembelian) = '$tahun_ini'";
                          $run_sql = mysqli_query($conn,$sql);
                          $rows = mysqli_fetch_array($run_sql);

                        ?>
                        <h3 id="total"><?php echo "Rp. ".number_format($rows['laba'],0,".",".") ?></h3>

                          
                      </div>
                    <!-- /.box-body -->

                      
                  </div>
                </div>
              </div>

	           </div>
                
                <?php

                  // $sql = mysqli_query($conn,"SELECT * FROM detail_transaksi WHERE tgl_transaksi = '$id_transaksi'");
                ?>
                <div class="row">
                  <div class="col-md-12" style="text-align: center; margin-bottom: 20px">
                    <h2>Laporan Pembelian</h2>
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
<!-- </div>  -->
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
        var tahun = $("[name='tahun']").val();
        var bulan = $("[name='bulan']").val();
         // var bulan = 2;
        document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tahun;
        document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tahun;

            
            $.ajax({
                type  : "GET",
                data  : "tahun="+tahun+"&bulan="+bulan,
                url   : "query_laporan_pembelian.php",
                success : function(result){
                  console.log(result);
                  // window.location="index.php"
                  document.getElementById('tbl-laporan').innerHTML = result;
                } 
            });

     });

     $(document).on('click', '.cetak', function (e) {
        var tahun = $("[name='tahun']").val();
        var bulan = $("[name='bulan']").val();
         // var bulan = 2;
        // document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tahun;
        // document.getElementById('tgl_txt').innerHTML = "Tanggal : "+tahun;

            
            $.ajax({
                type  : "GET",
                data  : "tahun="+tahun+"&bulan="+bulan,
                url   : "cetak_laporan_pembelian.php",
                success : function(result){
                  console.log(result);
                  // window.location="index.php"
                  // document.getElementById('tbl-laporan').innerHTML = result;
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