<?php
    include_once('init/db.pdo.php');
    class Login 
    {
        private $conn;

        // Table User
        public $id_user;
        public $id_pegawai;
        public $username_user;
        public $password_user;
        public $role_user;
        public $logs;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function login($username,$password)
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE username_user=:username LIMIT 1");
                $stmt->execute(array(':username'=>$username));
                $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                if($stmt->rowCount() > 0)
                {
                    if(password_verify($password, $userRow['password_user']))
                    {
                        $_SESSION['user_session'] = $userRow['id_user'];
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
    