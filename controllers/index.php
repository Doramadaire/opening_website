<?php	
	
    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    //$sql->createTables();
    
    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    //formulaire de déconnexion
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
	
	//si le formulaire de connexion a été remplie
	if (isset($_POST['logging_form'])) {
		$mail_received = stripslashes($_POST['mail']);
		$pswd_received = stripslashes($_POST['password']);
		if ($mail_received != '') {
			if ($sql->checkUserPassword($mail_received, $pswd_received)) {
				#Identifiants et mdp corrects, on peut connecter notre visiteur
				$user_retrieved = $sql->getUserByExactMail($mail_received);
				$user_logged = unserialize($user_retrieved);
				$_SESSION['user_logged'] = $user_logged;
				} else {
				#mdp pas bon
				$logging_error = "mail ou mot de passe incorrect";
			}			
		} else {
			# mail invalide
			$logging_error = "mail ou mot de passe incorrect";			
		}
	}

	if (isset($_POST['pswd_forgotten_form'])) {
		$reset_pswd_success = false;
		$user = unserialize($sql->getUserByExactMail($_POST['mail_pswd_forgotten']));
		if ($user == null) {
			$reset_pswd_error = "Aucun compte n'existe pour le mail <i>".$_POST['mail_pswd_forgotten']."</i>";
		} else {
			$new_password = $sql->generatePassword();	
			$sql->setUserPassword($user, password_hash($new_password, PASSWORD_BCRYPT));
			$reset_pswd_success = true;
			$msg_new_user = "Nouveau mot de passe : ".$new_password;
			//envoi d'un mail plutot
			//echo $msg_new_user;

			// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
			// Préparation du mail contenant le lien d'activation
			$destinataire = $user->getUserMail();
			$sujet = "Modification du mot de passe de votre compte OPENING BOOK";
			$headers ='From: noreply@opening-book.eu'."\n";
			$headers = $headers."Content-Type: text/html; charset=UTF-8\n";
			$headers .='Content-Transfer-Encoding: 8bit';
									
			//Message de confirmation
			$message = "<PRE>Vous avez demandé la réinitialisation du mot de passe de votre compte.\n
Voici votre nouveau mot de passe : $new_password\n
Je vous conseille de le modifier dès votre prochaine visite sur notre site.\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\n
\n
Nous vous souhaitons une agréable consultation de notre collection\n
\n
---------------\n
Ceci est un mail automatique, Merci de ne pas y répondre.\n".'</PRE>'.'<img style="float: right;"'." src='http://beta.opening-book.eu/assets/mini_logo.jpg' width='80px' height='47px'>";	 
				        
			mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail
		}		
	}

	//des tests en vrac
	//echo "RESULTAT DE MES TESTS :<br>	";

	/*
	$compte2 = new User(0, "compte2", 2, "2020-01-01");	
	$compte3 = new User(0, "compte3", 3, "2111-01-01");	
	$compte4 = new User(0, "compte4", 4, "2111-01-01");	
	$compte5 = new User(0, "compte5", 5, "2111-01-01");	

	$sql->addUser($compte2, "2mdp");	
	$sql->addUser($compte3, "3mdp");	
	$sql->addUser($compte4, "4mdp");	
	$sql->addUser($compte5, "5mdp");*/
	
	
	/*
	$unUser = $sql->getUserByMail("hophop@hip.com");
	$unUser = unserialize($unUser);
	echo "voici l'id de l'user cherché: ";
	echo $unUser->getUserID();
	echo "<br> le statut=";
	echo $unUser->getUserStatus();
	*/

	/*
	$unAuteur = new Author(0, "picasso", $unUser->getUserID(), "description_001.txt", "cv.pdf");
	$sql->addAuthor($unAuteur);
	$sql->addAuthor($unAuteur2);
	$sql->addAuthor($unAuteur3);
	$sql->addAuthor($unAuteur4);
	$unAuteur = $sql->getAuthorByName("oim");
	$unAuteur = unserialize($unAuteur);
	echo "nom=".$unAuteur->getAuthorName()." news=".$unAuteur->getAuthorNews();	 
	*/

	/*
	$sql->createTables();

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

	include_once('./views/index.php');