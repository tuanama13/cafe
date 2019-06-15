<?php
	

	function rupiah($angka){
	
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
 
	}

	function norupiah($angka){
	
		$hasil_rupiah = number_format($angka,0,',','.');
		return $hasil_rupiah;
 
	}

	function bulan($angka)
	{
		$bulan = array (1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		return $bulan[$angka];
	}


	function total_tahunan($tahun,$angka,$path)
	{
		include $path;
		$sql_1 = mysqli_query($conn,"SELECT SUM(grandtotal) AS GrandTotal FROM tbl_orders WHERE YEAR(tgl_order) ='$tahun'");
	    $rows_1 = mysqli_fetch_assoc($sql_1);

	    $sql_2 = mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS Total FROM tbl_pengeluaran WHERE YEAR(tgl_pengeluaran) ='$tahun'");
	    $rows_2 = mysqli_fetch_assoc($sql_2);

	    // $sql_3 = mysqli_query($conn,"SELECT * FROM tbl_retur WHERE YEAR(tgl_faktur) ='$tahun'");
	    // // $rows_3 = mysqli_fetch_assoc($sql_3);
	    // $total_retur = 0;
	    // while($rows_3 = mysqli_fetch_assoc($sql_3)){
	    //     $total_retur = ((int)$rows_3['harga_jual'] * (int)$rows_3['jumlah']) + $total_retur;
	    // }

	    $penjualan = (int)$rows_1['GrandTotal'];
	    // $diskon = (int)$rows_1['Diskon'];
	    // $modal = (int)$rows_1['Modal'];
	    $pengeluaran = (int)$rows_2['Total'];
	    // $retur = (int)$total_retur;

	    // $total_beban = $modal + $pengeluaran + $diskon;
	    // $total = $penjualan - $total_beban ;
		$total = $penjualan - $pengeluaran;


	    // $total_tahunan = array (1 =>   $penjualan,
		// 	$modal,
		// 	$diskon,
		// 	$pengeluaran,
		// 	$total_beban,
		// 	$total
		// );

		$total_tahunan = array(1 => $penjualan, $pengeluaran, $total);

		return $total_tahunan[$angka];
	}

	function total_bulanan($tahun,$bulan,$angka,$path)
	{
		include $path;
		$sql_1 = mysqli_query($conn,"SELECT SUM(grandtotal) AS GrandTotal FROM tbl_orders WHERE YEAR(tgl_order) ='$tahun' AND MONTH(tgl_order) ='$bulan'");
	    $rows_1 = mysqli_fetch_assoc($sql_1);

	    $sql_2 = mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS Total FROM tbl_pengeluaran WHERE YEAR(tgl_pengeluaran) ='$tahun' AND MONTH(tgl_pengeluaran) ='$bulan'");
	    $rows_2 = mysqli_fetch_assoc($sql_2);

	//    $sql_3 = mysqli_query($conn,"SELECT * FROM tbl_retur WHERE YEAR(tgl_faktur) ='$tahun' AND MONTH(tgl_faktur) ='$bulan'");
	    // $rows_3 = mysqli_fetch_assoc($sql_3);
	    // $total_retur = 0;
	    // while($rows_3 = mysqli_fetch_assoc($sql_3)){
	    //     $total_retur = ((int)$rows_3['harga_jual'] * (int)$rows_3['jumlah']) + $total_retur;
	    // }

	    $penjualan = (int)$rows_1['GrandTotal'];
	    // $diskon = (int)$rows_1['Diskon'];
	    // $modal = (int)$rows_1['Modal'];
	    $pengeluaran = (int)$rows_2['Total'];
	    // $retur = (int)$total_retur;

	    // $total_beban = $modal + $pengeluaran + $diskon;
	    $total = $penjualan - $pengeluaran ;

	    $total_bulanan = array (1 =>   $penjualan,
			$pengeluaran,
			$total
		);

		return $total_bulanan[$angka];
	}

	function total_harian($tgl_,$angka,$path)
	{	
		include $path;
		$sql_1 = mysqli_query($conn,"SELECT SUM(grandtotal) AS GrandTotal FROM tbl_orders WHERE DATE(tgl_order) ='$tgl_'");
	    $rows_1 = mysqli_fetch_assoc($sql_1);

	    $sql_2 = mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS Total FROM tbl_pengeluaran WHERE DATE(tgl_pengeluaran) ='$tgl_'");
	    $rows_2 = mysqli_fetch_assoc($sql_2);

	    // $sql_3 = mysqli_query($conn,"SELECT * FROM tbl_retur WHERE DATE(tgl_faktur) ='$tgl_'");
	    // // $rows_3 = mysqli_fetch_assoc($sql_3);
	    // $total_retur = 0;
	    // while($rows_3 = mysqli_fetch_assoc($sql_3)){
	    //     $total_retur = ((int)$rows_3['harga_jual'] * (int)$rows_3['jumlah']) + $total_retur;
	    // }

	    $penjualan = (int)$rows_1['GrandTotal'];
	    // $diskon = (int)$rows_1['Diskon'];
	    // $modal = (int)$rows_1['Modal'];
	    $pengeluaran = (int)$rows_2['Total'];
	    // $retur = (int)$total_retur;

	    // $total_beban = $modal + $pengeluaran + $diskon;
	    //$total = $penjualan - $total_beban ;
		$total = $penjualan - $pengeluaran;
	    // $total_harian = array (1 =>   $penjualan,
		// 	$modal,
		// 	$diskon,
		// 	$pengeluaran,
		// 	$total_beban,
		// 	$total
		// );

		$total_harian = array(1 => $penjualan, 
								$pengeluaran, 
								$total);

		return $total_harian[$angka];
	}
?>