<?php  
	include "../init/db.php";
	require '../plugins/fpdf/fpdf.php';
	// $id_transaksi = 'INV2018010000001';

	if (isset($_GET)){
		$id_transaksi = $_GET['id'];
		
	}else{ //print_r($_GET);
		null;
	}

	// $sql = "SELECT * FROM detail_transaksi INNER JOIN toko USING(id_toko)  WHERE id_transaksi='$id_transaksi' AND id_toko = '$id_toko' AND grand_total = '$grand_total'";
	 $sql = "SELECT * FROM tb_detail_transaksi JOIN tb_transaksi USING(kode_transaksi)  WHERE kode_transaksi='$id_transaksi'";
	 $run_sql = mysqli_query($conn,$sql); 
	 $rows = mysqli_fetch_assoc($run_sql);

	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	//create pdf object
	$pdf = new FPDF('P','mm','A4');
	//add new page
	$pdf->AddPage();

	//set font to arial, bold, 14pt
	$pdf->SetFont('Arial','B',16);

	//Cell(width , height , text , border , end line , [align] )

	$pdf->Cell(120 ,5,'TOKO KARUNIA JAYA',0,0);
	$pdf->Cell(59 ,5,'FAKTUR',0,1);//end of line

	//set font to arial, regular, 12pt
	$pdf->SetFont('Arial','',12);

	$pdf->Cell(120 ,5,'Jl. Parit Pangeran,',0,0);
	$pdf->Cell(59 ,5,'',0,1);//end of line

	$pdf->Cell(120 ,5,'Komp. Pangeran Permai 2 No. 18 AA',0,0);
	$pdf->Cell(25 ,5,'Date',0,0);
	$pdf->Cell(34 ,5,$rows['tgl_transaksi'],0,1);//end of line

	$pdf->Cell(120 ,5,'Pontianak',0,0);
	$pdf->Cell(25 ,5,'Invoice #',0,0);
	$pdf->Cell(34 ,5,$id_transaksi,0,1);//end of line

	$pdf->Cell(120 ,5,'Telepon : +62 813 5105 5231',0,0);
	$pdf->Cell(25 ,5,'Customer ID',0,0);
	$pdf->Cell(34 ,5,$rows['id_toko'],0,1);//end of line

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189 ,10,'',0,1);//end of line
	$pdf->Cell(189 ,10,'',0,1);//end of line

	//billing address
	$pdf->Cell(99 ,5,'Bill to :',0,0);//end of line
	$pdf->Cell(90 ,5,'Shipped to :',0,1);

	// font nama toko
	$pdf->SetFont('Arial','B',14);
	//add dummy cell at beginning of each line for indentation
	$pdf->Cell(10 ,5,'',0,0);
	$pdf->Cell(89 ,5,$rows['nama_toko'],0,0);

	if ($rows['nama_toko_hantaran'] != "") {
		$pdf->Cell(10 ,5,'',0,0);
		$pdf->Cell(80 ,5,$rows['nama_toko_hantaran'],0,1);
	}else{
		$pdf->Cell(10 ,5,'',0,0);
		$pdf->Cell(80 ,5,$rows['nama_toko'],0,1);
	}
	// $pdf->Cell(10 ,5,'',0,0);
	// $pdf->Cell(80 ,5,$rows['nama_toko_hantaran'],0,1);

	$pdf->SetFont('Arial','',12);

	$pdf->Cell(10 ,5,'',0,0);
	$pdf->Cell(89 ,5,$rows['alamat_toko'],0,0);

	if ($rows['alamat_toko_hantaran'] != "") {
		$pdf->Cell(10 ,5,'',0,0);
		$pdf->Cell(80 ,5,$rows['alamat_toko_hantaran'],0,1);
	}else{
		$pdf->Cell(10 ,5,'',0,0);
		$pdf->Cell(80 ,5,$rows['alamat_toko'],0,1);
	}

	// $pdf->Cell(10 ,5,'',0,0);
	// $pdf->Cell(80 ,5,$rows['alamat_toko_hantaran'],0,1);

	$pdf->Cell(10 ,5,'',0,0);
	$pdf->Cell(89 ,5,$rows['telp_toko'],0,1);

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189 ,10,'',0,1);//end of line

	//invoice contents
	$pdf->SetFont('Arial','B',12);

	
	$pdf->Cell(100 ,7,'Nama Barang',1,0);
	$pdf->Cell(16 ,7,'Qty',1,0);
	$pdf->Cell(30 ,7,'Harga',1,0);
	$pdf->Cell(43 ,7,'Subtotal',1,1);//end of line

	$pdf->SetFont('Arial','',12);

	//Numbers are right-aligned so we give 'R' after new line parameter
	$sql = mysqli_query($conn,"SELECT * FROM detail_transaksi INNER JOIN list_brg USING(id_brg) WHERE id_transaksi = '$id_transaksi'");
	while ($row = mysqli_fetch_assoc($sql)) {
		
		$pdf->Cell(100 ,8,$row['nama_brg'],1,0);
		$pdf->Cell(16 ,8,$row['jumlah_brg'],1,0);
		$pdf->Cell(30 ,8,$row['harga'],1,0);
		$pdf->Cell(43 ,8,$row['sub_total'],1,1,'R');//end of line
	}
	$pdf->SetFont('Arial','B',12);
	//summary
	$pdf->Cell(116 ,8,'',0,0);
	$pdf->Cell(30 ,8,'Total',0,0);
	$pdf->Cell(9 ,8,'Rp.',1,0);
	$pdf->Cell(34 ,8,$rows['grand_total'],1,1,'R');//end of line

	$pdf->SetFont('Arial','',12);
	$pdf->Cell(116 ,8,'',0,0);
	$pdf->Cell(30 ,8,'Jumlah Bayar',0,0);
	$pdf->Cell(9 ,8,'Rp.',1,0);
	$pdf->Cell(34 ,8,$jumlah_bayar,1,1,'R');//end of line

	$pdf->Cell(116 ,8,'',0,0);
	$pdf->Cell(30 ,8,'Sisa Bayar',0,0);
	$pdf->Cell(9 ,8,'Rp.',1,0);
	$pdf->Cell(34 ,8,$rows['sisa_hutang'],1,1,'R');//end of line

	//output the result
	$pdf->Output();

?>
