<?php

    setLanguage();

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    //mcrypt-generic

    //Dossier dans lequel il y a les books
    $book_folder = "/bbff/";

    //DEVDEVDEV c'est un peu moche ici
    $description = "description";

    if (isset($_GET['id'])) {
        $sql = SQL::getInstance();
        $conn = $sql->getBoolConnexion();

        $book = unserialize($sql->getBookByID($_GET['id']));
        $book_pdf_path = $book_folder.$book->getBookFilename();

        $description_filename = "/home/openingbqo/opening_website/assets/book_description/".substr($book->getBookFilename(), 0, -4).".txt";
        //set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        try {
            $description_file = fopen($description_filename, "r");
            //or die("Unable to open file!");
            if ($description_file) {
                $description = ''; 
                while ($line = fgets($description_file)) {
                  $description = $description.$line;
                }
                fclose($description_file);
            }
        } catch (Exception $e) {
            //exception
        }        

        //DEVDEv on prend le 1er auteur c'est moche - faire boucle sur chaque auteur
        $book_author = unserialize($sql->getAuthorByID($book->getBookAuthors()[0]));
    } else {
        //erreur, t'as rien à faire là mon pote
        $a = 0;
    }

	include_once('./views/book_viewer.php');
	
?>