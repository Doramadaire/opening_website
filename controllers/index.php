<?php	

	$sql = SQL::getInstance();
	$conn = $sql->getBoolConnexion();
	//sql->createTables();
	
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
				$user_retrieved = $sql->getUserByMail($mail_received);
				$user_logged = unserialize($user_retrieved);
				$_SESSION['user_logged'] = $user_logged;
				} else {
				#mdp pas bon
				$error = "mail ou mot de passe incorrect";
			}			
		} else {
			# mail invalide
			$error = "mail ou mot de passe incorrect";
		}
	}	

	//des tests en vrac
	//echo "RESULTAT DE MES TESTS :<br>	";

	$unMail = "lolilol@gmail.com";
	$unUser = new User(0, $unMail, 5, "2001-01-01");
	$unUser2 = new User(0, "lol", 4, "2001-01-01");
	$unUser3 = new User(0, "lila", 5, "2001-01-01");
	$unUser4 = new User(0, "hophop@hip.com", 5, "2111-01-01");
	$userAdmin = new User(0, "facile@souvenir", 5, "2111-01-01");	
	$userClass3 = new User(0, "unAdherent", 3, "2111-01-01");	
	
	$sql->addUser($unUser2, "mdp2");
	$sql->addUser($unUser3, "lemdp3");
	$sql->addUser($unUser4, "autremdp4");
	$sql->addUser($userAdmin, "hopening");	
	$sql->addUser($userClass3, "mdpAdher");	
	$unUser = $sql->getUserByMail("hophop@hip.com");
	$unUser = unserialize($unUser);
	/*
	echo "voici l'id de l'user cherché: ";
	echo $unUser->getUserID();
	echo "<br> le statut=";
	echo $unUser->getUserStatus();
	*/
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
	/*
	echo "nom=".$unAuteur->getAuthorName()." news=".$unAuteur->getAuthorNews();	 

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