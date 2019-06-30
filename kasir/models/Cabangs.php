<?php 
	$path = realpath(__DIR__ . '/../..');
    // include_once($path . '/init/db.pdo.php');
    include_once($path . '/init/db.pdo.php');

    /**
     * summary
     */
    class Cabang
    {
    	private $conn;
    	public $id_cabang;
    	public $nama_cabang;
    	public $alamat_cabang;
    	public $jumlah_meja;
    	public $id_user;
    	public $logs;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        function readCabangs()
        {
            $query = "SELECT * FROM tbl_cabang";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        function readJumMeja($id_cabang)
        {
            $query = "SELECT jumlah_meja FROM tbl_cabang WHERE id_cabang = :id_cabang";

            $stmt = $this->conn->prepare($query);
            $stmt->execute(array('id_cabang' => $id_cabang));

            return $stmt;
        }
    }
?>