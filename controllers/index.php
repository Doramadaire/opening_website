<?php	

	//Gestion des sessions utilisateurs
	$login = isset($_POST['login']) ? $_POST['login'] : ''; 
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	/*
	Si le champ login n'est pas rempli => erreur 1   
	Si le champ mdp n'est pas rempli => erreur 3
	Si le mdp ne correspond pas au login => erreur 2

	Si tout est ok, on crée la session.
	*/
	if($login == '') {
		header('Location: index.php?error=1');
		} else if($password != "toto" && $password != '') {
			header('Location: index.php?error=2&password='.$password);
		} else if($password =='') {
			header('Location: index.php?error=3');
		} else {
			session_start();
			$_SESSION['login']=$login;
			$_SESSION['password']=$password;
			$_SESSION['logged']=true;
			/* $_SESSION['statut']='membre' ou 'admin'  info obtenue à partir d'une requete SQL*/		
			header('Location: index.php');
		}



	$unMail = "lolilol@gmail.com";
	$unUser = new User(0, $unMail, 5, "2001-01-01");
	$unUser2 = new User(0, "lol", 4, "2001-01-01");
	$unUser3 = new User(0, "lila", 5, "2001-01-01");
	$unUser4 = new User(0, "hophop@hip.com", 5, "2111-01-01");
	$sql = SQL::getInstance();
	$conn = $sql->getBoolConnexion();
	$sql->createTables();
	$sql->addUser($unUser2, "mdp2");
	$sql->addUser($unUser3, "lemdp3");
	$sql->addUser($unUser4, "autremdp4");

	$unUser = $sql->getUserByMail("hophop@hip.com");
	$unUser = unserialize($unUser);

	echo "<br>voici l'id de l'user cherché: ";
	echo $unUser->getUserID();
	echo "<br> le statut=";
	echo $unUser->getUserStatus();


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

	include_once('./views/index.php');
?>