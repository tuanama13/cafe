<?php  
	include "../init/db.php";
	//include "../admin_login.php";
	require '../plugins/fpdf/fpdf.php';

	class PDF extends FPDF
	{
	// Page header
		function Header()
		{
			$this->SetFont('Arial','B',15);
		    $this->Cell(20);
		    // Logo
		    $this->Image('avatar.png',10,10,10);
		    // Arial bold 15
		  
		    // Move to the right
		    // $this->Cell(80);
		    // Title
		    $this->Cell(100,10,'Title',0,1,'C');
		    // Line break
		    // $this->Ln(20);
		}

	// Page footer
		function Footer()
		{
			$this->SetFont('Arial','B',15);
			$this->Cell(100,10,'Title',0,1,'C');   
		}
	}
	
	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	//create pdf object
	$pdf = new FPDF('P','mm','A4');
	// $pdf->AliasNbPages();
	//add new page
	$pdf->AddPage();

	//set font to arial, bold, 16pt
	// $pdf->SetFont('Arial','B',16);

	// //Cell(width , height , text , border , end line , [align] )
	// $pdf->Cell(34 ,5,'',0,0);
	// $pdf->Cell(121 ,5,'TOKO KARUNIA JAYA',0,0,'C');
	// $pdf->Cell(34 ,5,'',0,1);//end of line

	// $pdf->SetFont('Arial','',12);
	// $pdf->Cell(34 ,5,'',0,0);
	// $pdf->Cell(121 ,5,'Laporan Stok Barang',0,0,'C');
	// $pdf->Cell(34 ,5,'',0,1);//end of line

	// $pdf->Cell(189 ,5,'',0,1);//end of line
	// $pdf->Cell(189 ,5,'',0,1);//end of line


	//List Barang contents
	$pdf->SetFont('Arial','B',12);

	$pdf->Cell(30 ,7,'Kode Barang',1,0);
	$pdf->Cell(74 ,7,'Nama Barang',1,0);
	$pdf->Cell(25 ,7,'Stok',1,0);
	$pdf->Cell(25 ,7,'Satuan',1,0);
	$pdf->Cell(35 ,7,'Harga',1,1);//end of line

	//$pdf->SetFont('Arial','',12);


	//output the result
	$pdf->Output();

?>
