
 <?php   
    //logout.php  
    session_start();
    $_SESSION["id_user"] = "";
    $_SESSION["id_peg"] = "";
    $_SESSION["role_user"] = ""; 
    $_SESSION["username"] = "";   
    session_destroy(); 
    unset($_SESSION["id_user"]);
    unset($_SESSION["id_peg"]);
    unset($_SESSION["role_user"]);
    unset($_SESSION["username"]); 
    // header("location:pdo_login.php");  
    if(empty($_SESSION['id_user'])) header("location: index.php");