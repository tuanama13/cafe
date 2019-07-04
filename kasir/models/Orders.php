<?php
    $path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');

    class Order
    {
        private $conn;

        //tbl_order
        public $id_order;
        public $no_meja;
        public $id_cabang;
        public $id_user;
        public $tgl_order;
        public $grandtotal;
        public $logs;

        //tbl_detail_order
        public $id_detail_order;
        // public $id_order;
        public $id_produk;
        public $jumlah_order;
        public $harga_produk;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        function readOrders()
        {
            $query = "SELECT * FROM tbl_orders WHERE grandtotal != 0 ORDER BY tgl_order DESC LIMIT 5";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function readOrdersAll()
        {
            $query = "SELECT * FROM tbl_orders WHERE grandtotal != 0 ORDER BY tgl_order DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function readDetailOrders($id)
        {
            $query = "SELECT * FROM tbl_detail_order INNER JOIN tbl_produk USING(id_produk) WHERE id_order='$id'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function cetakOrders($id)
        {
            $query = "SELECT * FROM tbl_orders INNER JOIN tbl_user USING(id_user) WHERE id_order='$id'";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function createOrder()
        {
            $query = 'INSERT INTO tbl_orders 
                SET 
                no_meja = :no_meja,
                id_cabang = :id_cabang,
                id_user = :id_user,
                grandtotal = :grandtotal,
                logs = :logs';

            $stmt = $this->conn->prepare($query);

            // Clean Data
            // $this->id_order = htmlspecialchars(strip_tags($this->id_order));
            $this->no_meja = htmlspecialchars(strip_tags($this->no_meja));
            $this->id_cabang = htmlspecialchars(strip_tags($this->id_cabang));
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            // $this->tgl_order = htmlspecialchars(strip_tags($this->tgl_order));
            $this->grandtotal = htmlspecialchars(strip_tags($this->grandtotal));
            $this->logs = htmlspecialchars(strip_tags($this->logs));

            // Bind Parameter
            // $stmt->bindParam(':id_order', $this->id_order);
            $stmt->bindParam(':no_meja', $this->no_meja);
            $stmt->bindParam(':id_cabang', $this->id_cabang);
            $stmt->bindParam(':id_user', $this->id_user);
            // $stmt->bindParam(':tgl_order', $this->tgl_order);
            $stmt->bindParam(':grandtotal', $this->grandtotal);
            $stmt->bindParam(':logs', $this->logs);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        function updateOrder(){
             $query = 'UPDATE tbl_orders
                SET 
                    grandtotal = :grandtotal                    
                WHERE 
                    id_order = :id_order';

            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->grandtotal = htmlspecialchars(strip_tags($this->grandtotal));
            $this->id_order = htmlspecialchars(strip_tags($this->id_order));
            
            
            // Bind Parameter            
            $stmt->bindParam(':grandtotal', $this->grandtotal);
            $stmt->bindParam(':id_order', $this->id_order);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        function createDetailOrder(){
            $query = 'INSERT INTO tbl_detail_order 
                SET 
                id_order = :id_order,
                id_produk = :id_produk,
                jumlah_order = :jumlah_order,
                harga_produk = :harga_produk';

            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id_order = htmlspecialchars(strip_tags($this->id_order));
            $this->id_produk = htmlspecialchars(strip_tags($this->id_produk));
            $this->jumlah_order = htmlspecialchars(strip_tags($this->jumlah_order));
            $this->harga_produk = htmlspecialchars(strip_tags($this->harga_produk));

            // Bind Parameter
            $stmt->bindParam(':id_order', $this->id_order);
            $stmt->bindParam(':id_produk', $this->id_produk);
            $stmt->bindParam(':jumlah_order', $this->jumlah_order);
            $stmt->bindParam(':harga_produk', $this->harga_produk);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }
        
        function updateJumlah(){
            $query = 'UPDATE tbl_detail_order
                SET 
                    jumlah_order = :jumlah_order                    
                WHERE 
                    id_order = :id_order &&
                    id_produk = :id_produk';

            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->jumlah_order = htmlspecialchars(strip_tags($this->jumlah_order));
            $this->id_order = htmlspecialchars(strip_tags($this->id_order));
            $this->id_produk = htmlspecialchars(strip_tags($this->id_produk));
            
            // Bind Parameter            
            $stmt->bindParam(':jumlah_order', $this->jumlah_order);
            $stmt->bindParam(':id_order', $this->id_order);
            $stmt->bindParam(':id_produk', $this->id_produk);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->execute());
 
            return false;
        }

        function cekLastOrder()
        {
            // include $path;
            // $conn;
            $query = "SELECT max(id_order) as maxid FROM tbl_orders";

                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                return $stmt;

        }

    }
