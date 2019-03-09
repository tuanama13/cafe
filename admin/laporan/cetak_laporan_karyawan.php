<?php
include "../init/db.php";
//include "../admin_login.php";
require '../plugins/fpdf/fpdf.php';
class PDF extends FPDF
{
// Page header
function Header()
{
   
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(20);
    // Logo
    $this->Image('../Logo2-mini.png',10,10,20,20);
    // Title
    $this->SetFont('Arial','B',30);
    $this->Cell(237,10,'CV. PURNAMA KARYA',0,1,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(20);
    $this->Cell(237,10,'Jl. Purnama No. 63, Telp : 0561-764066',0,1,'L');
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
$pdf->Cell(277,7,'Laporan Data Karyawan',0,1,'C');
$pdf->Ln(5);

// $pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','B',10);

    $pdf->Cell(25 ,7,'ID Karyawan',1,0,'C');
    $pdf->Cell(40 ,7,'Nama Karyawan',1,0,'C');
    $pdf->Cell(107 ,7,'Alamat Karyawan',1,0,'C');
    $pdf->Cell(30 ,7,'Telepon',1,0,'C');
    $pdf->Cell(25 ,7,'Tanggal Lahir',1,0,'C');
    $pdf->Cell(25 ,7,'Level',1,0,'C');
    $pdf->Cell(25 ,7,'Mulai Bekerja',1,1,'C');//end of line

    // $pdf->SetFont('Arial','',12);
    $pdf->SetFont('Arial','',10);
    $sql = mysqli_query($conn,"SELECT * FROM tb_karyawan WHERE del=0");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->Cell(25 ,8,$row['id_karyawan'],1,0);
        
        $pdf->Cell(40 ,8,$row['nama'],1,0);
        $pdf->Cell(107 ,8,$row['alamat'],1,0);
        $pdf->Cell(30 ,8,$row['no_telp'],1,0);
        $pdf->Cell(25 ,8,$row['tgl_lahir'],1,0);
        // $pdf->SetFont('Arial','',10);        
        $pdf->Cell(25 ,8,$row['level'],1,0);
        $pdf->Cell(25 ,8,$row['tgl_masuk'],1,1);
        // $pdf->Cell(35 ,8,$row['harga'],1,1,'R');//end of line
    }

$pdf->Output();
?>