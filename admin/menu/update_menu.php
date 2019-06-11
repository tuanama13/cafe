<?php
	session_start();  
	//fungsi already header(menangkal warnings)
	ob_start();


	include '../init/db.php';
//	include "../admin_login.php";
	include '../header.php';
  	include '../sidebar.php';
	// $id = isset( $_GET['id']) ?  $_GET['id'] : null;
	if (isset( $_GET['id'])) {
    	$id = $_GET['id'];
  	}else{
    	header('Location: list_barang.php');
  	}

	if (isset($_POST['submit'])) {

		$nama = mysqli_real_escape_string($conn,$_POST['nama_barang']);
		$satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    	$harga_beli = mysqli_real_escape_string($conn,$_POST['harga_beli']);
    	$harga_jual = mysqli_real_escape_string($conn,$_POST['harga_jual']);
		$stok = mysqli_real_escape_string($conn,$_POST['stok']);
		$tambahan=mysqli_real_escape_string($conn,$_POST['tambah_jumlah_barang']);
		$tambah_stok=((int)$stok+(int)$tambahan);

		$sup = mysqli_real_escape_string($conn,$_POST['supplier']);
$id_brg = mysqli_real_escape_string($conn,$_POST['id_barang']);

	   $query = "UPDATE tbl_brg SET id_barang = '$id_brg', nama_barang = '$nama', satuan ='$satuan', harga_beli = '$harga_beli',harga_jual = '$harga_jual', stok = '$tambah_stok', supplier = '$sup' WHERE id_barang = '$id'";


	   // UPDATE `list_brg` SET `nama_brg` = 'sada' WHERE `list_brg`.`id_brg` = 232640912;

	   if(mysqli_query($conn,$query)){
	   		header('Location: list_barang.php?status=sukses');
	   }else{
	   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query bermasalah</h4></div>';
	   }
	  
	}

	// echo $_GET['id'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_brg WHERE id_barang='$id'");
	$rows = mysqli_fetch_assoc($query);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang
        <small>Form Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Home</a></li>
        <li class="">Barang</li>
        <li class="active">Update Barang</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Update Barang
	                <small>Data Barang Yang Akan Diubah</small>
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
	              <form role="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
		      		
		      		<div class="form-group col-md-7">
                  		<label for="judul">Kode Barang</label>
                  		<input type="text" class="form-control" id="id_barang" name="id_barang" value="<?php echo $rows['id_barang'];?>" required>
                	</div>
		      		<div class="form-group col-md-7">
                  		<label for="judul">Nama Barang</label>
                  		<input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $rows['nama_barang'];?>" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="stok">Jumlah Barang</label>
                  		<input type="number" class="form-control" id="stok" name="stok" value="<?php echo $rows['stok'];?>" required readonly>
                	</div>
                	<div class="form-group col-md-7" >
                  		<label for="harga-beli">Harga Beli</label>
                  		<input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $rows['harga_beli'];?>" required>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="harga">Harga Jual</label>
                  		<input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $rows['harga_jual'];?>" required>
                	</div>
					<div class="form-group col-md-5">
                  		<label for="satuan">Satuan</label>
                  		<input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $rows['satuan'];?>" required>
                		
                	</div>
                		<div class="form-group col-md-7">
                  		<label for="satuan">Supplier</label>
                  		<input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $rows['supplier'];?>" required>
                		
                	</div>

               <div class="form-group col-md-7">
             		<label for="stok">Tambah Jumlah Barang</label>
               		<input type="number" class="form-control" id="tambah_jumlah_barang" name="tambah_jumlah_barang"  required>
               </div>
	                <div class="box-footer col-md-7">
               			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
              	    </div>
	              </form>
	            </div>
	          </div>
	          <!-- /.box -->
	         </div>

	</section>
   </div>
   <?php  
   	include '../footer.php';
   ?>