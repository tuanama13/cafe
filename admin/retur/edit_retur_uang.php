<?php
	session_start();  
	//fungsi already header(menangkal warnings)
	ob_start();


	include '../init/db.php';
//	include "../admin_login.php";
	include '../header.php';
  	include '../sidebar.php';
	// $id = isset( $_GET['id']) ?  $_GET['id'] : null;
	if (isset( $_GET['id_t'])) {
    	$id_t = $_GET['id_t'];
    	$id_b = $_GET['id_b'];
  	}else{
    	header('Location: retur.php');
  	}

	if (isset($_POST['submit'])) {

		// $id_transaksi= mysqli_real_escape_string($conn,$_POST['id_transaksi']);
		// $id_barang= mysqli_real_escape_string($conn,$_POST['id_barang']);
		$harga_jual= str_replace(".", "", mysqli_real_escape_string($conn,$_POST['harga_jual']));
		$jumlah= mysqli_real_escape_string($conn,$_POST['jumlah']);

		$jumlah_retur= mysqli_real_escape_string($conn,$_POST['jumlah_retur']);
		$jumlah_baru= (int)$jumlah - (int)$jumlah_retur;

		// Mencari harga_beli
		$query_dt = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi WHERE id_transaksi = '$id_t' AND id_barang='$id_b'");
		$rows_dt = mysqli_fetch_assoc($query_dt);
		$harga_beli = $rows_dt['harga_beli'];


		$query_transaksi = mysqli_query($conn,"SELECT diskon, grandtotal, total_harga_beli, total_harga_jual FROM tbl_transaksi WHERE id_transaksi='$id_t'");
		$rows_transaksi = mysqli_fetch_assoc($query_transaksi);
		$harga_beli_baru = ((int)$jumlah_retur*(int)$harga_beli); 
		$total_baru = ((int)$jumlah_retur*(int)$harga_jual);
		// $grandtotal = $rows_transaksi['grandtotal'];
		// $total_jual = $rows_transaksi['total_harga_jual'];
		$diskon_t = $rows_transaksi['diskon'];
		$total_harga_beli_baru = ((int)$rows_transaksi['total_harga_beli'] - (int)$harga_beli_baru);
		$total_jual_baru = ((int)$rows_transaksi['total_harga_jual'] - (int)$total_baru);
		$grandtotal_baru = ((int)$rows_transaksi['grandtotal'] - (int)$total_baru);

		$query_retur = "INSERT INTO tbl_retur(id_transaksi, id_barang, harga_beli, harga_jual, jumlah, status_retur) VALUES('$id_t','$id_b', '$harga_beli', '$harga_jual','$jumlah_retur','1')";

	   	$query_detailt = "UPDATE tbl_detail_transaksi SET jumlah = '$jumlah_baru' WHERE id_transaksi = '$id_t' AND id_barang = '$id_b' AND jumlah = $jumlah";

	  	$query_up_transaksi = "UPDATE tbl_transaksi SET total_harga_beli = '$total_harga_beli_baru', total_harga_jual = '$total_jual_baru', grandtotal = '$grandtotal_baru' WHERE id_transaksi = '$id_t'";

	  
	   		if(mysqli_query($conn,$query_retur)){
	   			if(mysqli_query($conn,$query_detailt)){
		   			if(mysqli_query($conn,$query_up_transaksi)){
		   				header('Location: retur.php?status=sukses, stok telah ditambah');
				   	}else{
				   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Update Pada Transaksi bermasalah</h4>. '.mysqli_error($conn).'</div>';
				   	}
			   	}else{
			   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Update Pada Detail Transaksi bermasalah</h4>. '.mysqli_error($conn).'</div>';	
			   	}	
		   	}else{
		   		echo '<div class="alert alert-danger" style="text-align:center"><h4>Query Pada Retur bermasalah '.mysqli_error($conn).'</h4></div>';
		   }
	   	
	  
	}// }else{
 //    	echo '<div class="alert alert-danger" style="text-align:center"><h4>Edit Retur Bermasalah'.mysqli_error($conn).'</h4></div>';
 //  	}

	// echo $_GET['id'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi JOIN tbl_brg USING(id_barang) WHERE id_transaksi='$id_t' AND id_barang='$id_b'");
	$rows = mysqli_fetch_assoc($query);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Retur Rusak
        <small>Form Retur Kembali Uang</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Home</a></li>
        <li class="">Retur</li>
        <li class="active">Retur Rusak</li>
      </ol>
    </section>

	<section class="content">
	     <!-- Main content -->
	      <div class="row">
	        <div class="col-md-8">
	          <div class="box box-info">
	            <div class="box-header">
	              <h3 class="box-title">Retur Rusak Kembali Uang
	                <!-- <small>Data Transaksi Yang Akan Diubah</small> -->
	              </h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body pad">
	              <form role="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
		      		
		      		<div class="form-group col-md-7">
                  		<label for="judul">ID Transaksi</label>
                  		<input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?php echo $rows['id_transaksi'];?>" required readonly>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="stok">Nama Barang</label>
                  		<input type="text" class="form-control" id="id_barang" name="id_barang" value="<?php echo $rows['nama_barang'];?>" required readonly>
                	</div>
                	<div class="form-group col-md-7">
                  		<label for="harga">Harga Barang</label>
                  		<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1">Rp.</span>
						  <input type="text" class="form-control" id="harga_jual" name="harga_jual" aria-describedby="basic-addon1" required readonly>
						</div>
                	</div>
					<div class="form-group col-md-5">
                  		<label for="satuan">Jumlah</label>
                  		<input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $rows['jumlah'];?>" required readonly>
                		
                	</div>

	               	<div class="form-group col-md-7">
	             		<label for="stok">Jumlah Retur</label>
	               		<input type="number" class="form-control" id="jumlah_retur" name="jumlah_retur" max="<?php echo (((int) $rows['jumlah'] - 1)) ?>" required>
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
   <script type="text/javascript">
   		var harga = document.getElementById("harga_jual");
   		// var  = document.getElementById("total_piutang");

   		harga.value = formatRupiah("<?php echo $rows['harga_jual']; ?>", "");
   </script>
   <?php  
   	include '../footer.php';
   ?>