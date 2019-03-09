<?php
include "../init/db.php";
require '../functions.php';
//include "../admin_login.php";
require '../plugins/fpdf/fpdf.php';
$tgl_cetak = date("d-m-Y");

class PDF extends FPDF
{
// Page header
function Header()
{
     $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(20);
    // Logo
    // Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
    $this->Image('../Golden_logo-mini.png',10,6,23,20);
    // Title
    $this->SetFont('Arial','B',30);
    $this->Cell(5);
    // Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
    $this->Cell(230,10,'Golden Bangunan',0,1,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(25);
    $this->Cell(230,10,'Jl. Tanjung Raya 2 (Parit Mayor ) No. 11, Telp : 0813-4858-2358',0,1,'L');
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

$pdf->SetFont('Arial','B',16);
$pdf->Cell(277,7,'Laporan Barang',0,1,'C');
$pdf->Ln(7);

$pdf->SetFont('Arial','',12);
$pdf->Cell(35 ,7,'Tanggal Cetak',0,0);
$pdf->Cell(50,7,' : '.$tgl_cetak,0,1);


$sql = mysqli_query($conn,"SELECT harga_beli, stok FROM tbl_brg");
$hitung_aset = 0;
while($rows = mysqli_fetch_assoc($sql)){
    $hitung_aset = ((int)$rows['harga_beli'] * (int)$rows['stok']) + $hitung_aset;
}

$pdf->SetFont('Arial','B',16);
$pdf->Cell(35,7,'Aset Saat Ini',0,0);
$pdf->Cell(50,7,' : '.rupiah($hitung_aset),0,1);
$pdf->Ln(5);

// $pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','B',10);

    $pdf->Cell(14 ,7,'No',1,0,'C');
    $pdf->Cell(30 ,7,'Kode Barang',1,0);
    $pdf->Cell(112 ,7,'Nama Barang',1,0);
    $pdf->Cell(25 ,7,'Stok',1,0);
    $pdf->Cell(24 ,7,'Satuan',1,0);
    $pdf->Cell(36 ,7,'Harga Beli',1,0,'R');
    $pdf->Cell(36 ,7,'Harga Jual',1,1,'R');
    //end of line
    $no = 1;
    $pdf->SetFont('Arial','',12);
    $sql = mysqli_query($conn,"SELECT * FROM tbl_brg");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->Cell(14 ,8,$no++,1,0,'C');
        $pdf->Cell(30 ,8,$row['id_barang'],1,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(112 ,8,$row['nama_barang'],1,0);
        $pdf->Cell(25 ,8,$row['stok'],1,0);
        $pdf->Cell(24 ,8,$row['satuan'],1,0);
        $pdf->SetFont('Arial','',12);    
        $pdf->Cell(36 ,8,rupiah($row['harga_beli']),1,0,'R');            
        $pdf->Cell(36 ,8,rupiah($row['harga_jual']),1,1,'R');//end of line
    }
// header('Content-type: application/pdf');
$pdf->Output('D','Laporan_Barang.pdf','T');
// header('Content-type: application/pdf');
?>