<?php 
  	session_start();
//   include '../tes.php';
	//fungsi already header(menangkal warnings)
	ob_start();

	// DB Connection 
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');

	// include '../init/db.php';

	// Sidebar
  	$page_header = "karyawan";
	$page_li = "tambah_user";
	   
	include '../header.php';
  	include '../sidebar.php'; 

  	if (isset($_POST['submit'])) {
  		$username = mysqli_real_escape_string($conn,$_POST['username']);
  		$password = mysqli_real_escape_string($conn,$_POST['password']);
  		$level = mysqli_real_escape_string($conn,$_POST['level']);
  		$id_karyawan = mysqli_real_escape_string($conn,$_POST['id_karyawan']);
		$logs = 1;
  		$insert = "INSERT INTO tbl_user(id_pegawai,username_user,password_user,role_user,logs) VALUES ('$id_karyawan','$username','$password','$level','$logs')";

		if (mysqli_query($conn,$insert)) {
				 header('Location: list_user.php');
			}else{
				echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
			}
  		
  	}
		
	// 	$nama = $_POST['nm_karyawan'];
	// 	$tgl = $_POST['tgl_lahir'];
	// 	$alamat = $_POST['alamat'];
	// 	$no_telepon = $_POST['no_telepon'];
	// 	$jabatan = $_POST['jabatan'];
	// 	$del = 1;

	// 	$insert = "INSERT INTO karyawan(id_karyawan,nama,alamat,no_telp,tgl_lahir,jabatan,del) VALUES ('$id','$nama','$alamat','$no_telepon','$tgl','$jabatan','$del')";

	// 	if (mysqli_query($conn,$insert)) {
	// 			header('Location: list_karyawan.php');
	// 		}else{
	// 			echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
	// 		}
	// }
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
	        <div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Tambah User
	                <small>Halaman untuk Menambahkan User Baru</small>
	              </h3>
	              <!-- tools box -->
	              <!-- <div class="pull-right box-tools">
	                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	                  <i class="fa fa-minus"></i></button>
	                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
	                  <i class="fa fa-times"></i></button>
	              </div> -->
	              <!-- /. tools -->
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	              <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	              	<input type="text" name="id_karyawan"  hidden>
					<div class="form-group col-md-7">
						<label for="nama">Nama Karyawan</label>
							<div class="input-group-btn ">
								<input type="text" name="nama" class="form-control col-md-10" placeholder="Pilih Nama Karyawan" readonly>
                  			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Pilih</button>
                  			
               			</div>
					</div>

					<div class="form-group col-md-7">
                  		<label for="level">Level</label>
                  		<input type="text" class="form-control" id="level" name="level" placeholder="Level User" readonly>
                	</div>

                	<div class="form-group col-md-7">
                  		<label for="username">Username</label>
                  		<input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                  		<!-- <textarea class="form-control" rows="5" name="alamat" id="alamat" placeholder="Alamat Karyawan"></textarea> -->
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="password">Password</label>
                  		<input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="password2">Ulangi Password</label>
                  		<input type="password" class="form-control" id="password2" name="password2" placeholder="Masukan Password" required>
                  		<span id="message" class="message"></span>
                	</div>

                	<!-- <div id="alert">asss</div> -->
                		      
	                <div class="box-footer col-md-7">
               			<button type="submit" class="btn btn-primary" name="submit" id="submit" >Submit</button>
              	    </div>
	              </form>
	            </div>
	          </div>
	          <!-- /.box -->
	         </div>
	</section>

	<!-- Modal Karyawan-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Karyawan</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookup" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID Karyawan</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Data mentah yang ditampilkan ke tabel    
                                // mysql_connect('localhost', 'root', '');
                                // mysql_select_db('harviacode');



                                $sql = mysqli_query($conn,"SELECT * FROM tbl_pegawai");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                	$id_karyawan=$row['id_pegawai'];

                                	if ($row['posisi_pegawai']== 'Admin') {
                                    $level_ = 'Administrator';
                                  } else if ($row['posisi_pegawai']== 'Kasir') {
                                    $level_ = 'Kasir';                          
                                  } else{
                                    $level_ = 'Pimpinan';
                                  }
                                ?>
                                    <tr class="pilih" data-nama_karyawan="<?php echo $row['nama_pegawai']; ?>" data-id_karyawan="<?php echo $row['id_pegawai']; ?>" data-level="<?php echo $row['posisi_pegawai']; ?>">
                                        <td><?php echo $row['id_pegawai']; ?></td>
                                        <td><?php echo $row['nama_pegawai']; ?></td>
                                        <td><?php echo $level_; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal karyawan -->
   </div>
   <script type="text/javascript">
   		 $(document).on('click', '.pilih', function (e) {
   		 	var nama = $(this).attr('data-nama_karyawan');
   		 	var id_karyawan =  $(this).attr('data-id_karyawan');
   		 	var level =  $(this).attr('data-level');
   		 	$("[name='nama']").val(nama);
   		 	$("[name='level']").val(level);
   		 	$("[name='id_karyawan']").val(id_karyawan);
   		 	console.log(id_karyawan);
   		 	console.log(level);

   		 	$('#myModal').modal('hide');
   		 });

        $(document).ready(function() {
        $('#lookup').DataTable();
      } );

   		 $('#password, #password2').on('keyup', function () {
          if ($('#password').val() == $('#password2').val()) {
            $('#submit').prop('disabled', false);
            $('#message').html('Matching').css('color', 'green');

          } else {
            $('#message').html('Not Matching').css('color', 'red');
            $('#submit').prop('disabled', true);
          }
        });
   </script>
   <?php  
   	include '../footer.php';
   ?>