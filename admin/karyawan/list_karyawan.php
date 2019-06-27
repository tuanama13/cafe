<?php
  session_start();
  // include '../tes.php';
	//fungsi already header(menangkal warnings)
  ob_start();

  // DB Connection 
  $path = realpath(__DIR__ . '/../..');
  include_once($path . '/init/db.php');
  // include '../init/db.php';

  // Sidebar
  $page_header = "karyawan";
   $page_li = "list_karyawan";

  include '../header.php';
  include '../sidebar.php';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
        List Karyawan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="active">Karyawan</li>
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
	              <h3 class="box-title">List Karyawan
	                <small>Semua Karyawan</small>
	              </h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	             <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style='text-align: center;'>No</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat Karyawan</th>
                        <th>Kontak Karyawan</th>
                        <th>Jabatan</th>
                        <!-- <th>Jabatan</th> -->
                        
                        <th style='text-align: center;'>Edit</th>
                        <th style='text-align: center;'>Delete</th>
                      <!-- <th colspan="2" style="text-align: center">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                  
                  <?php
                      $no = 1;
                      $sql = "SELECT * FROM tbl_pegawai";
                      $run_sql = mysqli_query($conn,$sql); 
                      while($rows = mysqli_fetch_assoc($run_sql)){
                          // $id = $rows['id_brg'];
                        echo "

                            <tr>
                              <td>$no</td>
                              <td>$rows[nama_pegawai]</td>
                              <td>$rows[alamat_pegawai]</td>
                              <td>$rows[kontak_pegawai]</td>
                              <td>$rows[posisi_pegawai]</td>
                                                       
                              <td style='text-align: center;'><a href='update_karyawan.php?id=$rows[id_pegawai]' class='btn btn-info'><span class='fa fa-pen'></span></a></td>
                              <td style='text-align: center;'><a onclick=\"return confirm('Yakin $rows[nama_pegawai] diHapus?')\" href='delete_karyawan.php?id=$rows[id_pegawai]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
                            </tr>
                        ";

                        $no++;
                      }
                    ?>
                  </tbody>
                </table>
	            </div>
                <div class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        <p>One fine body&hellip;</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <?php echo "<button type='button' class='btn btn-primary' href='delete.php?id=$rows[id_brg]' data-dismiss='modal'>Delete</button>";?>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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