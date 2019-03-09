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
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'TOKO KARUNIA JAYA',0,0,'C');
    // Line break
    $this->Ln(20);
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
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
// $pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','B',12);

    $pdf->Cell(30 ,7,'Kode Barang',1,0);
    $pdf->Cell(74 ,7,'Nama Barang',1,0);
    $pdf->Cell(25 ,7,'Stok',1,0);
    $pdf->Cell(25 ,7,'Satuan',1,0);
    $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    $pdf->SetFont('Arial','',12);
    $sql = mysqli_query($conn,"SELECT * FROM list_brg");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->Cell(30 ,8,$row['id_brg'],1,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(74 ,8,$row['nama_brg'],1,0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25 ,8,$row['stok'],1,0);
        $pdf->Cell(25 ,8,$row['satuan'],1,0);
        $pdf->Cell(35 ,8,$row['harga'],1,1,'R');//end of line
    }

$pdf->Output();
?>