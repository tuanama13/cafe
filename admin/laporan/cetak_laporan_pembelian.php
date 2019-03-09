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
    $pdf->Cell(277,7,'Laporan Pembelian',0,1,'C');
    // $pdf->Ln(5);

    // $pdf->SetFont('Arial','',14);
    // // $pdf->Cell(80);
    // $pdf->Cell(277,5,'Bulan : '.bulan((int)$bulan),0,1,'C');
    // $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','',10);
    // $pdf->Cell(10);
    $pdf->Cell(30 ,7,'Tanggal Cetak : '.$tgl_cetak,0,1);


    $sql = mysqli_query($conn,"SELECT SUM(sisa_hutang) AS Sisa_ FROM tbl_piutang");
    $sisa_hutang = 0;
    while($rows = mysqli_fetch_assoc($sql)){
        $sisa_hutang = $rows['Sisa_'];
    }

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(35,7,'Sisa Hutang',0,0);
    $pdf->Cell(50,7,' : '.rupiah($sisa_hutang),0,1);
    $pdf->Ln(5);

    // $pdf->SetFont('Times','',12);
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(27 ,7,'Kode Pembelian',1,0);
    $pdf->Cell(37 ,7,'Kode Transaksi',1,0);
    $pdf->Cell(27 ,7,'Tanggal Masuk',1,0);
    // $pdf->Cell(30 ,7,'Tanggal Transaksi',1,0);
    $pdf->Cell(27 ,7,'Tanggal Bayar',1,0);
    $pdf->Cell(32 ,7,'Total Pembelian',1,0);
    $pdf->Cell(32 ,7,'Total Bayar',1,0);
    
    $pdf->Cell(20 ,7,'Status',1,0);
    $pdf->Cell(44 ,7,'Supplier',1,0);
    $pdf->Cell(31 ,7,'Sisa',1,1);
    
    // $pdf->Cell(25 ,7,'Stok',1,0);
    // $pdf->Cell(32 ,7,'Satuan',1,1);
    // $pdf->Cell(25 ,7,'Jumlah Barang',1,0);
    // $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    // $pdf->SetFont('Arial','',12);
    $hitung_total = 0;
    $sql = mysqli_query($conn,"SELECT * FROM tbl_piutang ORDER BY status DESC");
    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(27 ,7,$row['kode_piutang'],1,0);
        $pdf->Cell(37 ,7,$row['kode_transaksi'],1,0);
        $pdf->Cell(27 ,7,date_format(date_create($rows['tgl_masuk']),"d-m-Y"),1,0);
        // $pdf->Cell(170 ,8,$row['ket_pengeluaran'],1,0);
        $pdf->Cell(27 ,7,date_format(date_create($rows['tgl_lunas']),"d-m-Y"),1,0);
        $pdf->Cell(32 ,7,rupiah($row['total_piutang']),1,0);
        $pdf->Cell(32 ,7,rupiah($row['total_dibayar']),1,0);
        
        // $pdf->Cell(27 ,7,$row['tgl_lunas'],1,0);
        if ($row['status']== '1') {
            $status_ = "Hutang";
        }else {
            $status_ = "Lunas";
        }
        $pdf->Cell(20 ,7,$status_,1,0);
        $pdf->Cell(44 ,7,$row['supplier'],1,0);
        $pdf->Cell(31 ,7,rupiah($row['sisa_hutang']),1,1,'R');
        

        // $hitung_total = ((int)$row['harga_jual'] * (int)$row['jumlah']) + $hitung_total;
    }
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(202 ,7,'',0,0);
    $pdf->Cell(44 ,7,'Total',1,0);
    $pdf->Cell(31 ,7,rupiah($sisa_hutang),1,1,'R');

    $pdf->Output('D','Laporan-Pembelian.pdf','T');

    // echo "success";
?>
