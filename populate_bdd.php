<?php

    include_once('classes/useful_functions.php');
    includeOnceAllClasses();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    try {
        $sql->createTables();

        //new User($id, $mail, $status, $subscription_date, $firstname = NULL, $name = NULL, $first_mail = NULL):
        $compte = new User(0, "admin", 5, "2020-01-01");
        // $compte5 = new User(0, "compte5", 5, "2020-01-01");
        // $compte4 = new User(0, "compte4", 4, "2020-01-01");
        // $compte3 = new User(0, "compte3", 3, "2020-01-01");
        // $compte2 = new User(0, "compte2", 2, "2016-01-01");

        //$sql->addUser($compte, "password");


        // new Author($id, $name, $user, $search_name, $description_filename = NULL, $cv_filename = NULL,  $news_filename = NULL)
        //$artist_id = 0;
        //$unAuteur = new Author(0, "Didier Petit", $artist_id, "PETIT.txt", "PETIT.pdf", "Petit");
        //$sql->addAuthor($unAuteur);

        $authors = array();

        $authors[] = array("mail" => "dpetit", "prenom" => "Didier", "nom" => "Petit", "sub_date" => "2017-06-06", "nom_artiste" => "Didier Petit", "descr_file" => "PETIT.txt", "cv" => "CV_PETIT.pdf");
        $authors[] = array("mail" => "ischneider", "prenom" => "Isabelle", "nom" => "Schneider", "sub_date" => "2017-06-06", "nom_artiste" => "Isabelle Schneider", "descr_file" => "SCHNEIDER.txt", "cv" => "CV_SCHNEIDER.pdf");
        $authors[] = array("mail" => "ythiriet", "prenom" => "Yannick", "nom" => "Thiriet", "sub_date" => "2017-06-06", "nom_artiste" => "Yannick Thiriet", "descr_file" => "THIRIET.txt", "cv" => "CV_THIRIET.pdf");
        $authors[] = array("mail" => "sdamoy", "prenom" => "Sophie", "nom" => "Damoy", "sub_date" => "2017-06-06", "nom_artiste" => "Sophie Damoy", "descr_file" => "DAMOY.txt", "cv" => "CV_DAMOY.pdf");
        $authors[] = array("mail" => "fbuadas", "prenom" => "Françoise", "nom" => "Buadas", "sub_date" => "2017-06-06", "nom_artiste" => "Françoise Buadas", "descr_file" => "BUADAS.txt", "cv" => "CV_BUADAS.pdf");
        $authors[] = array("mail" => "mderegibus", "prenom" => "Monique", "nom" => "Deregibus", "sub_date" => "2017-06-06", "nom_artiste" => "Monique Deregibus", "descr_file" => "DEREGIBUS.txt", "cv" => "CV_DEREGIBUS.pdf");
        $authors[] = array("mail" => "orebufa", "prenom" => "Olivier", "nom" => "Rebufa", "sub_date" => "2017-06-06", "nom_artiste" => "Olivier Rebufa", "descr_file" => "REBUFA.txt", "cv" => "CV_REBUFA.pdf");
        $authors[] = array("mail" => "amerian", "prenom" => "André", "nom" => "Mérian", "sub_date" => "2017-06-06", "nom_artiste" => "André Mérian", "descr_file" => "MERIAN.txt", "cv" => "CV_MERIAN.pdf");
        $authors[] = array("mail" => "vhorwitz", "prenom" => "Valérie", "nom" => "Horwitz", "sub_date" => "2017-06-06", "nom_artiste" => "Valérie Horwitz", "descr_file" => "HORWITZ.txt", "cv" => "CV_HORWITZ.pdf");
        $authors[] = array("mail" => "esarrouy", "prenom" => "Emmanuelle", "nom" => "Sarrouy", "sub_date" => "2017-06-06", "nom_artiste" => "Emmanuelle Sarrouy", "descr_file" => "SARROUY.txt", "cv" => "CV_SARROUY.pdf");

        foreach ($authors as $author_array) {
            //d'abord on crée l'utilisateur
            $user = new User(0, $author_array['mail'], 3, "2017-06-06", $author_array['prenom'], $author_array['nom']);
            $pswd = $sql->generatePassword();
            $sql->addUser($user, $pswd);

            // Préparation du mail contenant le lien d'activation
            $destinataire = "guilhem.claverie+".$author_array['mail']."@gmail.com";
            $sujet = $author_array['mail']." artiste opening user account creation";
            $headers = "From: noreply@opening-book.eu"."\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\n";
            $headers .= "Content-Transfer-Encoding: 8bit";
            $message = "mdp=".$pswd;
            mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail

            //ensuite on cree l'artiste
            $artist = new Author(0, $author_array['nom_artiste'], unserialize($sql->getUserByExactMail($author_array['mail']))->getUserID(), $author_array['nom'], $author_array['descr_file'], $author_array['cv']);
            $sql->addAuthor($artist);
        }


        // new Book($id, $title, $filename, $authors, $collection, $publish_date, $token_container = NULL)
        //$unLivre = new Book(0, "Opening book 002", "OPENINGBOOK_002", [2], "Opening book", "2017-05-07");
        //$sql->addBook($unLivre);


        $books = array();

        $books[] = array("titre" => "Opening book 001", "filename" => "OPENINGBOOK_001", "authors_ids" => [unserialize($sql->getAuthorByExactName("Didier Petit"))->getAuthorID()], "collection" => "Opening book", "publish_date" => "2015-05-01");
        $books[] = array("titre" => "Opening book 002", "filename" => "OPENINGBOOK_002", "authors_ids" => [unserialize($sql->getAuthorByExactName("Isabelle Schneider"))->getAuthorID()], "collection" => "Opening book", "publish_date" => "2015-09-01");
        $books[] = array("titre" => "Opening book 003", "filename" => "OPENINGBOOK_003", "authors_ids" => [unserialize($sql->getAuthorByExactName("Yannick Thiriet"))->getAuthorID()], "collection" => "Opening book", "publish_date" => "2015-10-01");
        $books[] = array("titre" => "Opening book 004", "filename" => "OPENINGBOOK_004", "authors_ids" => [unserialize($sql->getAuthorByExactName("Sophie Damoy"))->getAuthorID()], "collection" => "Opening book", "publish_date" => "2016-01-01");
        $books[] = array("titre" => "Opening book 005", "filename" => "OPENINGBOOK_005", "authors_ids" => [unserialize($sql->getAuthorByExactName("Françoise Buadas"))->getAuthorID()], "collection" => "Opening book", "publish_date" => "2016-12-01");
        $books[] = array("titre" => "Opening book photo 001", "filename" => "OPENINGBOOKPHOTO_001", "authors_ids" => [unserialize($sql->getAuthorByExactName("Monique Deregibus"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2016-01-01");
        $books[] = array("titre" => "Opening book photo 002", "filename" => "OPENINGBOOKPHOTO_002", "authors_ids" => [unserialize($sql->getAuthorByExactName("Olivier Rebufa"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2016-05-01");
        $books[] = array("titre" => "Opening book photo 003", "filename" => "OPENINGBOOKPHOTO_003", "authors_ids" => [unserialize($sql->getAuthorByExactName("André Mérian"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2016-10-01");
        $books[] = array("titre" => "Opening book photo 004", "filename" => "OPENINGBOOKPHOTO_004", "authors_ids" => [unserialize($sql->getAuthorByExactName("Valérie Horwitz"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2016-11-01");
        $books[] = array("titre" => "Opening book photo 005", "filename" => "OPENINGBOOKPHOTO_005", "authors_ids" => [unserialize($sql->getAuthorByExactName("Emmanuelle Sarrouy"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2017-01-01");

        foreach ($books as $book_array) {
            $ba = $book_array;
            $book = new Book(0, $ba['titre'], $ba['filename'], $ba['authors_ids'], $ba['collection'], $ba['publish_date']);
            $sql->addBook($book);
        }

        echo "Ouais, opération réussie! :)";
    } catch (Exception $e) {
        echo "Une erreur est survenue :(";
        echo $e->getMessage();
    }

?>