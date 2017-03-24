<?php   

    setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    session_start();
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    $thumbnail_content = array();
    $sort_type = "default";
    if (isset($_GET['letter'])) {
        $sort_type = "artist_alphabetical";
        $letter_query_author = $_GET['letter']."%";

        foreach ($sql->getAllBooks() as $book) {
            foreach ($book->getBookAuthors() as $author_id) {
                if (in_array($author_id, $sql->getAuthorsByName($letter_query_author))) {
                    $author  = unserialize($sql->getAuthorByID($author_id));
                    $thumbnail_element = array("bookID" => $book->getBookID(),
                                               "authorID" => $author_id,
                                               "authorName" => $author->getAuthorName(),
                                               "vignette_filename" =>$book->getBookFilename());
                    //echo "un element thumbnail<br>";
                    //echo implode($thumbnail_element);
                    $thumbnail_content[] = $thumbnail_element;
                }
            }
        }
    } else {
        //Par défaut on affiche quand même les leTOUS artistes dans l'ordre
        $sort_type = "default";
        foreach ($sql->getAuthorsSortedAlphabetical() as $author) {
            $thumbnail_element = array("authorID" => $author->getAuthorID(),
                                       "authorName" => $author->getAuthorName());
            //DEVDEV
            //$thumbnail_element["vignette_filename"] = "";
            //echo "un element thumbnail<br>";
            //echo implode($thumbnail_element);
            $thumbnail_content[] = $thumbnail_element;
        }
    }

    $all_books = $sql->getAllBooks();
    
    include_once('./views/catalogue.php');

?>