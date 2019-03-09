<?php
    // header('Content-type: application/pdf');
    include "../init/db.php";
    require '../functions.php';
    //include "../admin_login.php";
    require '../plugins/fpdf/fpdf.php';

    $tgl_cetak = date("d-m-Y");
    $path = '../init/db.php';
    // $id_transaksi = 'INV2018010000001';

    $tahun = isset( $_GET['tahun']) ?  $_GET['tahun'] : null;
    $bulan = isset( $_GET['bulan']) ?  $_GET['bulan'] : null;
    // $tahun = "2018";
    // $bulan = "01";
    $sql = mysqli_query($conn, "SELECT * FROM tbl_transaksi WHERE YEAR(tanggal) ='$tahun' AND MONTH(tanggal) ='$bulan'");

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
            $this->Cell(161,10,'Golden Bangunan',0,1,'C');
            $this->SetFont('Arial','',12);
            $this->Cell(20);
            $this->Cell(161,10,'Jl. Tanjung Raya 2 (Parit Mayor ) No. 11, Telp : 0813-4858-2358',0,1,'C');
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
    $pdf->Cell(30,7,'Laporan Pendapatan Bulanan',0,1,'C');

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(80);
    $pdf->Cell(30,5,'Bulan : '.bulan((int)$bulan),0,1,'C');
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
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,1,$path)),0,1,'R');
    $pdf->Cell(189 ,5,'',0,1); //dummy
    
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Modal',0,0);
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,2,$path)),0,0,'R');
    $pdf->Cell(40 ,7,'',0,1,'R');

    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Diskon',0,0);
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,3,$path)),0,0,'R');
    $pdf->Cell(40 ,7,'',0,1,'R');
    // $pdf->Cell(189 ,5,'',0,1); //dummy

    // $pdf->Cell(10 ,7,'',0,0);
    // $pdf->Cell(89 ,7,'Retur',0,0);
    // $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,4,$path)),0,0,'R');
    // $pdf->Cell(40 ,7,'',0,1,'R');

    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'Pengeluaran',0,0);
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,4,$path)),0,0,'R');
    $pdf->Cell(40 ,7,'',0,1,'R');

    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(89 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,5,$path)),0,1,'R');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,7,'',0,0);
    $pdf->Cell(129 ,7,'Total',0,0,'R');
    // $pdf->Cell(40 ,7,'',0,0,'R');
    $pdf->Cell(40 ,7,rupiah(total_bulanan($tahun,$bulan,6,$path)),0,1,'R');

    
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(80);
    $pdf->Cell(30,7,'Rincian Penjualan',0,1,'C');
    $pdf->Cell(189 ,5,'',0,1); //dummy
    $pdf->Cell(189 ,5,'',0,1); //dummy

    while ($row = mysqli_fetch_assoc($sql)) {
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(80 ,7,'ID Faktur : '.$row['id_transaksi'],0,0);
        $pdf->Cell(80 ,7,'Tanggal : '.$row['tanggal'],0,1);

        $pdf->Cell(100 ,7,'Nama Barang',1,0);
        $pdf->Cell(16 ,7,'Qty',1,0);
        $pdf->Cell(30 ,7,'Harga',1,0);
        $pdf->Cell(43 ,7,'Subtotal',1,1,'R');//end of line

        $pdf->SetFont('Arial','',9);

        //Numbers are right-aligned so we give 'R' after new line parameter
        $sql1 = mysqli_query($conn,"SELECT * FROM tbl_detail_transaksi INNER JOIN tbl_brg USING(id_barang) WHERE id_transaksi = '$row[id_transaksi]'");
        while ($rows = mysqli_fetch_assoc($sql1)) {
            $total_ =  ((int)$rows['harga_jual'] * (int)$rows['jumlah']);
            $pdf->Cell(100 ,8,$rows['nama_barang'],1,0);
            $pdf->Cell(16 ,8,$rows['jumlah'],1,0);
            $pdf->Cell(30 ,8,rupiah($rows['harga_jual']),1,0);
            $pdf->Cell(43 ,8,rupiah($total_),1,1,'R');//end of line
        }
        $pdf->SetFont('Arial','B',12);

         // Diskon
        $pdf->Cell(116 ,8,'',0,0);
        $pdf->Cell(30 ,8,'Diskon',0,0);
        // $pdf->Cell(9 ,8,'Rp.',1,0);
        $pdf->Cell(43 ,8,rupiah($row['diskon']),1,1,'R');//end of line

        //summary
        $pdf->Cell(116 ,8,'',0,0);
        $pdf->Cell(30 ,8,'Total',0,0);
        // $pdf->Cell(9 ,8,'Rp.',1,0);
        $pdf->Cell(43 ,8,rupiah($row['grandtotal']),1,1,'R');//end of line

        // $pdf->SetFont('Arial','',12);
        // $pdf->Cell(116 ,8,'',0,0);
        // $pdf->Cell(30 ,8,'Jumlah Bayar',0,0);
        // $pdf->Cell(9 ,8,'Rp.',1,0);
        // $pdf->Cell(34 ,8,'$jumlah_bayar',1,1,'R');//end of line

        // $pdf->Cell(116 ,8,'',0,0);
        // $pdf->Cell(30 ,8,'Sisa Bayar',0,0);
        // $pdf->Cell(9 ,8,'Rp.',1,0);
        // $pdf->Cell(34 ,8,$row['sisa_hutang'],1,1,'R');//end of line

        $pdf->Cell(189 ,5,'',0,1); //dummy
        $pdf->Cell(189 ,5,'',0,1); //dummy


    }
    
    
    $pdf->Output('D','Laporan-Bulanan-'.$bulan.'-'.$tahun.'.pdf','T');
    // header('Content-type: application/pdf');
    ob_get_clean();
    // echo "success";
?>
