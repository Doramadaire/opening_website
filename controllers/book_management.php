<?php

    function createBook()
    {
        include_once('classes/User.php');
        include_once('classes/Author.php');
        include_once('classes/Book.php');
        include_once('classes/SQL.php');
    }

    setLanguage();

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_book_form'])) {
		if ($_FILES['full_book_file']['error'] > 0 and $_FILES['extract_book_file']['error'] > 0) {
			$dl_fail_error = true;
		} else {
			$full_book_extension = strtolower(substr(strrchr($_FILES['full_book_file']['name'], '.')  ,1)  );
			$book_extract_extension = strtolower(substr(strrchr($_FILES['extract_book_file']['name'], '.')  ,1)  );
			if ($full_book_extension != "pdf" and $book_extract_extension != "pdf") {
				$incorrect_file_extension_error = true;
			} else {
				$book_name = $_FILES['full_book_file']['name'];
				//$book_extract_name = $_FILES['extract_book_file']['name'];
				$full_book_path = "resources/books/".$book_name;
				//Le nom du fichier est le même pour les deux, seul le dossier change
				$book_extract_path = "resources/extracts/".$book_name;
				/*$move_full = move_uploaded_file($_FILES['full_book_file']['tmp_name'], $full_book_path);
				$move_extract = move_uploaded_file($_FILES['extract_book_file']['tmp_name'], $book_extract_path);
				if ($move_full and $move_extract) {
					$sql = SQL::getInstance();
					$conn = $sql->getBoolConnexion();					
					
					//il manque la valeur du champ AUTHORS à mon book
					//$new_book =  new Book(0, $book_name, $book_name, $authors, $_POST['collection'], $_POST['year']);
					//$success = $sql->addBook($new_book);
				}*/
				echo "DL réussi et extensions correctes<br>";
				echo "Mais rien ne s'est passé, la fonctionnalitée n'est pas finie";
			}			
		}		
	}	

	include_once('./views/book_management.php');
	
?>