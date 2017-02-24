<?php

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_user_form'])) {
		//echo $_POST['user_type'];
		$sql = SQL::getInstance();
		$conn = $sql->getBoolConnexion();
		

		//TO DO : parse la date et la mettre au bon format pour la rentrer en base
		//voir ce que j'ai fait pour le quizz avec les dates
		$new_user = new User(0, stripslashes($_POST['mail']), $_POST['user_type'], "2111-01-01");	
		$new_password = $sql->generatePassword();	

		$sql->addUser($new_user, $new_password);
		
		$msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$_POST['mail']." il a le statut=".$_POST['user_type']." et son mot de passe est : ".$new_password;
		echo $msg_new_user;
		//Pour gérer les fichiers il y a besoin de les include
		$path = '/users/promo2016/gclaverie/html/opening_website/ ';
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
		//Dans un gros fichier complet
		$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
		fwrite($myfile, $new_password."\n");
	
		/* Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
		
		if ($mail == $user_logged->getUserMail() && filter_var($new_mail, FILTER_VALIDATE_EMAIL)) {			
			// Préparation du mail contenant le lien d'activation
			$destinataire = $new_mail;
			$sujet = "Votre compte OPENING BOOK" ;
			$entete = "From: Opening" ;	 
			
			//Message de confirmation
			$message = Vous êtes désormais inscrit sur le site d\'OPENING, en tant que cotistant à l'association
			votre adhésion expirera le 
			Voici votre mot de passe : 
			Je vous conseille de le modifier dès votre première visite sur notre site
			http://opening-book.com/
			
			Nous vous souhaitons une agr"able consultation de notre collection 
			 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';	 
			 
			//mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
				
			}	
		else { $error = "adresse invalide";}
		}	*/
	}

	include_once('./views/user_management.php');
	
?>		