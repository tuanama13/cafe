<?php
include "../init/db.php";
//include "../admin_login.php";
require '../plugins/fpdf/fpdf.php';
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // $this->Image('../dist/img/avatar.png',10,10,20);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(63);
    // Title
    $this->Cell(151,10,'TOKO KARUNIA JAYA',0,1,'C');
    $this->SetFont('Arial','B',13);
    $this->Cell(63);
    // Title
    $this->Cell(151,5,'Laporan Stok Barang',0,1,'C');
    // Line break
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
// $pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','B',12);

    $pdf->Cell(30 ,7,'Kode Barang',1,0);
    $pdf->Cell(87 ,7,'Nama Barang',1,0);
    $pdf->Cell(25 ,7,'Tipe',1,0);
    $pdf->Cell(25 ,7,'Spesifikasi',1,0);
    $pdf->Cell(25 ,7,'Merk',1,0);
    $pdf->Cell(25 ,7,'Stok',1,0);
    $pdf->Cell(25 ,7,'Satuan',1,0);
    $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    $pdf->SetFont('Arial','',12);
    $sql = mysqli_query($conn,"SELECT * FROM list_brg WHERE del=0 ");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->Cell(30 ,8,$row['id_brg'],1,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(87 ,8,$row['nama_brg'],1,0);
        $pdf->Cell(25 ,8,$row['type'],1,0);
        $pdf->Cell(25 ,8,$row['spek'],1,0);
        $pdf->Cell(25 ,8,$row['merk'],1,0);
        $pdf->SetFont('Arial','',12);        
        $pdf->Cell(25 ,8,$row['stok'],1,0);
        $pdf->Cell(25 ,8,$row['satuan'],1,0);
        $pdf->Cell(35 ,8,$row['harga'],1,1,'R');//end of line
    }

$pdf->Output();
?>