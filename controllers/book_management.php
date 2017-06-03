<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    
    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    $msg_choix_book = "Choix du book à partager";
    $msg_partager_book = "Partager le book";

    $books_sharable = NULL;
    try {
        if (isset($_SESSION['user_logged'])) {
            if ($user_logged->getUserStatus() === 4) {
                //l'user connecté est un auteur
                $my_artist = unserialize($sql->getArtistByUserID($user_logged->getUserID()));
                if ($my_artist == NULL) {
                    //echo "Pas de compte artiste associe trouve...<br>";
                    //echo "mon compte user : ".$user_logged->toString()."<br>";
                } else {
                    $books_sharable = $sql->getBooksByAuthor($my_artist->getAuthorID());
                }
            } elseif ($user_logged->getUserStatus() === 5) {
                //un admin
                $books_sharable = $sql->getAllBooks();
            }
        }
    } catch (Exception $e) {
        //Pour gérer les fichiers il y a besoin de les include
        $path = '/home/openingbqo/opening_website_assets/';
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        //Dans un gros fichier complet
        $myLogFile = fopen("log.txt", "a+") or die("Unable to open file!");
        $now = date("Y-m-d H:i:s");
        fwrite($myLogFile, $now." Exception : ".$e->getMessage());
    }


    if (isset($_POST['share_book_form'])) {
        $book_shared = unserialize($sql->getBookByID($_POST['book_id']));

        $msg_choix_book = "Choix d'un autre book à partager";
        $msg_partager_book = "Partager un autre book";

        $success = false;
        if ($book_shared != null) {
            //erf, pour avoir une durée variable je dois changer ma façon de faire
            //il faut stocker la date de fin de validiter et dans clean token comparer à la date du jour...
            //$share_duration = isset($_POST['duration']) ? $_POST['duration'] : 28;
            $new_token = generateAccessToken();
            if ($book_shared->addAccessToken($new_token)) {
                $authors_ids = $book_shared->getBookAuthors();
                $i = 0;
                $authors_string = '';
                foreach ($authors_ids as $author_id) {
                    if ($i > 0) {
                        $authors_string = $authors_string." et ";
                    }
                    // DEVDEVDV - vérifier ce truc
                    $authors_string = $authors_string + unserialize($sql->getAuthorByID($author_id))->getAuthorName();

                    $i++;
                }
                $generated_link = "book_viewer.php?id=".$book_shared->getBookID()."&token=".$new_token;
                $success = true;
            }
        }
    }

	include_once('./views/book_management.php');
	
?>