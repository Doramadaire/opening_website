<?php

    include_once('classes/useful_functions.php');
    includeOnceAllClasses();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    try {

        //new User($id, $mail, $status, $subscription_date, $firstname = NULL, $name = NULL, $first_mail = NULL):
        //$compte = new User(0, "admin", 5, "2020-01-01");

        $authors[] = array("mail" => "brigittebauer13@orange.fr", "prenom" => "Brigitte", "nom" => "Bauer", "sub_date" => "2017-07-06", "nom_artiste" => "Brigitte Bauer", "descr_file" => "BAUER.txt", "cv" => NULL);
        //$authors[] = array("mail" => "egermain", "prenom" => "Emmanuelle", "nom" => "Germain", "sub_date" => "2017-07-06", "nom_artiste" => "Emmanuelle Germain", "descr_file" => "GERMAIN.txt", "cv" => NULL);

        foreach ($authors as $author_array) {
            //d'abord on crée l'utilisateur
            $user = new User(0, $author_array['mail'], 4, $author_array['sub_date'], $author_array['prenom'], $author_array['nom']);
            $pswd = $sql->generatePassword();
            $sql->addUser($user, $pswd);

            // Préparation du mail contenant le lien d'activation
            $destinataire = $author_array['mail'];
            $sujet = "Votre compte Opening Book";
            $headers = "From: noreply@opening-book.eu"."\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\n";
            $headers .= "Content-Transfer-Encoding: 8bit";
			$message = '<PRE style="font-size:14px;">'."Vous êtes désormais inscrit sur le site d'OPENING, en tant que cotisant à l'association. Votre adhésion expirera le $new_user_sub_date.\n
Voici votre mot de passe : $pswd\n
Je vous conseille de le modifier dès votre première visite sur notre site.\n
Pour modifier votre mot de passe, identifiez-vous sur <a href='https://opening-book.com/index.php'>opening-book.com</a> et allez sur la page 'Gestion de votre compte'\n
\n
Nous vous souhaitons une agréable consultation de notre collection.\n
\n
---------------\n
Ceci est un mail automatique, Merci de ne pas y répondre.\n".'</PRE>'.'<img style="float: right;"'." src='https://alpha.opening-book.eu/assets/logo.png' width='80px' height='47px'>";

            mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail

            //ensuite on cree l'artiste
            $artist = new Author(0, $author_array['nom_artiste'], unserialize($sql->getUserByExactMail($author_array['mail']))->getUserID(), $author_array['nom'], $author_array['descr_file'], $author_array['cv']);
            $sql->addAuthor($artist);
        }

        $books = array();

        $books[] = array("titre" => "Opening book photo 006", "filename" => "OPENINGBOOKPHOTO_006", "authors_ids" => [unserialize($sql->getAuthorByExactName("Brigitte Bauer"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2017-05-24");
        //$books[] = array("titre" => "Opening book photo 007", "filename" => "OPENINGBOOKPHOTO_007", "authors_ids" => [unserialize($sql->getAuthorByExactName("Emmanuelle Germain"))->getAuthorID()], "collection" => "Opening book photo", "publish_date" => "2017-05-24");

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