<?php	

	$unMail = "lolilol@gmail.com";
	$unUser = new User(0, $unMail, 5, '2001-12-21');
	$unUser2 = new User(0, "mail1", 3, '2042-10-22');
	$unUser3 = new User(0, "mail2", 3, '20011-04-26');
	$sql = SQL::getInstance();
	$conn = $sql->getBoolConnexion();
	$sql->addUser($unUser, "mdp0");
	$sql->addUser($unUser2, "mdp1");
	$sql->addUser($unUser3, "mdp2");
	$unUser = $sql->getUserByMail($unMail);
	$unUser = unserialize($unUser);
	echo "voici l'id de l'user ayant mail = mail2 ";
	echo $unUser->getUserID();
	echo "<br>";

	//$auteur1 = new Author(0, );


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