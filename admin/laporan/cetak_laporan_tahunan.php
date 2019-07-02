<?php
    // include "../init/db.php";
    $path_ = realpath(__DIR__ . '/../..');
    include_once($path_ . '/init/db.php');
    require '../functions.php';
    //include "../admin_login.php";
    require $path_.'/plugins/fpdf/fpdf.php';
    $tgl_cetak = date("d-m-Y");
    $path = $path_.'/init/db.php';
    // $id_transaksi = 'INV2018010000001';

    $tahun = isset( $_GET['tahun']) ?  $_GET['tahun'] : null;
    // $bulan = isset( $_GET['bulan']) ?  $_GET['bulan'] : null;
    // $tahun = "2018";
    // $bulan = "01";
    $sql = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE YEAR(tgl_order) ='$tahun'");

    class PDF extends FPDF
    {
// Page header
        
        function Header()
        {
            $this->SetFont('Arial','B',16);
            // Move to the right
            $this->Cell(20);
            // Logo
            $this->Image('../Golden_logo-mini.png',25,6,23,20);
            // Title
            $this->SetFont('Arial','B',30);
            $this->Cell(161,10,'Inland Cafe',0,1,'C');
            $this->SetFont('Arial','',12);
            $this->Cell(20);
            $this->Cell(161,10,'Jl. Siam, Pontianak',0,1,'C');
            // $this->Ln(7);
            $this->SetLineWidth(1.7);
            $this->Line(10, 32, 198, 32);

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


    // Max width for Potrait 189
    $pdf = new PDF('P','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(80);
    $pdf->Cell(30,7,'Laporan Pendapatan Tahunan',0,1,'C');

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(80);
    $pdf->Cell(30,5,'Tahun : '.$tahun,0,1,'C');
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10);
    $pdf->Cell(30 ,7,'Tanggal Cetak : '.$tgl_cetak,0,1);
    
    $pdf->Cell(189 ,5,'',0,1); //dummy
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','',12);
    
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Hasil Penjualan',0,0);
    $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_tahunan($tahun,1,$path)),0,1,'R');
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Pengeluaran',0,0);
    $pdf->Cell(40 ,7,rupiah(total_tahunan($tahun,2,$path)),0,0,'R');
    $pdf->Cell(40 ,7,'',0,1,'R');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(129 ,7,'Total',0,0,'R');
    // $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_tahunan($tahun,3,$path)),0,1,'R');

    $pdf->Output('D','Laporan-Tahunan-'.$tahun.'.pdf','T');

    echo "success";
?>
