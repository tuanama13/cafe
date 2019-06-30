<?php
    // include_once 'header.php';
    if(empty($_SESSION)){
		header('Location:../index.php');
	}else {
		if ($_SESSION['role_user']!='Kasir') {
		    header('Location:../index.php');
		    // header_remove("Location: table.php"); 
        }
    }