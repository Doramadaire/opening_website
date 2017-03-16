<?php

	function createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname = NULL, $new_user_name = NULL)
	{
		//on crée un compte que pour un mail valide
		if (filter_var($new_user_mail, FILTER_VALIDATE_EMAIL)) {
			//Le mail est bien à un format valide			
			$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();
			
			$user = unserialize($sql->getUserByExactMail($new_user_mail));	
			if ($user != null) {
				//ce mail est déjà associé à un compte!
				//$msg_new_user
				echo "Erreur lors de la création du compte : un compte existe déjà avec cette adresse mail: $new_user_mail";
				return false;
			} else {
				//aucun compte n'existe avec cette adresse
				$date_format = '%Y-%m-%d';
				if (strptime($new_user_sub_date, $date_format)) {
					//Date valide, tout est bon on peut créer notre user!	
					$new_user = new User(0, $new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);	
					$new_password = $sql->generatePassword();	
			
					$sql->addUser($new_user, $new_password);
					
					$msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$new_user_mail." il a le statut=".$new_user_type;
					//Pour gérer les fichiers il y a besoin de les include
					$path = '/users/promo2016/gclaverie/html/opening_website/ ';
					set_include_path(get_include_path() . PATH_SEPARATOR . $path);
					//Dans un gros fichier complet
					$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
					fwrite($myfile, "name=".$new_user_mail." password=".$new_password."\r\n");
		
					// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
					// Préparation du mail contenant le lien d'activation
					$destinataire = $new_user_mail;
					$sujet = "Votre compte OPENING BOOK" ;
					$headers = "From: = Opening\r\n";
					$headers = $headers."Content-Type: text/html; charset=UTF-8\r\n";
					$headers = $headers."Content-Transfer-Encoding: 8bit\r\n";
					
					//Message de confirmation
					$message = "Vous êtes désormais inscrit sur le site d'OPENING, en tant que cotistant à l'association. Votre adhésion expirera le $new_user_sub_date.\r\n
Voici votre mot de passe : $new_password\r\n
Je vous conseille de le modifier dès votre première visite sur notre site.\r\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\r\n
\r\n
Nous vous souhaitons une agréable consultation de notre collection\r\n
\r\n
---------------\r\n
Ceci est un mail automatique, Merci de ne pas y répondre.\r\n";	 
				 
					mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail
					return true;
				} else {
					//Date invalide
					echo "Erreur lors de la création du compte : la date spécifiée est incorrecte";
					return false;
				}			
			}						
		} else { 
			echo "Erreur lors de la création du compte : l'adresse mail spécifiée est invalide";
			return false;
		}
	}

    setLanguage();

	session_start();
	$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	$user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

	if (isset($_POST['new_user_form'])) {	
		$new_user_mail = stripslashes($_POST['mail']);
		$new_user_sub_date = $_POST['subscripion_end_date'];
		$new_user_type = $_POST['user_type'];
		$new_user_firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
		$new_user_name = isset($_POST['name']) ? $_POST['name'] : NULL;

		createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);
	/*	
		//on crée un compte que pour un mail valide
		$new_user_mail = stripslashes($_POST['mail']);
		if (filter_var($new_user_mail, FILTER_VALIDATE_EMAIL)) {
			//Le mail est bien à un format valide			
			$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();
			$user = unserialize($sql->getUserByExactMail($new_user_mail));			

			if ($user != null) {
				//ce mail est déjà associé à un compte!
				$msg_new_user = "Erreur lors de la création du compte : un compte existe déjà avec cette adresse mail: $new_user_mail";
			} else {
				//aucun compte n'existe avec cette adresse
				$date_format = '%Y-%m-%d';
				$new_user_sub_date = $_POST['subscripion_end_date'];
				if (strptime($new_user_sub_date, $date_format)) {
					//Date valide, tout est bon on peut créer notre user!

					$new_user = new User(0, $new_user_mail, $_POST['user_type'], $new_user_sub_date);	
					$new_password = $sql->generatePassword();	
			
					$sql->addUser($new_user, $new_password);
					
					$msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$new_user_mail." il a le statut=".$_POST['user_type'];
					//Pour gérer les fichiers il y a besoin de les include
					$path = '/users/promo2016/gclaverie/html/opening_website/ ';
					set_include_path(get_include_path() . PATH_SEPARATOR . $path);
					//Dans un gros fichier complet
					$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
					fwrite($myfile, "name=".$new_user_mail." password=".$new_password."\r\n");
		
					// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
					// Préparation du mail contenant le lien d'activation
					$destinataire = $new_user_mail;
					$sujet = "Votre compte OPENING BOOK" ;
					$headers = "From: = Opening\r\n";
					$headers = $headers."Content-Type: text/html; charset=UTF-8\r\n";
					$headers = $headers."Content-Transfer-Encoding: 8bit\r\n";
					
					//Message de confirmation
					$message = "Vous êtes désormais inscrit sur le site d'OPENING, en tant que cotistant à l'association. Votre adhésion expirera le $new_user_sub_date.\r\n
Voici votre mot de passe : $new_password\r\n
Je vous conseille de le modifier dès votre première visite sur notre site.\r\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\r\n
\r\n
Nous vous souhaitons une agréable consultation de notre collection\r\n
\r\n
---------------\r\n
Ceci est un mail automatique, Merci de ne pas y répondre.\r\n";	 
				 
				mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail
				} else {
					//Date invalide
					$msg_new_user = "Erreur lors de la création du compte : la date spécifiée est incorrecte";
				}			
			}						
		} else { 
			$msg_new_user = "Erreur lors de la création du compte : l'adresse mail spécifiée est invalide";
		}*/
	}

	if (isset($_POST['search_user_form'])) {
		$mail_searched = stripslashes($_POST['mail']);		
		$sql = SQL::getInstance();
		$conn = $sql->getBoolConnexion();
		$retrieved_users = $sql->getUserByMail('%'.$mail_searched.'%');			

		if ($retrieved_users != null) {
			//Trouvé!
			$msg_user_search = "";
			foreach ($retrieved_users as $index => $user) {
				$msg_user_search = $msg_user_search.$user->toString()."<br>";
			}
		} else {
			//aucun compte n'existe avec cette adresse
			//faire variable booléenne qui vaut true si on affiche un message
			//le message est définie dans la constanste...
			$msg_user_search = "Utilisateur pas trouvé";
		}
	}

	if (isset($_POST['new_author_form'])) {
		/*echo isset($_POST['author_cv_file']);
		echo "<br>y avait un fichier?";
		if ($_FILES['author_cv_file']['error'] > 0) {
			$dl_fail_error = true;
		} else {
			$full_book_extension = strtolower(substr(strrchr($_FILES['author_cv_file']['name'], '.')  ,1)  );
			if ($full_book_extension != "pdf" and $book_extract_extension != "pdf") {
				$incorrect_file_extension_error = true;
			} else {
				$filename = $_FILES['author_cv_file']['name'];
				$path = "resources/cv/".$filename;
				$move_file = move_uploaded_file($_FILES['author_cv_file']['tmp_name'], $path);
				if ($move_file) {
					$sql = SQL::getInstance();
					$conn = $sql->getBoolConnexion();					
					
					//creer l'user et et l'auteur
				}
			}			
		}*/

		$new_user_mail = stripslashes($_POST['mail']);
		$new_user_sub_date = $_POST['subscripion_end_date'];
		//Si on utilise le formulaire, c'est pour créer un auteur
		$new_user_type = 3;
		$new_user_firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
		$new_user_name = isset($_POST['name']) ? $_POST['name'] : NULL;

		$isUserCreated = createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);

		 if ($isUserCreated) {
		 	$sql = SQL::getInstance();
			$conn = $sql->getBoolConnexion();

		 	$user = unserialize($sql->getUserByExactMail($new_user_mail));
		 	$user_id = $user->getUserID();
		 	$new_author = new Author(0, $_POST['name'], $user_id);

		 	$success = $sql->addAuthor($new_author);
		 	if ($success) {
		 		echo "ajout auteur réussi";
		 	} else {
		 		echo "ajout auteur BDD raté";
		 	}
		 } else {
		 	echo "<br>pb création auteur - (et même avant lors de la création de l'user)";
		 }
	}	

	include_once('./views/user_management.php');
	
?>		