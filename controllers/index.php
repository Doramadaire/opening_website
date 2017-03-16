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
	$sql->addUser($compte5, "5mdp");
	*/
	
	/*
	$unUser = $sql->getUserByMail("hophop@hip.com");
	$unUser = unserialize($unUser);
	echo "voici l'id de l'user cherché: ";
	echo $unUser->getUserID();
	echo "<br> le statut=";
	echo $unUser->getUserStatus();
	*/

	/*
	$unAuteur = new Author(0, "picasso", $unUser->getUserID(), "description_001.txt", "news_001.txt");
	$unAuteur2 = new Author(0, "dali", 1, "description_002.txt", "news_002.txt");
	$unAuteur3 = new Author(0, "oim", 3, "description_003.txt", "news_002.txt");
	$unAuteur4 = new Author(0, "pluto", 2, "description_004.txt", "news_003.txt");
	$sql->addAuthor($unAuteur);
	$sql->addAuthor($unAuteur2);
	$sql->addAuthor($unAuteur3);
	$sql->addAuthor($unAuteur4);
	$unAuteur = $sql->getAuthorByName("oim");
	$unAuteur = unserialize($unAuteur);
	echo "nom=".$unAuteur->getAuthorName()." news=".$unAuteur->getAuthorNews();	 
	*/

	/*
	$unLivre = new Book(0, "MOBY DICK", [1,3], "classique", 1920, 3, "baleine.txt");
	if ($sql->addBook($unLivre)) {
		echo "<br>AJOUT DE LIVRE REUSSI";
	} else {
		echo "<br>AJOUT DE LIVRE FOIRE";
	}
	$unLivre = $sql->getBookByTitle("rêves bleus");
	$unLivre = unserialize($unLivre);	
	echo "<br> Un book : <br>";
	echo "titre=".$unLivre->getBookTitle()." auteurs=".implode($unLivre->getBookAuthors())." collection=".$unLivre->getBookCollection();	 
	echo "<br>id=".$unLivre->getBookID();
	//ajout et récupération OK pour user, author et book :)
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