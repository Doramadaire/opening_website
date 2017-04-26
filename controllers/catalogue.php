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
        // on a une demande par lettre
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

    } elseif (isset($_GET['collection'])) {
        $sort_type = "by_collection";
        $my_collection_vignettes = array();
        $collection = urldecode($_GET['collection']);

        foreach ($sql->getBooksByCollection($collection) as $book) {
            $this_book_authors = array();
            foreach ($book->getBookAuthors() as $this_book_author_id) {
                $this_book_authors[] = unserialize($sql->getAuthorByID($this_book_author_id));
            }
            $my_collection_vignettes[] = array( "book" => $book,
                                                "authors" => $this_book_authors);
        }

    } else {
        //Accueil de la page catalogue presentation des collections
        $sort_type = "default";

        //Pour la première section d'une grille aléatoire
        $all_books = $sql->getAllBooks();
        shuffle($all_books);
        $rand_books = array_slice($all_books, 0, min(16, count($all_books)));

        //Pour la section artiste on affiche TOUS les artistes dans l'ordre alpha
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

        //Pour la section par collection pour l'accueil
        $collections_vignettes = array();
        $available_collections = $sql->getAvalaibleCollections();
        foreach ($available_collections as $collection) {
            //on va mettre l'image d'un book de la collection au hasard
            $books = $sql->getBooksByCollection($collection);
            shuffle($books);
            $book = $books[0];
            //ses auteurs pour la vignette
            $this_book_authors = array();
            foreach ($book->getBookAuthors() as $this_book_author_id) {
                $this_book_authors[] = unserialize($sql->getAuthorByID($this_book_author_id));
            }
            $collections_vignettes[] = array(   "collection" => $collection,
                                                "book" => $book,
                                                "authors" => $this_book_authors);
        }
    }
     
    include_once('./views/catalogue.php');

?>