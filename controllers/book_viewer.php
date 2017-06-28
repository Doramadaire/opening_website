<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    
    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    //Dossier dans lequel il y a les books
    $book_folder = "/bbff/";

    //DEVDEVDEV c'est un peu moche ici
    $book_description = "description";
    $privileged_access_granted = false;

    if (isset($_GET['id'])) {
        $book = unserialize($sql->getBookByID($_GET['id']));
        
        $book_description_filename = "assets/book_description/".$lang."/".$book->getBookFilename().".txt";
        //set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        try {
            $book_description_file = fopen($book_description_filename, "r");
            //or die("Unable to open file!");
            if ($book_description_file) {
                $book_description = '';
                while ($line = fgets($book_description_file)) {
                    $book_description = $book_description.$line;
                }
                fclose($book_description_file);
            }
        } catch (Exception $e) {
            //exception
        }

        //DEVDEv on prend le 1er auteur c'est moche - faire boucle sur chaque auteur
        $book_author = unserialize($sql->getAuthorByID($book->getBookAuthors()[0]));
        $author_cv_filename = $book_author->getAuthorCV();
        if (!is_null($author_cv_filename)) {
            $cv_link = "/assets/cv/".$author_cv_filename;
        }

        $artist_description_filename = "assets/artists_descriptions/".$lang."/".$book_author->getAuthorDescription();
        //set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        try {
            $artist_description_file = fopen($artist_description_filename, "r");
            //or die("Unable to open file!");
            if ($artist_description_file) {
                $artist_description = '';
                while ($line = fgets($artist_description_file)) {
                  $artist_description = $artist_description.$line;
                }
                fclose($artist_description_file);
            }
        } catch (Exception $e) {
            //exception
        }

        if (isset($_GET['token'])) {
            $token_provided = $_GET['token'];
            //on vérifie si le token est bon
            //nettoyage des tokens expirés d'abord
            $book->cleanOldTokens();
            $access_tokens = $book->getAcessTokens();
            foreach ($access_tokens as $token_container) {
                $token = $token_container[0];
                $token_creationdate = $token_container[1];
                if ($token == $token_provided) {
                    //le token est valide, on vérifie qu'il a pas expiré
                    //cette vérification est inutile puisqu'on vient de faire le ménage dans les tokens...
                    if ($token_creationdate > time() - (28*24*60*60)) {
                        //ce token a moins de 28jours
                        $privileged_access_granted = true;
                    }                    
                }
            }
        }

        //déterminons si on affiche un book complet ou un extrait
        $book_is_extract = true;
        if ($privileged_access_granted) {
            //on a un token d'accès privilégié
            $book_is_extract = false;  
            $book_pdf_path = $book_folder.$book->getBookFilename();
        } else {
            if (isset($_SESSION['user_logged'])) {
                switch ($user_logged->getUserStatus()) {
                    case 2:
                    case 3:
                        //si date du jour plus petite que date de fin d'adhesion
                        $date_today = date('Y-m-d');
                        if ($user_logged->getUserSubscriptionDate() < $date_today) {
                            //adhésion expirée
                            $book_is_extract = true;
                        } else {
                            //adhésion encore valide
                            $book_is_extract = false;
                        }
                        break;

                    case 4:
                        $my_artist_account = unserialize($sql->getArtistByUserID($user_logged->getUserID()));
                        $my_books = $sql->getBooksByAuthor($my_artist_account->getAuthorID());
                        $is_my_book = false;
                        foreach ($my_books as $my_book) {
                            if (in_array($my_artist_account->getAuthorID(), $my_book->getBookAuthors())) {
                                //si c'est un de mes books j'y ai toujours accès
                                $is_my_book = true;
                                $book_is_extract = false;
                            }
                        }
                        if (!$is_my_book) {
                            //si date du jour plus petite que date de fin d'adhesion
                            $date_today = date('Y-m-d');
                            if ($user_logged->getUserSubscriptionDate() < $date_today) {
                                //adhésion expirée
                                $book_is_extract = true;
                            } else {
                                //adhésion encore valide
                                $book_is_extract = false;
                            }
                        }
                        break;

                    case 5:
                        $book_is_extract = false;
                        break;

                    default:
                        $book_is_extract = true;
                        break;
                }
            }
        }

        if ($book_is_extract) {
            //ce sera un extrait
            $book_pdf_path = "/assets/extracts/".$book->getBookFilename()."_EXTRAIT.pdf";
            $cover_filename = "/assets/covers/".$book->getBookFilename()."_EXTRAIT.jpg";
        } else {
            //book complet!
            $book_pdf_path = $book_folder.$book->getBookFilename().".pdf";
            $cover_filename = "/assets/covers/".$book->getBookFilename().".jpg";
        }
    } else {
        //erreur, t'as rien à faire là mon pote
        header('Location: index.php');
    }

	include_once('./views/book_viewer.php');
	
?>