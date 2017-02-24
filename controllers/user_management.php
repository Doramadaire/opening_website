<?php

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_user_form'])) {		
		//on crée un compte que pour un mail valide
		$new_user_mail = stripslashes($_POST['mail']);
		if (filter_var($new_user_mail, FILTER_VALIDATE_EMAIL)) {
			$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();	
			$user = unserialize($sql->getUserByMail($new_user_mail));
			if ($user != null) {
				//ce mail est déjà associé à un compte!
				$msg_new_user = "Erreur lors de la création du compte : un compte existe déjà avec cette adresse mail: $new_user_mail";
			} else {
				//aucun compte n'existe avec cet adresse, on peut y aller					
		
				//TO DO : parse la date et la mettre au bon format pour la rentrer en base
				//voir ce que j'ai fait pour le quizz avec les dates
				$new_user_sub_date = "2111-01-01";
				$new_user = new User(0, $new_user_mail, $_POST['user_type'], $new_user_sub_date);	
				$new_password = $sql->generatePassword();	
		
				$sql->addUser($new_user, $new_password);
				
				$msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$new_user_mail." il a le statut=".$_POST['user_type']." et son mot de passe est : ".$new_password;
				echo $msg_new_user;
				//Pour gérer les fichiers il y a besoin de les include
				$path = '/users/promo2016/gclaverie/html/opening_website/ ';
				set_include_path(get_include_path() . PATH_SEPARATOR . $path);
				//Dans un gros fichier complet
				$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
				fwrite($myfile, "name=".$new_user_mail." password=".$new_password."\n");
	
				// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
				// Préparation du mail contenant le lien d'activation
				$destinataire = $new_user_mail;
				$sujet = "Votre compte OPENING BOOK" ;
				$headers = "From: = Opening\n";
				$headers = $headers."Content-Type: text/html; charset=UTF-8\n";
				$headers = $headers."Content-Transfer-Encoding: 8bit\n";
				
				//Message de confirmation
				$message = "Vous êtes désormais inscrit sur le site d'OPENING, en tant que cotistant à l'association. Votre adhésion expirera le $new_user_sub_date.\n
Voici votre mot de passe : $new_password\n
Je vous conseille de le modifier dès votre première visite sur notre site.\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\n
\n
Nous vous souhaitons une agréable consultation de notre collection\n
\n
---------------\n
Ceci est un mail automatique, Merci de ne pas y répondre.\n";	 
			 
			mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail	
			}						
		} else { 
			$msg_new_user = "Erreur lors de la création du compte : l'adresse mail spécifiée est invalide";
		}
	}

	include_once('./views/user_management.php');
	
?>		