<?php

    setLanguage();

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_book_form'])) {
		if ($_FILES['book_file']['error'] > 0) echo "Erreur lors du transfert";
		$extension_upload = strtolower(  substr(  strrchr($_FILES['book_file']['name'], '.')  ,1)  );
		if ( $extension_upload != ".pdf" ) echo "Extension correcte";

		$file_name = $_FILES['book_file']['name'];
		$path = "resources/books/";
		$resultat = move_uploaded_file($_FILES['book_file']['tmp_name'], $path.$file_name);
		if ($resultat) echo "Transfert réussi";
	}	

	include_once('./views/book_management.php');
	
?>