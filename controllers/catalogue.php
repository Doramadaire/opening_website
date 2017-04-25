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

        $retrieved_authors = $sql->getAuthorsByName($letter_query_author);
        $retrieved_authors_ids = array();
        foreach ($retrieved_authors as $author) {
            $retrieved_authors_ids[] = $author->getAuthorID();
        }

        $retrieved_books = array();

        foreach ($sql->getAllBooks() as $book) {
            foreach ($book->getBookAuthors() as $book_author_id) {
                if(!in_array($book, $retrieved_books)) {
                    //on vérifie que le book est pas déjà dans l'array
                    //c'est possible s'il a plusieurs auteurs et qu'ils ont été trouvés par la recherhce
                    if (in_array($book_author_id, $retrieved_authors_ids)) {
                        $retrieved_books[] = $book;
                        $authors = array(); //un array contenant les objets auteurs du book
                        foreach ($book->getBookAuthors() as $author_id) {
                            $authors[] = unserialize($sql->getAuthorByID($author_id));
                        }
                        $thumbnail_content[] = array( "book" => $book,
                                                    "authors" => $authors);
                    }
                }
            }
        }

        /*
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
        }*/

    } else {
        //Par défaut on affiche quand même TOUS les artistes dans l'ordre
        $sort_type = "default";
        foreach ($sql->getAuthorsSortedAlphabetical() as $author) {
            //on cherche les books de chaque ariste
            foreach ($sql->getAllBooks() as $book) {
                $this_book_authors_ids = $book->getBookAuthors();
                if (in_array($author->getAuthorID(), $this_book_authors_ids)) {
                    $this_book_authors = array();
                    foreach ($this_book_authors_ids as $this_book_author_id) {
                        $this_book_authors[] = unserialize($sql->getAuthorByID($this_book_author_id));
                    }
                    $thumbnail_content[] = array(   "book" => $book,
                                                    "authors" => $this_book_authors);
                }
            }
            //DEVDEV
            //$thumbnail_element["vignette_filename"] = "";
            //echo "un element thumbnail<br>";
            //echo implode($thumbnail_element);
        }
    }

    $all_books = $sql->getAllBooks();
    shuffle($all_books);
    $ten_rand_books = array_slice($all_books, 0, min(10, count($all_books)));
     
    include_once('./views/catalogue.php');

?>