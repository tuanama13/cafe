<?php
    // header('Content-type: application/pdf');
    include "../init/db.php";
    require '../functions.php';
    require '../plugins/fpdf/fpdf.php';
    $tgl_cetak = date("d-m-Y");
    // $id_transaksi = 'INV2018010000001';

    // $kasir = isset( $_GET['kasir']) ?  $_GET['kasir'] : null;
    // $tgl_ = isset( $_GET['bulan']) ?  $_GET['bulan'] : null;
    // $tahun = "2018";
    $bulan = date("m");
    $tahun = date("Y");

    // if ($kasir == "all") {
    //     $1sql = mysqli_query($conn, "SELECT * FROM tbl_pengeluaran WHERE YEAR(tgl_pengeluaran) ='$tahun'");
    // }else{
    //    header("Location: /tb/laporan/laporan_tahun.php");
    // }


    

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

    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(277,7,'Laporan Retur Rusak',0,1,'C');
    // $pdf->Ln(5);

    $pdf->SetFont('Arial','',14);
    // $pdf->Cell(80);
    $pdf->Cell(277,5,'Bulan : '.bulan((int)$bulan),0,1,'C');
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','',10);
    // $pdf->Cell(10);
    $pdf->Cell(30 ,7,'Tanggal Cetak : '.$tgl_cetak,0,1);


    $sql = mysqli_query($conn,"SELECT * FROM tbl_retur WHERE status_retur = '1'");
    $total_retur = 0;
    while($rows = mysqli_fetch_assoc($sql)){
        $total_retur = ((int)$rows['harga_jual'] * (int)$rows['jumlah']) + $total_retur;
    }

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(35,7,'Total Retur ',0,0);
    $pdf->Cell(50,7,' : '.rupiah($total_retur),0,1);
    $pdf->Ln(5);

    // $pdf->SetFont('Times','',12);
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(15 ,7,'ID Retur',1,0);
    $pdf->Cell(45 ,7,'Tanggal Retur',1,0);
    $pdf->Cell(30 ,7,'ID Transaksi',1,0);
    // $pdf->Cell(30 ,7,'Tanggal Transaksi',1,0);
    $pdf->Cell(110 ,7,'Nama Barang',1,0);
    $pdf->Cell(17 ,7,'Jumlah',1,0);
    $pdf->Cell(30 ,7,'Harga Beli',1,0,'R');
    $pdf->Cell(30 ,7,'Harga Jual',1,1,'R');
    
    // $pdf->Cell(25 ,7,'Stok',1,0);
    // $pdf->Cell(32 ,7,'Satuan',1,1);
    // $pdf->Cell(25 ,7,'Jumlah Barang',1,0);
    // $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    // $pdf->SetFont('Arial','',12);
    $hitung_total = 0;
    $sql = mysqli_query($conn,"SELECT * FROM tbl_retur JOIN tbl_brg USING(id_barang) WHERE status_retur = '1'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(15 ,8,$row['id_faktur'],1,0);
        $pdf->Cell(45 ,8,$row['tgl_faktur'],1,0);
        $pdf->Cell(30 ,8,$row['id_transaksi'],1,0);
        // $pdf->Cell(170 ,8,$row['ket_pengeluaran'],1,0);
        $pdf->Cell(110 ,8,$row['nama_barang'],1,0);
        $pdf->Cell(17 ,8,$row['jumlah'],1,0);
        $pdf->Cell(30 ,8,rupiah($row['harga_beli']),1,0,'R');
        $pdf->Cell(30 ,8,rupiah($row['harga_jual']),1,1,'R');
        

        $hitung_total = ((int)$row['harga_jual'] * (int)$row['jumlah']) + $hitung_total;
    }
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(217 ,7,'',0,0);
    $pdf->Cell(30 ,7,'Total',1,0);
    $pdf->Cell(30 ,7,rupiah($hitung_total),1,1,'R');

    $pdf->Output('D','Laporan-Retur-'.$bulan.'.pdf','T');

    // echo "success";
?>
