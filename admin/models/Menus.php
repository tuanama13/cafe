<?php
	$path = realpath(__DIR__ . '/../..');
	
    include_once($path . '/init/db.pdo.php');

    class Menu
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

        function createProduks($target){
			$this->id_kat = htmlspecialchars(strip_tags($this->id_kat));
            $randNum = $this->id_kat; //rand(1,10);
			$path_ = realpath(__DIR__ . '/../..');
			
    		// // function make directory
    		// // mkdir('images/'.$randNum, 0777,true); //Windows
    		// //chmod('images/'.$randNum, 0777')
    		$dir = $path_."/image/".$randNum."/";
			

			$target_file = $dir.basename($_FILES['myimage']['name']);
			// echo $target_file;
    		$uploadOK = 1;

    		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    		if (isset($_POST['saveimage']) && isset($_POST['myimage']['tmp_name'])) {
    			$check = getimagesize($_FILES['myimage']['tmp_name']);
    			if ($check != false) {
	    			echo "FILE is an Image - " . $check["mime"] . ".";
	    			echo "<br>";
	    			$uploadOK = 1;
	    		}else{
	    			echo "FILE is not an Image.";
	    			echo "<br>";
	    			$uploadOK = 0;
	    		}
	    	}

	    	// check image size
	    	if ($_FILES['myimage']['tmp_name'] > 50000000) {
	    		echo "Sorry, your file to large";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}


	    	// check file type
	    	if ($imageFileType != 'jpg' && $imageFileType != 'JPG' && $imageFileType != 'png' && $imageFileType != 'PNG' && $imageFileType != 'jpeg' && $imageFileType != 'JPEG' && $imageFileType != 'gif') {
	    		echo "Sorry only image format can upload";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}else{

	    		// New Name
	    		$tanggal = date("Ymd");
	    		$temp = explode(".", "jsjsjs.jpeg");
				$newName = round(microtime(true)) . '.' .end($temp);

				$target_file = $dir."".$tanggal."".$newName;
				$target_ = $tanggal."".$newName;
			}

	    	if ($uploadOK == 0) {
	    		echo "Your File was not Uploaded";
	    		echo "<br>";
	    		echo "<a href='upload_image.php' title='backtoupload'>Back</a>";
	    	}else{


	    		if (move_uploaded_file($_FILES['myimage']['tmp_name'], $target_file)) {
	    			$imagePath = $target_file;

	    			try {
						// echo $target_;

                        $query = 'INSERT INTO tbl_produk 
                            SET 
                            id_kat = :id_kat,
                            nama_produk = :nama_produk,
                            desc_produk = :desc_produk,
                            image_produk = :image_produk,
                            harga_produk = :harga_produk,
                            status_produk = :status_produk,
                            logs = :logs';
                    
                        $stmt = $this->conn->prepare($query);

                        //Clean Data
                        $this->id_kat = htmlspecialchars(strip_tags($this->id_kat));
                        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
                        $this->desc_produk = htmlspecialchars(strip_tags($this->desc_produk));
                        $this->image_produk = htmlspecialchars(strip_tags("/image/".$this->id_kat."/".$target_));
                        $this->harga_produk = htmlspecialchars(strip_tags($this->harga_produk));
                        $this->status_produk = htmlspecialchars(strip_tags($this->status_produk));
                        $this->logs = htmlspecialchars(strip_tags($this->logs));

                        //Bind Param
                        $stmt->bindParam(':id_kat',$this->id_kat);
                        $stmt->bindParam(':nama_produk',$this->nama_produk);
                        $stmt->bindParam(':desc_produk',$this->desc_produk);
                        $stmt->bindParam(':image_produk',$this->image_produk);
                        $stmt->bindParam(':harga_produk',$this->harga_produk);
                        $stmt->bindParam(':status_produk',$this->status_produk);
                        $stmt->bindParam(':logs',$this->logs);

                        if ($stmt->execute()) {
                            return true;
                        }
                        
                        printf("Error: %s.\n", $stmt->execute());
            
                        return false;
	    				$sql = "INSERT INTO images (image) VALUES('$imagePath')";
	    				$stmt = $this->conn->prepare($sql);
			            $stmt->execute();

			//             // echo "Insert Image Succeesful";
	    	// 			// echo "<br>";
	    	// 			// echo "<a href='upload_image.php' title='backtoupload'>Back</a>";


	    			} catch (Exception $e) {
	    				echo "ERROR : ".$e->getMessage();
	    			}
	    		}

			}
			
			// echo $target;

            
            
		}
		

		function updateProduks($target){
			$this->id_kat = htmlspecialchars(strip_tags($this->id_kat));
            $randNum = $this->id_kat; //rand(1,10);
			$path_ = realpath(__DIR__ . '/../..');
			
    		// // function make directory
    		// // mkdir('images/'.$randNum, 0777,true); //Windows
    		// //chmod('images/'.$randNum, 0777')
    		$dir = $path_."/image/".$randNum."/";
			

			$target_file = $dir.basename($_FILES['myimage']['name']);
			// echo $target_file;
    		$uploadOK = 1;

    		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    		if (isset($_POST['saveimage']) && isset($_POST['myimage']['tmp_name'])) {
    			$check = getimagesize($_FILES['myimage']['tmp_name']);
    			if ($check != false) {
	    			echo "FILE is an Image - " . $check["mime"] . ".";
	    			echo "<br>";
	    			$uploadOK = 1;
	    		}else{
	    			echo "FILE is not an Image.";
	    			echo "<br>";
	    			$uploadOK = 0;
	    		}
	    	}

	    	// check image size
	    	if ($_FILES['myimage']['tmp_name'] > 50000000) {
	    		echo "Sorry, your file to large";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}


	    	// check file type
	    	if ($imageFileType != 'jpg' && $imageFileType != 'JPG' && $imageFileType != 'png' && $imageFileType != 'PNG' && $imageFileType != 'jpeg' && $imageFileType != 'JPEG' && $imageFileType != 'gif') {
	    		echo "Sorry only image format can upload";
	    		echo "<br>";
	    		$uploadOK = 0;
	    	}else{

	    		// New Name
	    		$tanggal = date("Ymd");
	    		$temp = explode(".", "jsjsjs.jpeg");
				$newName = round(microtime(true)) . '.' .end($temp);

				$target_file = $dir."".$tanggal."".$newName;
				$target_ = $tanggal."".$newName;
			}

	    	if ($uploadOK == 0) {
	    		echo "Your File was not Uploaded";
	    		echo "<br>";
	    		echo "<a href='upload_image.php' title='backtoupload'>Back</a>";
	    	}else{


	    		if (move_uploaded_file($_FILES['myimage']['tmp_name'], $target_file)) {
	    			$imagePath = $target_file;

	    			try {
						// echo $target_;

                        $query = 'UPDATE tbl_produk 
                            SET 
								id_kat = :id_kat,
								nama_produk = :nama_produk,
								desc_produk = :desc_produk,
								image_produk = :image_produk,
								harga_produk = :harga_produk,
								status_produk = :status_produk,
								logs = :logs
							WHERE
								id_produk=:id_produk';
                    
                        $stmt = $this->conn->prepare($query);

                        //Clean Data
                        $this->id_kat = htmlspecialchars(strip_tags($this->id_kat));
                        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
                        $this->desc_produk = htmlspecialchars(strip_tags($this->desc_produk));
                        $this->image_produk = htmlspecialchars(strip_tags("/image/".$this->id_kat."/".$target_));
                        $this->harga_produk = htmlspecialchars(strip_tags($this->harga_produk));
                        $this->status_produk = htmlspecialchars(strip_tags($this->status_produk));
						$this->logs = htmlspecialchars(strip_tags($this->logs));
						$this->id_produk = htmlspecialchars(strip_tags($this->id_produk));

                        //Bind Param
                        $stmt->bindParam(':id_kat',$this->id_kat);
                        $stmt->bindParam(':nama_produk',$this->nama_produk);
                        $stmt->bindParam(':desc_produk',$this->desc_produk);
                        $stmt->bindParam(':image_produk',$this->image_produk);
                        $stmt->bindParam(':harga_produk',$this->harga_produk);
                        $stmt->bindParam(':status_produk',$this->status_produk);
						$stmt->bindParam(':logs',$this->logs);						
						$stmt->bindParam(':id_produk',$this->id_produk);

                        if ($stmt->execute()) {
                            return true;
                        }
                        
                        printf("Error: %s.\n", $stmt->execute());
            
                        return false;
	    				$sql = "INSERT INTO images (image) VALUES('$imagePath')";
	    				$stmt = $this->conn->prepare($sql);
			            $stmt->execute();

			//             // echo "Insert Image Succeesful";
	    	// 			// echo "<br>";
	    	// 			// echo "<a href='upload_image.php' title='backtoupload'>Back</a>";


	    			} catch (Exception $e) {
	    				echo "ERROR : ".$e->getMessage();
	    			}
	    		}

			}
			
			// echo $target;

            
            
        }
    }
