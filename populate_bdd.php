<?php

    include_once('classes/useful_functions.php');
    includeOnceAllClasses();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    $sql->createTables();

    //des tests en vrac
    //echo "RESULTAT DE MES TESTS :<br> ";

    //new User($id, $mail, $status, $subscription_date, $firstname = NULL, $name = NULL, $first_mail = NULL):
    $compte = new User(0, "admin", 5, "2020-01-01"); 

    $sql->addUser($compte, "6mayOpening");

    /*
    $unUser = $sql->getUserByMail("hophop@hip.com");
    $unUser = unserialize($unUser);
    echo "voici l'id de l'user cherché: ";
    echo $unUser->getUserID();
    echo "<br> le statut=";
    echo $unUser->getUserStatus();
    */

    $authors ) array();

    $authors[] = array("mail" => "dpetit", "prenom" => "Didier", "nom" => "Petit", "sub_date" => 2018, "nom_artiste" => "Didier Petit", "descr_file" => "PETIT.txt", "cv" => "PETIT.pdf");
    foreach ($authors as $author_array) {
        //d'abord on crée l'utilisateur
        $user = new User(0, $author_array['mail'], 3, "2017-06-06", $author_array['prenoml'], $author_array['noml']);
        $pswd = $sql->generatePassword();
        $sql->addUser($user, $pswd);

        // Préparation du mail contenant le lien d'activation
        $destinataire = "guilhem.claverie+".$author_array['mail']."@gmail.fr";
        $sujet = $author_array['mail']." artiste opening user account creation";
        $headers = "From: noreply@opening-book.eu"."\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit";                                    
        //Message de confirmation
        $message = "mdp=".$pswd;                        
        mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail

        //ensuite on cree l'artiste
        $artist = new Author(0, $author_array['nom_artiste'], $sql->unserialize($author_array['mail'])->getUserID(), $author_array['descr_file'], $author_array['cv'], $author_array['nom']);
        $sql->addAuthor($artist);
    }
    // new Author($id, $name, $user, $description_filename = NULL, $cv_filename = NULL, $news_filename = NULL, $search_name = NULL)
    /*
    $unAuteur = new Author(0, "Didier Petit", $unUser->getUserID(), "description_001.txt", "cv.pdf");
    $sql->addAuthor($unAuteur);
    $sql->addAuthor($unAuteur2);
    $sql->addAuthor($unAuteur3);
    $sql->addAuthor($unAuteur4);
    $unAuteur = $sql->getAuthorByName("oim");
    $unAuteur = unserialize($unAuteur);
    echo "nom=".$unAuteur->getAuthorName()." news=".$unAuteur->getAuthorNews();

//ion __construct($id, $title, $filename, $authors, $collection, $publish_date, $token_container = NULL)
    //modelLivre = new Book(0, "Opening Book 2", "OPENINGBOOK_002.pdf", [2], "openingbook", 2018);
    $unLivre2 = new Book(0, "Opening Book 2", "OPENINGBOOK_002.pdf", [2], "openingbook", 2018);
    $unLivre3 = new Book(0, "Opening Book 3", "OPENINGBOOK_003.pdf", [1,2,3,4,5], "openingbook", 2018);
    $unLivre4 = new Book(0, "Opening Book 4", "OPENINGBOOK_004.pdf", [2,5], "openingbook", 2018);
    $unLivre5 = new Book(0, "Opening Book 5", "OPENINGBOOK_005.pdf", [2,4], "openingbook", 2018);
    $unLivre6 = new Book(0, "Opening Book 6", "OPENINGBOOK_006.pdf", [2], "openingbook", 2018);
    $unLivre7 = new Book(0, "Opening Book 7", "OPENINGBOOK_007.pdf", [2], "openingbook", 2018);

    $unLivrep1 = new Book(0, "Opening Book Photo 1", "OPENINGBOOKPHOTO_001.pdf", [1], "openingbook_photo", 2015);
    $unLivrep2 = new Book(0, "Opening Book Photo 2", "OPENINGBOOKPHOTO_002.pdf", [3], "openingbook_photo", 2015);
    $unLivrep3 = new Book(0, "Opening Book Photo 3", "OPENINGBOOKPHOTO_003.pdf", [1], "openingbook_photo", 2015);
    $unLivrep4 = new Book(0, "Opening Book Photo 4", "OPENINGBOOKPHOTO_004.pdf", [1,4,5], "openingbook_photo", 2015);
    $sql->addBook($unLivrep1);
    $sql->addBook($unLivrep2);
    $sql->addBook($unLivrep3);
    $sql->addBook($unLivrep4);
    $sql->addBook($unLivre2);
    $sql->addBook($unLivre3);
    $sql->addBook($unLivre4);
    $sql->addBook($unLivre5);
    $sql->addBook($unLivre6);
    $sql->addBook($unLivre7);
    
    */
    /*

    $livreCherche = $sql->getBookByID(4);
    $livreCherche = unserialize($livreCherche); 
    echo "<br> Un book : <br>";
    echo "titre=".$livreCherche->getBookTitle()." auteurs=".implode($livreCherche->getBookAuthors())." collection=".$livreCherche->getBookCollection();  
    echo "<br>id=".$livreCherche->getBookID();*/
    //ajout et récupération OK pour user, author et book :)
    /* exemple d'insertion SQL
    INSERT INTO books(title, filename, authors, collection, publish_date) 
    VALUES("Opening Book 1","openingbook_001","a:2:{i:0;i:1;i:1;i:3;}","openingbook",2018);
    */  
    

    /* des tests nuls de type
    $nu = null;
    $NU = NULL;
    echo "voici nu";
    echo $nu;
    echo "<br>";
    echo "voici NU";
    echo $NU;
    echo "<br>";

    $a = "0";
    $b = "";
    if ($a == NULL) {
        echo "dans le test string 0 == NULL";
        echo "<br>";
        if ($a === NULL) {
            echo "dans le test string 0 === NULL";
        } else {
            echo "test string 0 === NULL est faux";
        }
    } else {
        echo "test string 0 == NULL false";
        echo "<br>";
        if ($b == NULL) {
            echo "dans le test string '' == NULL";
            echo "<br>";
            if ($b === NULL){
                echo "dans le test $b === NULL";    
            } else {
                echo "rendons nous à l'évidence, le test avec la strng vide '' === NULL est ARCHI faux";
                echo "<br>";
            }
        } else {
            echo "test string '' == NULL est faux";
        }
    }
    */  

    //echo "<br>FIN DE MES TESTS<br><br><br>";

?>