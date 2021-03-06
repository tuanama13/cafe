<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');
    
    class Produk
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

        function readDrinks()
        {
            $query = "SELECT * FROM tbl_produk WHERE id_kat = 2";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function readFoods()
        {
            $query = "SELECT * FROM tbl_produk WHERE id_kat = 1";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function readSnacks()
        {
            $query = "SELECT * FROM tbl_produk WHERE id_kat = 3";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function searchMenus()
        {
            $query = "SELECT * FROM tbl_produk WHERE nama_produk LIKE :nama";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nama', $this->nama_produk);
            $stmt->execute();

            return $stmt;
        }




        
    }
    