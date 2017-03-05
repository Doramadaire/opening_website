<?php

	session_start();
	include("./views/include/set_lang_cookie.php");
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	include_once('./views/book_management.php');
	
?>