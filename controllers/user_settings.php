<?php

    setLanguage();

	session_start();
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (!$user_logged) {$infraction = "vous n'avez pas le droit d'accéder à cette page";}

	//Si on a envoyé un formulaire de changement d'adresse mail
	//TO DO : systéme de confirmation par mail, activation grâce à un lien, token unique et blabla
	if (isset($_POST['new_mail'])) {	
		$new_mail_success = FALSE;	
		$new_mail = stripslashes($_POST['new_mail']);
		if (filter_var($new_mail, FILTER_VALIDATE_EMAIL)) {
			//Le format du mail est valide			
			//Connection à la BDD
			$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();
			$set_is_sucess = $sql->setUserMail($user_logged, $new_mail);
			if ($set_is_sucess) {
				$user_logged->setUserMail($new_mail);
				$msg_new_mail = "Le mail associé à ce compte a été modifié avec succès";
				$new_mail_success = TRUE;
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
		} else {
			$msg_new_mail = "Erreur : le nouveau mail renseigné n'est pas valide";
		}
	}

	if (isset($_POST['set_new_password_form'])) {
		$sql = SQL::getInstance();
		$conn = $sql->getBoolConnexion();		
		if ($sql->checkUserPassword($user_logged->getUserMail(), stripslashes($_POST['previous_password']))) {
			if ($_POST['new_password'] === $_POST['new_password_bis']) {
				$new_pswd_hashed = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
				if ($sql->setUserPassword($user_logged, $new_pswd_hashed)) {
					$msg_new_pswd = "Mot de passe modifié avec succès";
				} else {
					$msg_new_pswd = "Echec de la modification du mot de passe : Problème de communication avec la base de donnée";
				}				
			} else {
				$msg_new_pswd = "Echec de la modification du mot de passe : Les deux nouveaux mot de passe ne sont pas identiques";
			}
		} else {
			$msg_new_pswd = "Echec de la modification du mot de passe : Mot de passe actuel incorrect";
		}
	}

	include_once('./views/user_settings.php');
	
?>