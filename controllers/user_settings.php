<?php

	session_start();
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (!$user_logged) {$infraction = "vous n'avez pas le droit d'accéder à cette page";}

	//Si on a envoyé un formulaire de changement d'adresse mail
	if (isset($_POST['new_mail'])) {
		//Connection à la BDD
		$new_mail = $_POST['new_mail'];
		$sql = SQL::getInstance();
		$conn = $sql->getBoolConnexion();
		$set_is_sucess = $sql->setUserMail($user_logged, $new_mail);
		if ($set_is_sucess) {
			$user_logged->setUserMail($new_mail);
			$msg_new_mail = "Le mail associé à ce compte a été modifié avec succès";
		} else {
			$msg_new_mail = "Erreur : Le nouveau mail renseigné est déjà associé à un compte existant ou une erreur avec la base de donnée est survenue";
		}

		/* Envoi d'un mail de vérification - A faire
		if ($mail == $user_logged->getUserMail() && filter_var($new_mail, FILTER_VALIDATE_EMAIL)) {			
			// Préparation du mail contenant le lien d'activation
			$destinataire = $new_mail;
			$sujet = "OPENING BOOK : Confirmez votre nouvelle adresse e-mail" ;
			$entete = "From: ta maman" ;	 
			// Le lien d'activation est composé de?

			//Message de confirmation
			$message = 'Bienvenue sur le site d\'OPENING,
			http://localhost/opening_website/modification.php?log='.urlencode($new_mail).' 
			 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';	 
			 
			//mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
				
			}	
		else { $error = "adresse invalide";}
		}	*/
	}

	include_once('./views/user_settings.php');
	
?>