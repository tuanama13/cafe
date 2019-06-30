<?php
    include_once('init/db.pdo.php');
    include_once('login_.php');
    $message = "";
    session_start();

    $database = new Database();
    $db = $database->connect();

    // $user= new Login($db);
    // // $result = $cabang->();
    

    // if (isset($_POST['login'])) {
    //     # code...
    
    //     $uname = $_POST['username'];
    //     // $umail = $_POST['txt_uname_email'];
    //     $upass = $_POST['password'];
        
    //     if($user->login($uname,$upass)){
    //         // $user->redirect('home.php');
    //         header ("Location: hash.php");
    //         $message =  "success";
    //     }else{
    //         $message =  "Wrong Details !";
    //     }
    // } 

    if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM tbl_user WHERE username_user = :username AND password_user = :password";  
                $statement = $db->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();
                $row   = $statement->fetch(PDO::FETCH_ASSOC);  
                if($count > 0)  
                {
                    $_SESSION["id_user"] = $row['id_user'];
                    $_SESSION["id_peg"] = $row['id_pegawai'];
                    $_SESSION["role_user"] = $row['role_user']; 
                    $_SESSION["username"] = $_POST["username"];  
                    // header("location:hash.php");  
                    if ($row['role_user']=='Admin') {
                        header("Location:admin/");
                    } else {
                        header("Location:kasir/table.php");
                    }
                    
                }  
                else  
                {  
                     $message = '<label>Invalid Username or Password</label>';  
                }  
           }  
      }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inland Cafe</title>
    
    <!-- Source CSS -->
     <link rel="stylesheet" href="/cafe/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="/cafe/plugins/font-awesome/css/all.min.css">

     <style>
        .bg-log{
            border-radius:20px;
            padding:20px;
            margin-top:100px;
            background-color:white;
            /* opacity:0.9;
            filter:alpha(opacity=90); */
        }
        .form-control{
            border-radius:50px;
        }
        .btn{
            border-radius:50px;
        }
     </style>

     <!-- Source JS -->
     <script src="/cafe/bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-image:url('image/bg_login.jpg'); background-position:center;background-repeat:no-repeat;background-size:cover;">
    <div class="row">
        <div class="container">
            <div style="" class="bg-log col-md-offset-4 col-xs-offset-2 col-md-4 col-xs-8">
                <h1 class="text-center"><strong>INLAND CAFE</strong></h1>
                <br>
                
                <br>
                <!-- <h3>Login</h3> -->
                <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="txt form-control" id="username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="username">Password</label>
                    <input type="password" name="password" class="txt form-control" id="password" placeholder="Enter Password">
                </div>
                <h5 style="color:red;"><?php print_r($message); ?></h5>
                <button style="margin-top:30px;margin-bottom:50px;" type="submit" name="login" class="btn btn-block btn-primary">Login</button>
                </form>
            </div> 
        </div>
    </div>
</body>
</html>