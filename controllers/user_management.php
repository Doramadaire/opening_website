<?php

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_user_form'])) {
		//echo $_POST['user_type'];
		//génération d'un mot de passe aléatoire pour le nouveau compte
		//https://www.it-connect.fr/php-generateur-de-mot-de-passe-parametrable/
		$caract = "ABCDEFGHIJKLMNOPQRSTYVWXYZabcdefghijklmnopqrstuvwyxz0123456789@!:;,§/?*µ$=+";
		$possible_lenght = [9,10,11,12,12,13,14,15,16,17,18];
		$lenght = $possible_lenght[mt_rand(0,(count($possible_lenght)-1))];
		$nb_caract_possible = strlen($caract);
		$generated_password = '';
		for($i = 1; $i <= $lenght; $i++) {
			$generated_password = $generated_password.$caract[mt_rand(0,$nb_caract_possible-1)];
		}
		//TO DO : parse la date et la mettre au bon format pour la rentrer en base
		//voir ce que j'ai fait pour le quizz avec les dates
		$new_user = new User(0, stripslashes($_POST['mail']), $_POST['user_type'], "2111-01-01");	

		$sql = SQL::getInstance();
		$conn = $sql->getBoolConnexion();
		$sql->addUser($new_user, $generated_password);

		$msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$_POST['mail']." il a le statut=".$_POST['user_type']." et son mot de passe est : ".$generated_password;
		echo $msg_new_user;
		//Pour gérer les fichiers il y a besoin de les include
		$path = '/users/promo2016/gclaverie/html/opening_website/ ';
		set_include_path(get_include_path() . PATH_SEPARATOR . $path);
		//Dans un gros fichier complet
		$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
		fwrite($myfile, $generated_password);
	
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