<?php
    // header('Content-type: application/pdf');
    // include "../init/db.php";
    $path_ = realpath(__DIR__ . '/../..');
    include_once($path_ . '/init/db.php');

    require '../functions.php';
    require $path_.'/plugins/fpdf/fpdf.php';
    $tgl_cetak = date("d-m-Y");
    $path = $path_ . '/init/db.php';// '../init/db.php';
    // $id_transaksi = 'INV2018010000001';

    $kasir = isset( $_GET['kasir']) ?  $_GET['kasir'] : null;
    $tgl_ = isset( $_GET['tgl']) ?  $_GET['tgl'] : null;
    // $tahun = "2018";
    // $bulan = "01";

    if ($kasir == "all") {
        $sql = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE DATE(tgl_order) ='$tgl_'");
    }else{
       header("Location: /cafe/admin/laporan/laporan_penjualan.php");
    }


    

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
    $pdf->Cell(30,7,'Laporan Pendapatan',0,1,'C');

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(80);
    $pdf->Cell(30,5,'Kasir : '.$kasir,0,1,'C');
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','I',11);
    $pdf->Cell(30 ,7,'Tanggal Cetak : '.$tgl_cetak,0,1);
    $pdf->Cell(189 ,5,'',0,1); //dummy

    $pdf->SetFont('Arial','',12);
    
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Hasil Penjualan',0,0);
    $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,1,$path)),0,1,'R');
    $pdf->Cell(189 ,5,'',0,1); //dummy
    
    // $pdf->Cell(10 ,7,'',0,0);
    // $pdf->Cell(89 ,7,'Modal',0,0);
    // $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,2,$path)),0,0,'R');
    // $pdf->Cell(40 ,7,'',0,1,'R');

    // $pdf->Cell(10 ,7,'',0,0);
    // $pdf->Cell(89 ,7,'Diskon',0,0);
    // $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,3,$path)),0,0,'R');
    // $pdf->Cell(40 ,7,'',0,1,'R');
    // $pdf->Cell(189 ,5,'',0,1); //dummy

    // $pdf->Cell(10 ,7,'',0,0);
    // $pdf->Cell(89 ,7,'Retur',0,0);
    // $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,4,$path)),0,0,'R');
    // $pdf->Cell(40 ,7,'',0,1,'R');

    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Pengeluaran',0,0);
    $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,2,$path)),0,0,'R');
    $pdf->Cell(40 ,7,'',0,1,'R');

    // $pdf->Cell(10 ,7,'',0,0);
    // $pdf->Cell(89 ,7,'',0,0,'R');
    // $pdf->Cell(40 ,7,'',0,0,'R');
    // $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,3,$path)),0,1,'R');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(129 ,7,'Total',0,0,'R');
    // $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_harian($tgl_,3,$path)),0,1,'R');

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(80);
    $pdf->Cell(30,7,'Rincian Penjualan',0,1,'C');
    $pdf->Cell(189 ,5,'',0,1); //dummy
    $pdf->Cell(189 ,5,'',0,1); //dummy

    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(80 ,7,'ID Transaksi : '.$row['id_order'],0,0);
        $pdf->Cell(80 ,7,'Tanggal : '.$row['tgl_order'],0,1);

        $pdf->Cell(13 ,7,'No',1,0,'C');
        $pdf->Cell(100 ,7,'Nama Barang',1,0);
        $pdf->Cell(16 ,7,'Qty',1,0,'C');
        $pdf->Cell(30 ,7,'Harga',1,0);
        $pdf->Cell(30 ,7,'Subtotal',1,1,'R');//end of line

        $pdf->SetFont('Arial','',9);
        
        $id_order = $row['id_order'];
        $no_ = 1;
        //Numbers are right-aligned so we give 'R' after new line parameter
        $sql1 = mysqli_query($conn,"SELECT * FROM tbl_detail_order INNER JOIN tbl_produk USING(id_produk) WHERE id_order = $id_order");
        while ($rows = mysqli_fetch_assoc($sql1)) {
            $total_ =  ((int)$rows['harga_produk'] * (int)$rows['jumlah_order']);
            $pdf->Cell(13 ,8,$no_,1,0,'C');
            $pdf->Cell(100 ,8,$rows['nama_produk'],1,0);
            $pdf->Cell(16 ,8,$rows['jumlah_order'],1,0,'C');
            $pdf->Cell(30 ,8,rupiah($rows['harga_produk']),1,0);
            $pdf->Cell(30 ,8,rupiah($total_),1,1,'R');//end of line

            $no_++;
        }
        $pdf->SetFont('Arial','B',12);
        //summary
        // Diskon
        // $pdf->Cell(116 ,8,'',0,0);
        // $pdf->Cell(30 ,8,'Diskon',0,0);
        // // $pdf->Cell(9 ,8,'Rp.',1,0);
        // $pdf->Cell(43 ,8,rupiah($row['diskon']),1,1,'R');//end of line

        // Grand Total
        $pdf->Cell(129 ,8,'',0,0);
        $pdf->Cell(30 ,8,'Total',0,0);
        // $pdf->Cell(9 ,8,'Rp.',1,0);
        $pdf->Cell(30 ,8,rupiah($row['grandtotal']),1,1,'R');//end of line
    
        $pdf->Cell(189 ,5,'',0,1); //dummy
        $pdf->Cell(189 ,5,'',0,1); //dummy
    }

    $pdf->Output('D','Laporan-Harian.pdf','T');

    // echo "success";
?>
