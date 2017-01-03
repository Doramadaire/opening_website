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


<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message

	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		} else {
			// Define $username and $password
			$user_mail = $_POST['mail'];
			$password = $_POST['password'];
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();;
			// To protect MySQL injection for Security purpose
			$user_mail = stripslashes($user_mail);
			$password = stripslashes($password);
			$user_mail = mysql_real_escape_string($user_mail);
			$password = mysql_real_escape_string($password);
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
			$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$_SESSION['user_mail'] = $user_mail; // Initializing Session
			header("location: profile.php"); // Redirecting To Other Page
			} else {
			$error = "Username or Password is invalid";
			}
			mysql_close($connection); // Closing Connection
		}
	}
?>