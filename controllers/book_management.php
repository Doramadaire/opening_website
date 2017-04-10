<?php

    setLanguage();

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    $books_sharable = $sql->getAllBooks();

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