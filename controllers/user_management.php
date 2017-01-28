<?php

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_user_form'])) {
		//echo $_POST['user_type'];
		//générer un mdp aléatoire
		//https://www.it-connect.fr/php-generateur-de-mot-de-passe-parametrable/

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