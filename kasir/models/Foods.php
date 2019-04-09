<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    
    class Food
    {
        private $conn;
        public $id_produk;
        public $id_kat;
        public $nama_produk;
        public $desc_produk;
        public $image_produk;
        public $harga_produk;
        public $status_produk;
        public $logs;       
        

        function __construct($db) {
            $this->conn = $db;
        }

        function readFoods()
        {
            $query = "SELECT * FROM tbl_produk WHERE id_kat = 1";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        
    }
    