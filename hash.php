<?php
	session_start();
	print_r($_SESSION);
	echo hash('sha1', uniqid());
?>