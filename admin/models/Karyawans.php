<?php 
	$path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    class Karyawan
    {
        private $conn;
        public $id_pegawai;
    	public $nama_pegawai;
    	public $alamat_pegawai;
        public $kontak_pegawai;
        public $posisi_pegawai;
        public $logs;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        function readKaryawan($id_pegawai)
        {
            $query = "SELECT * FROM tbl_pegawai WHERE id_pegawai = :id_pegawai";

            $stmt = $this->conn->prepare($query);
            $stmt->execute(array('id_pegawai' => $id_pegawai));

            return $stmt;
        }
    }
    