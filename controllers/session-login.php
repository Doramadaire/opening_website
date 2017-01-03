<?php
$login = isset($_POST['login']) ? $_POST['login'] : ''; 
$password = isset($_POST['password']) ? $_POST['password'] : '';


/*
Si le champ login n'est pas rempli => erreur 1   
Si le champ mdp n'est pas rempli => erreur 3
Si le mdp ne correspond pas au login => erreur 2

Si tout est ok, on crée la session.
*/
if($login == '') {
	header('Location: accueil.php?error=1');
	} 
	else if($password != "toto" && $password != '') {
	header('Location: accueil.php?error=2&password='.$password);
	}
	
	else if($password =='') {
	header('Location: accueil.php?error=3');
	}	
	else {
	session_start();
	$_SESSION['login']=$login;
	$_SESSION['password']=$password;
	$_SESSION['logged']=true;
	/* $_SESSION['statut']='membre' ou 'admin'  info obtenue à partir d'une requete SQL*/
	
	header('Location: accueil.php');
	}
	?> 


<!DOCTYPE HTML>
 <html>
	<head>
		<meta charset="utf-8">
</head>

</body>
</html>
