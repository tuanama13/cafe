<?php  
	//fungsi already header(menangkal warnings)
  session_start();
  // include '../tes.php';

  ob_start();
  $path = realpath(__DIR__ . '/../..');
  include_once($path . '/init/db.php');

  // Sidebar
  $page_header = "karyawan";
  $page_li = "list_user";
//  include '../init/db.php';
 include '../header.php';
 include '../sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
        User
        <small>Hak Akses Akun</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="">Post</li> -->
        <li class="active">User</li>
      </ol>
    </section>
	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-12">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Daftar User
	                <small>Daftar Hak Akses Menggunakan Aplikasi</small>
	              </h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	             <table id="example" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style='text-align: center;'>No</th>
                    	 <th>Nama Karyawan</th>
                        <th>Username</th>
                        
                        <th>Level</th>
                        <th style='text-align: center;'>Edit</th>
                        <th style='text-align: center;'>Delete</th>
                      <!-- <th colspan="2" style="text-align: center">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                  
                  <?php
                    		// $sql2 = "SELECT nama FROM karyawan WHERE id_karyawan=";
		                    // $run_sql2 = mysqli_query($conn,$sql2);
		                    // $rows2 = mysqli_fetch_assoc($run_sql2)

                    $sql = "SELECT * FROM tbl_user";
                    $no = 1;

  //            $sql = "SELECT * FROM tb_user INNER JOIN tb_karyawan USING(id_karyawan)";
                    $run_sql = mysqli_query($conn,$sql);
                   //$rows = mysqli_fetch_assoc($run_sql);
                      while($rows = mysqli_fetch_assoc($run_sql)){
                        $sql2 = "SELECT nama_pegawai FROM tbl_pegawai WHERE id_pegawai='$rows[id_pegawai]'";
		                    $run_sql2 = mysqli_query($conn,$sql2);
		                    $rows2 = mysqli_fetch_assoc($run_sql2);
                        if ($rows['role_user']== 'Admin') {
                          $level_ = 'Administrator';
                        } else if ($rows['role_user']== 'Kasir') {
                          $level_ = 'Kasir';                          
                        } else{
                          $level_ = 'Pimpinan';
                        }
                        echo "

                            <tr>
                              <td style='text-align: center;'>".$no."</td>
                              <td>$rows2[nama_pegawai]</td>
                              <td>$rows[username_user]</td>                              
                              <td>$level_</td>                          
                              <td style='text-align: center;'><a href='update_user.php?id=$rows[id_user]' class='btn btn-info'><span class='fa fa-pen'></span></a></td>
                              <td style='text-align: center;'><a href='delete_user.php?id=$rows[id_user]' class='btn btn-danger'><span class='fa fa-times'></span></a></td>
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