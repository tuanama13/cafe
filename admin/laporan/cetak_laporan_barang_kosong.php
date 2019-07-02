<?php
include "../init/db.php";
require '../functions.php';
$tgl_cetak = date("d-m-Y");
//include "../admin_login.php";
require '../plugins/fpdf/fpdf.php';
class PDF extends FPDF
{
// Page header
function Header()
{
   
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(23);
    // Logo
    $this->Image('../Golden_logo-mini.png',10,6,23,20);
    // Title
    $this->SetFont('Arial','B',30);
    $this->Cell(237,10,'Inland Cafe',0,1,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(23);
    $this->Cell(237,10,'Jl. Siam, Pontianak',0,1,'L');
    // $this->Ln(7);
    $this->SetLineWidth(1.7);
    $this->Line(10, 32, 286, 32);


    $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
// A4 Landscape size = 297 mm
// max width size = 297 - (10*2) =>  277
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',15);
$pdf->Cell(277,7,'Laporan Barang Kosong',0,1,'C');
$pdf->Ln(7);

$pdf->SetFont('Arial','',15);
$pdf->Cell(277,7,'Tanggal Cetak : '.$tgl_cetak,0,1,'C');
$pdf->Ln(7);

// $pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','B',12);
    
    $pdf->Cell(12 ,7,'No',1,0,'C');
    $pdf->Cell(30 ,7,'ID Barang',1,0);
    $pdf->Cell(140 ,7,'Nama Barang',1,0);
    $pdf->Cell(28 ,7,'Harga Beli',1,0);
    $pdf->Cell(28 ,7,'Harga Jual',1,0);
    $pdf->Cell(19 ,7,'Stok',1,0,'C');
    $pdf->Cell(20 ,7,'Satuan',1,1);
    // $pdf->Cell(25 ,7,'Jumlah Barang',1,0);
    // $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    $no = 1;
    $pdf->SetFont('Arial','',12);
    $sql = mysqli_query($conn,"SELECT * FROM tbl_brg WHERE stok<= 5  ORDER BY stok ASC");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->Cell(12 ,8,$no++,1,0,'C');
        $pdf->Cell(30 ,8,$row['id_barang'],1,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(140 ,8,$row['nama_barang'],1,0);
        $pdf->Cell(28 ,8,rupiah($row['harga_beli']),1,0,'R');
        $pdf->Cell(28 ,8,rupiah($row['harga_jual']),1,0,'R');
        $pdf->Cell(19 ,8,$row['stok'],1,0,'C');
        $pdf->SetFont('Arial','',12);        
        $pdf->Cell(20 ,8,$row['satuan'],1,1);
        // $pdf->Cell(25 ,8,$row['satuan'],1,0);
        // $pdf->Cell(35 ,8,$row['harga'],1,1,'R');//end of line
    }

$pdf->Output('D','Laporan_Barang_Kosong.pdf','T');
?>