<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    
    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    $books_sharable = NULL;
    if (isset($_SESSION['user_logged'])) {
        if ($user_logged->getUserStatus() === 4) {
            //l'user connecté est un auteur
            $my_artist = unserialize($sql->getArtistByUserID($user_logged->getUserID()));
            $books_sharable = $sql->getBooksByAuthor($my_artist->getAuthorID());
        } elseif ($user_logged->getUserStatus() === 5) {
            //un admin
            $books_sharable = $sql->getAllBooks();
        }
    }

    if (isset($_POST['share_book_form'])) {
        $book_shared = unserialize($sql->getBookByID($_POST['book_id']));

        $success = false;
        if ($book_shared != null) {
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