<?php
  $path_image = dirname('/');
  $path = realpath(__DIR__ . '/..');  
  include_once($path . '/init/db.pdo.php');

  $query = $db->prepare("SELECT * FROM tbl_produk");
  $query->execute();
  $data = $query->fetchAll(); 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Botanical Cafe | Kasir</title>
  </head>
  <body bgcolor="#CCCCCC">
    <h2><strong><p align="center">Data Produk Botanical Cafe</p></strong></h2>
    <table width="807" border="1" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td width="100" height="30" align="center" valign="middle" bgcolor="#00FFFF">Kode Produk</td>
        <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Kategori</td>
        <td width="170" align="center" valign="middle" bgcolor="#00FFFF">Nama Produk</td>
        <td width="200" align="center" valign="middle" bgcolor="#00FFFF">Deskripsi</td>
        <td width="130" align="center" valign="middle" bgcolor="#00FFFF">Image</td>
        <td width="100" align="center" valign="middle" bgcolor="#00FFFF">Harga</td>
        <!-- <td width="135" align="center" valign="middle" bgcolor="#00FFFF"><a href="create.php">TAMBAH</a></td> -->
      </tr>
        <?php 
          foreach ($data as $value): 
            // $desc_produk = strpos($value['desc_produk'],' ',150);
            // $image =  str_replace("", "",$value['image_produk']
        ?>

      <tr>
          <td p align="center" bgcolor="#FFFFFF"><?php echo $value['id_produk'] ?></td>
          <td p align="center" bgcolor="#FFFFFF"><?php echo $value['id_kat'] ?></td>
          <td p align="left" bgcolor="#FFFFFF"><?php echo $value['nama_produk']?></td>
          <td p align="left" bgcolor="#FFFFFF"><?php echo substr($value['desc_produk'],0,100) ?></td>
          <td p align="center" bgcolor="#FFFFFF"><img src='<?php echo '..'.$value['image_produk']?>' alt=""></td>
          <td p align="right" bgcolor="#FFFFFF"><?php echo $value['harga_produk'] ?></td>
          <!-- <td p align="center" bgcolor="#FFFFFF">
            <a href="edit.php?nis=<?php //echo $value['nis']?>">Edit</a>
            <a href="delete.php?nis=<?php //echo $value['nis']?>">Delete</a>
          </td> -->
      </tr>
      <?php endforeach; ?>
    </table>
    <!-- <p align="center"><a href=http://www.javanetmedia.com>www.javanetmedia.com</a></p> -->

          <script>
    // fungsi menambah pesanan dalam tabel
	$(".produk-select").click(function () {
		// var nama_produk = getElementsByClassName("nama-produk").value;
		console.log("tes");
		
		// var a = $('#subtotal_brg').val();
		// var a = $('#jumlah').val();
		// if (a == '' || a == 0) {
		// 	swal("Jumlah Barang Tidak Boleh Kosong");
		// 	// }else if(cekStok()) {
		// 	//swal("Jumlah Barang Tidak Boleh Kosong");
		// } else {
		// 	//$("#lookup-brg tbody").load("load_brg.php");
		// 	var barang = $("#barang").val();
		// 	var harga = $("#harga").val();
		// 	var jumlah = $("#jumlah").val();
		// 	//console.log(stok_brg);
		// 	// var stok = stok_brg;
		// 	var sub = harga * jumlah;
		// 	sub_total = sub_total + sub;
			// $.ajax({
			// 	type: "POST",
			// 	data: "id_transaksi=" + id_transaksi + "&id_barang=" + id_brg + "&harga_brg=" + harga + "&jumlah_brg=" + jumlah + "&sub_harga=" + sub + "&stok_brg=" + stok_brg,
			// 	url: "user_transaksi.php",
			// 	success: function (result) {
			// 		console.log(result);
			// 	}
			// });

			// fungsi untuk menambah row tabel pesanan
			// document.getElementById("jumlah_total").value = sub_total;
			var row = "<tr><td width='7%'><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-trash'></i></a></td><td style='text-align: left;'>Teh Es</td><td style='text-align: center;'><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-plus-circle'></i></a><span style='margin-left: 7px; margin-right: 7px;'>1</span><a href='' title=''><i style='font-size: 18px; color: #2ecc71;' class='fa fa-minus-circle'></i></td><td style='text-align: right;'>Rp. 5.000</td></tr>";
			// var markup = "<tr id='" + rowid + "'' ><td>" + barang + "</td><td>" + harga + "</td><td>" + jumlah + "</td><td>" + sub + "</td><td><button type='button' class='delete-row btn btn-danger' data-sub='" + sub + "' data-id_brg='" + id_brg + "' data-jumlah='" + jumlah + "' data-row ='" + rowid + "'>Delete Row</button></td></tr>";
			var markup = "<tr id='" + rowid + "'><td>1</td><td>1000</td><td>1000</td><td>1</td><td><button type='button' class='delete-row btn btn-danger' data-sub='1' data-id_brg='1' data-jumlah='1000' data-row ='" + rowid + "'>Delete Row</button></td></tr>";
			$("#tbl-pesanan tbody").append(row);
			// loadJumlah(sub_total);
			rowid = rowid + 1;
			// document.getElementById("add-row").disabled = true;
			// document.getElementById("jumlah").disabled = true;
		// }
	});
	// tutup menambah pesanan dalam tabel
  </script>
  </body>
</html>