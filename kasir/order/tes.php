<?php
// include "../init/db.php";
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    include_once '../models/Orders.php';
    include_once $path.'/kasir/functions.php';
    // require '../functions.php';
    $tgl_cetak = date("d/m/Y");
    //include "../admin_login.php";
    require $path.'/plugins/fpdf/fpdf.php';

    if (empty($_POST['id_order'])) {
        $id_order = $_POST['id_order'];
        $bayar = $_POST['bayar'];
        $kembali = $_POST['kembali'];
        # code...
        $database = new Database();
        $db = $database->connect();
        $order = new Order($db);
        $result_ = $order->cetakOrders($id_order);
        $result = $order->readDetailOrders($id_order);
        $row = $result_->fetch();
    }else{
        header("Location:../table.php");
    }


    

    $p = 0;
    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        $this->SetTopMargin(5);
        $this->SetFont('Arial','B',9);
        // Move to the right
        // $this->Cell();
        // Logo
        // $this->Image('../Golden_logo-mini.png',10,6,23,20);
        // Title
        $this->SetFont('Arial','B',9);
        $this->Cell(60,4,'Inland Cafe',0,1,'C');
        $this->SetFont('Arial','',8);
        // $this->Cell(23);
        $this->Cell(60,4,'Jl. Siam No.55, ',0,1,'C');
        $this->Cell(60,4,'Pontianak',0,1,'C');
        $this->Cell(60,4,'Tlp : 0812345677',0,1,'C');
        // $this->Ln(7);
        // $this->SetLineWidth(1.7);
        // $this->Line(10, 32, 286, 32);


        $this->Ln(10);
        // $p = 26;

    }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',7);
            // Page number
            // $this->Cell(60,5,'Terima Kasih Telah Berkunjung',0,0,'C');
            // $p =$p + 5;
        }
    }

    
    // Instanciation of inherited class
    // A4 Landscape size = 297 mm
    // max width size = 297 - (10*2) =>  277

    // $p = 80;
    // New Size 70 * panjang_kertas
    $pdf = new PDF('P','mm',array(80,100));
    // $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(false);
    $pdf->AddPage();
    

    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,2,'Kasir : ',0,0,'L');
    $pdf->Cell(20,2,$row['username_user'],0,0,'L');
    $pdf->Cell(30,2,$tgl_cetak,0,1,'R');
    // $pdf->Ln(4);
    // $pdf->SetFont('Arial','',7);
    $pdf->Cell(60,2,'-----------------------------------------------------------------------',0,1,'L');
    $pdf->Cell(10,3,'Order : ',0,0,'L');
    $pdf->Cell(50,3,$row['id_order'],0,1,'L');
    $pdf->Cell(10,3,'Meja  : ',0,0,'L');
    $pdf->Cell(50,3,$row['no_meja'],0,1,'L');
    
    // $pdf->SetFont('Arial','',7);
    $pdf->Cell(60,2,'-----------------------------------------------------------------------',0,1,'L');

    foreach ($result as $value) {
        $pdf->Cell(5,3,$value['jumlah_order'],0,0,'L');
        $pdf->Cell(40,3,$value['nama_produk'],0,0,'L');
        $pdf->Cell(15,3,norupiah($value['harga_produk']),0,1,'R');
        
        $p = $p + 3;
    }
    
    // $pdf->Cell(5,3,'1',0,0,'L');
    // $pdf->Cell(40,3,'Kopi Saring',0,0,'L');
    // $pdf->Cell(15,3,'Rp 75000',0,1,'L');

    // $pdf->Cell(5,3,'1',0,0,'L');
    // $pdf->Cell(40,3,'Teh Es',0,0,'L');
    // $pdf->Cell(15,3,'Rp 4000',0,1,'L');
    
    // Space
    $pdf->Ln(4);

    $pdf->Cell(60,2,'-----------------------------------------------------------------------',0,1,'L');
    $pdf->Cell(30,3,'Total',0,0,'L');
    $pdf->Cell(15,3,'Rp',0,0,'R');
    $pdf->Cell(15,3,norupiah($row['grandtotal']),0,1,'R');

    $pdf->Cell(30,3,'Bayar',0,0,'L');
    $pdf->Cell(15,3,'Rp',0,0,'R');
    $pdf->Cell(15,3,norupiah($bayar),0,1,'R');
    
    $pdf->Cell(30,3,'Kembalian',0,0,'L');
    $pdf->Cell(15,3,'Rp',0,0,'R');
    $pdf->Cell(15,3,norupiah($kembali),0,1,'R');

    // $pdf->SetFont('Arial','',7);
    // $pdf->Cell(60,5,'Tanggal Cetak : '.$tgl_cetak,0,1,'C');
    // $pdf->Ln(5);

    // $pdf->SetFont('Times','',12);
    // $pdf->SetFont('Arial','B',12);
        
    //     $pdf->Cell(12 ,7,'No',1,0,'C');
    //     $pdf->Cell(30 ,7,'ID Barang',1,0);
    //     $pdf->Cell(140 ,7,'Nama Barang',1,0);
    //     $pdf->Cell(28 ,7,'Harga Beli',1,0);
    //     $pdf->Cell(28 ,7,'Harga Jual',1,0);
    //     $pdf->Cell(19 ,7,'Stok',1,0,'C');
    //     $pdf->Cell(20 ,7,'Satuan',1,1);
    //     // $pdf->Cell(25 ,7,'Jumlah Barang',1,0);
    //     // $pdf->Cell(35 ,7,'Harga',1,1);//end of line

    //     $no = 1;
    //     $pdf->SetFont('Arial','',12);
    //     $sql = mysqli_query($conn,"SELECT * FROM tbl_brg WHERE stok<= 5  ORDER BY stok ASC");
    //     while ($row = mysqli_fetch_assoc($sql)) {
    //         $pdf->Cell(12 ,8,$no++,1,0,'C');
    //         $pdf->Cell(30 ,8,$row['id_barang'],1,0);
    //         $pdf->SetFont('Arial','',10);
    //         $pdf->Cell(140 ,8,$row['nama_barang'],1,0);
    //         $pdf->Cell(28 ,8,rupiah($row['harga_beli']),1,0,'R');
    //         $pdf->Cell(28 ,8,rupiah($row['harga_jual']),1,0,'R');
    //         $pdf->Cell(19 ,8,$row['stok'],1,0,'C');
    //         $pdf->SetFont('Arial','',12);        
    //         $pdf->Cell(20 ,8,$row['satuan'],1,1);
    //         // $pdf->Cell(25 ,8,$row['satuan'],1,0);
    //         // $pdf->Cell(35 ,8,$row['harga'],1,1,'R');//end of line
    //     }

    $pdf->Output('D','tes.pdf','T');
    ?>