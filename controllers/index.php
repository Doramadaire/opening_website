<?php	
	
    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    //$sql->createTables();
    
    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    //formulaire de déconnexion
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
	
	//si le formulaire de connexion a été remplie
	if (isset($_POST['logging_form'])) {
		$mail_received = stripslashes($_POST['mail']);
		$pswd_received = stripslashes($_POST['password']);
		if ($mail_received != '') {
			if ($sql->checkUserPassword($mail_received, $pswd_received)) {
				#Identifiants et mdp corrects, on peut connecter notre visiteur
				$user_retrieved = $sql->getUserByExactMail($mail_received);
				$user_logged = unserialize($user_retrieved);
				$_SESSION['user_logged'] = $user_logged;
				} else {
				#mdp pas bon
				$logging_error = "mail ou mot de passe incorrect";
			}			
		} else {
			# mail invalide
			$logging_error = "mail ou mot de passe incorrect";			
		}
	}

	if (isset($_POST['pswd_forgotten_form'])) {
		$reset_pswd_success = false;
		$user = unserialize($sql->getUserByExactMail($_POST['mail_pswd_forgotten']));
		if ($user == null) {
			$reset_pswd_error = "Aucun compte n'existe pour le mail <i>".$_POST['mail_pswd_forgotten']."</i>";
		} else {
			$new_password = $sql->generatePassword();	
			$sql->setUserPassword($user, password_hash($new_password, PASSWORD_BCRYPT));
			$reset_pswd_success = true;
			$msg_new_user = "Nouveau mot de passe : ".$new_password;
			//envoi d'un mail plutot
			//echo $msg_new_user;

			// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
			// Préparation du mail contenant le lien d'activation
			$destinataire = $user->getUserMail();
			$sujet = "Modification du mot de passe de votre compte OPENING BOOK";
			$headers ='From: noreply@opening-book.eu'."\n";
			$headers = $headers."Content-Type: text/html; charset=UTF-8\n";
			$headers .='Content-Transfer-Encoding: 8bit';
									
			//Message de confirmation
			$message = "<PRE>Vous avez demandé la réinitialisation du mot de passe de votre compte.\n
Voici votre nouveau mot de passe : $new_password\n
Je vous conseille de le modifier dès votre prochaine visite sur notre site.\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\n
\n
Nous vous souhaitons une agréable consultation de notre collection\n
\n
---------------\n
Ceci est un mail automatique, Merci de ne pas y répondre.\n".'</PRE>'.'<img style="float: right;"'." src='http://beta.opening-book.eu/assets/mini_logo.jpg' width='80px' height='47px'>";	 
				        
			mail($destinataire, '=?UTF-8?B?'.base64_encode($sujet).'?=', $message, $headers) ; // Envoi du mail
		}		
	}

	include_once('./views/index.php');