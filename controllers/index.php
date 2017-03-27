<?php	
	
	setLanguage();

	$sql = SQL::getInstance();
	$conn = $sql->getBoolConnexion();
	//$sql->createTables();
	
	session_start();	
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	//formulaire de déconnexion
	if (isset($_POST['loggout_form'])) {
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
		$user = unserialize($sql->getUserByExactMail($_POST['mail_pswd_forgotten']));
		if ($user == null) {
			$reset_pswd_error = "Aucun compte n'existe pour le mail <i>".$_POST['mail_pswd_forgotten']."</i>";
		} else {
			$new_password = $sql->generatePassword();	
			$sql->setUserPassword($user, password_hash($new_password, PASSWORD_BCRYPT));
			$msg_new_user = "Nouveau mot de passe : ".$new_password;
			//envoi d'un mail plutot
			echo $msg_new_user;
			//Pour gérer les fichiers il y a besoin de les include
			$path = '/users/promo2016/gclaverie/html/opening_website/ ';
			set_include_path(get_include_path() . PATH_SEPARATOR . $path);
			//Dans un gros fichier complet
			$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
			fwrite($myfile, "name=".stripslashes($_POST['mail_pswd_forgotten'])." password=".$new_password."\n");
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
	$unLivre2 = new Book(0, "Book 2", "openingbook_002", [2], "openingbook", 2018);
	$unLivre3 = new Book(0, "Book 3", "openingbook_003", [2], "openingbook", 2018);
	$unLivre4 = new Book(0, "Book 4", "openingbook_004", [2], "openingbook", 2018);
	$unLivre5 = new Book(0, "Book 5", "openingbook_005", [2], "openingbook", 2018);
	$unLivre6 = new Book(0, "Book 6", "openingbook_006", [2], "openingbook", 2018);
	$unLivre7 = new Book(0, "Book 7", "openingbook_007", [2], "openingbook", 2018);

	$unLivrep2 = new Book(0, "Opening Book Photo 2", "openingbookphoto_002", [3], "openingbook_photo", 2015);
	$unLivrep3 = new Book(0, "Opening Book Photo 3", "openingbookphoto_003", [1], "openingbook_photo", 2015);
	$unLivrep4 = new Book(0, "Opening Book Photo 4", "openingbookphoto_004", [1], "openingbook_photo", 2015);
	$unLivrep5 = new Book(0, "Opening Book Photo 5", "openingbookphoto_005", [1], "openingbook_photo", 2015);
	$sql->addBook($unLivrep2);
	$sql->addBook($unLivrep3);
	$sql->addBook($unLivrep4);
	$sql->addBook($unLivrep5);
	
	$livreCherche = $sql->getBookByID(4);
	$livreCherche = unserialize($livreCherche);	
	echo "<br> Un book : <br>";
	echo "titre=".$livreCherche->getBookTitle()." auteurs=".implode($livreCherche->getBookAuthors())." collection=".$livreCherche->getBookCollection();	 
	echo "<br>id=".$livreCherche->getBookID();*/
	//ajout et récupération OK pour user, author et book :)
	/* exemple d'insertion SQL
	INSERT INTO books(title, filename, authors, collection, year) 
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