<?php 
	session_start();
  	// include '../tes.php';
  	
	ob_start();

	// DB Connection 
	$path = realpath(__DIR__ . '/../..');
	include_once($path . '/init/db.php');

	// Sidebar
	$page_header = "karyawan";
	  
	include '../header.php';
	// include '../init/db.php';
	include '../sidebar.php';
	$id_karyawan = $_GET['id'];

	if (isset($_POST['submit'])) {
		$id_karyawan = mysqli_real_escape_string($conn,$_POST['id_karyawan']);
		$username = mysqli_real_escape_string($conn,$_POST['username']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);

		$query = "UPDATE tbl_user SET username_user = '$username',password_user = '$password' WHERE id_user = '$id_karyawan'";

		if (mysqli_query($conn, $query)) {
			header('Location: list_user.php');
		}else{
			mysqli_error($conn);
		}

	}
	
	$query = mysqli_query($conn,"SELECT * FROM tbl_user WHERE id_user='$id_karyawan'");
	$rows = mysqli_fetch_assoc($query);
	$id_ = $rows['id_pegawai']; 
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
	              <h3 class="box-title">Edit User
	                <small>Untuk Mengubah Data User</small>
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
	              	<?php 
	              		$query_nama = mysqli_query($conn,"SELECT nama_pegawai FROM tbl_pegawai WHERE id_pegawai='$id_'");
	              		$rows_nama = mysqli_fetch_assoc($query_nama);   
	              	?>
	              	<input type="text" name="id_karyawan" value="<?php echo $id_karyawan ?>"  hidden>
					<div class="form-group col-md-7">
                  		<label for="nama">Nama Karyawan</label>
                  		<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $rows_nama['nama_pegawai'] ?>" readonly>
                	</div>

					<div class="form-group col-md-7">
                  		<label for="level">Level</label>
                  		<input type="text" class="form-control" id="level" name="level" value="<?php echo $rows['role_user'] ?>" readonly>
                	</div>

                	<div class="form-group col-md-7">
                  		<label for="username">Username</label>
                  		<input type="text" class="form-control" name="username" value="<?php echo $rows['username_user'] ?>" required>
                  		<!-- <textarea class="form-control" rows="5" name="alamat" id="alamat" placeholder="Alamat Karyawan"></textarea> -->
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="password">Password</label>
                  		<input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="password2">Ulangi Password</label>
                  		<input type="password" class="form-control" id="password2" name="password2" placeholder=" Ulangi Masukan Password" required>
                  		<span id="message"></span>
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
   </div>
   <script>
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