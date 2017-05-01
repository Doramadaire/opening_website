<?php

	function createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname = NULL, $new_user_name = NULL)
	{
		//on crée un compte que pour un mail valide
		if (filter_var($new_user_mail, FILTER_VALIDATE_EMAIL)) {
			//Le mail est bien à un format valide			
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
					/*$path = '/home/openingbqo/opening_website_assets/';
					set_include_path(get_include_path() . PATH_SEPARATOR . $path);
					//Dans un gros fichier complet
					$myfile = fopen("mdp.txt", "a+") or die("Unable to open file!");
					fwrite($myfile, "name=".$new_user_mail." password=".$new_password."\r\n");
					*/

					// Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
					// Préparation du mail contenant le lien d'activation
					$destinataire = $new_user_mail;
					$sujet = "Votre compte OPENING BOOK" ;
				    $headers ='From: noreply@opening-book.eu'."\n";
					$headers = $headers."Content-Type: text/html; charset=UTF-8\n";
                                        $headers .='Content-Transfer-Encoding: 8bit';
									
					//Message de confirmation
					$message = '<PRE>'."Vous êtes désormais inscrit sur le site d'OPENING, en tant que cotistant à l'association. Votre adhésion expirera le $new_user_sub_date.\n
Voici votre mot de passe : $new_password\n
Je vous conseille de le modifier dès votre première visite sur notre site.\n
Pour modifier votre mot de passe, identifier vous sur http://opening-book.com/ et allez sur la page 'Gestion de votre compte'\n
\n
Nous vous souhaitons une agréable consultation de notre collection\n
\n
---------------\n
Ceci est un mail automatique, Merci de ne pas y répondre.\n".'</PRE>'.'<img style="float: right;"'." src='http://beta.opening-book.eu/assets/mini_logo.jpg' width='80px' height='47px'>";	 
				        
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

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    
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
	}

	if (isset($_POST['search_user_form'])) {
		$mail_searched = stripslashes($_POST['mail']);
		$retrieved_users = $sql->getUserByMail('%'.$mail_searched.'%');	

		if ($retrieved_users != null) {
			//Trouvé!
			$msg_user_search = "";
			$msg_user_search = "réussi<br>";
			$json_retrieved_users = json_encode($retrieved_users);
			//foreach ($retrieved_users as $user) {
				//$msg_user_search = $msg_user_search.$user->toString()."<br>";
		} else {
			//aucun compte n'existe avec cette adresse
			//faire variable booléenne qui vaut true si on affiche un message
			//le message est définie dans la constanste...
			$msg_user_search = "Pas d'utilisateur correspondant trouvé";
		}
	}

	if (isset($_POST['search_author_form'])) {
		$pseudo_searched = stripslashes($_POST['author_pseudo']);
		$retrieved_authors = $sql->getAuthorsByName('%'.$pseudo_searched.'%');

		if ($retrieved_authors != null) {
			//Trouvé!
			$msg_author_search = "";
			foreach ($retrieved_authors as $index => $author) {
				$msg_author_search = $msg_author_search.$author->toString()."<br>";
			}
		} else {
			//aucun compte n'existe avec cette adresse
			//faire variable booléenne qui vaut true si on affiche un message
			//le message est définie dans la constanste...
			$msg_author_search = "Pas d'auteur correspondant trouvé";
		}
	}

	if (isset($_POST['new_author_form'])) {
		/*echo isset($_POST['author_cv_file']);
		echo "<br>y avait un fichier?";*/
		$cv_filename = NULL;
		$description_filename = NULL;

		if ($_FILES['author_cv_file']['error'] > 0) {
			$dl_fail_error = true;
		} else {
			$cv_extension = strtolower(substr(strrchr($_FILES['author_cv_file']['name'], '.'), 1));
			if ($cv_extension != "pdf") {
				$incorrect_file_extension_error = true;
			} else {
				$cv_filename = $_FILES['author_cv_file']['name'];
				$path = "/home/openingbqo/opening_website/assets/artists/cv/".$cv_filename;
				$move_file = move_uploaded_file($_FILES['author_cv_file']['tmp_name'], $path);
				/*if ($move_file) {
					import cv réussi
				}*/
			}			
		}

		if ($_FILES['author_description_file']['error'] > 0) {
			$dl_fail_error = true;
		} else {
			$description_extension = strtolower(substr(strrchr($_FILES['author_description_file']['name'], '.')  ,1)  );
			if ($description_extension != "txt") {
				$incorrect_file_extension_error = true;
			} else {
				$description_filename = $_FILES['author_description_file']['name'];
				$path = "/home/openingbqo/opening_website/assets/artists/description/".$description_filename;
				$move_file = move_uploaded_file($_FILES['author_description_file']['tmp_name'], $path);
				/*if ($move_file) {
					import description
				}*/
			}			
		}

		$new_user_mail = stripslashes($_POST['mail']);
		$new_user_sub_date = $_POST['subscripion_end_date'];
		//Si on utilise le formulaire, c'est pour créer un auteur
		$new_user_type = 3;
		$new_user_firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
		$new_user_name = isset($_POST['name']) ? $_POST['name'] : NULL;

		$isUserCreated = createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);

		 if ($isUserCreated) {
		 	$user = unserialize($sql->getUserByExactMail($new_user_mail));
		 	$user_id = $user->getUserID();

		 	$description_filename = $row['description_filename'] !== NULL ? $row['description_filename'] : NULL;
		 	$new_author = new Author(0, $_POST['artist_name'], $user_id, $description_filename, $cv_filename);

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

	if (isset($_POST['new_book_form'])) {
		if ($_FILES['full_book_file']['error'] > 0 and $_FILES['extract_book_file']['error'] > 0) {
			$dl_fail_error = true;
		} else {
			$full_book_extension = strtolower(substr(strrchr($_FILES['full_book_file']['name'], '.')  ,1)  );
			$book_extract_extension = strtolower(substr(strrchr($_FILES['extract_book_file']['name'], '.')  ,1)  );
			if ($full_book_extension != "pdf" and $book_extract_extension != "pdf") {
				$incorrect_file_extension_error = true;
			} else {
				$book_name = $_FILES['full_book_file']['name'];
				//$book_extract_name = $_FILES['extract_book_file']['name'];
				$full_book_path = "bbff/".$book_name;
				//Le nom du fichier est le même pour les deux, seul le dossier change
				$book_extract_path = "assets/extracts/".$book_name;
				//$move_full = move_uploaded_file($_FILES['full_book_file']['tmp_name'], $full_book_path);
				//$move_extract = move_uploaded_file($_FILES['extract_book_file']['tmp_name'], $book_extract_path);
				/*if ($move_full and $move_extract) {
					//il manque la valeur du champ AUTHORS à mon book
					//$new_book =  new Book(0, $book_name, $book_name, $authors, $_POST['collection'], $_POST['year']);
					//$success = $sql->addBook($new_book);
				}
				echo "DL réussi et extensions correctes<br>";
				echo "Mais rien ne s'est passé, la fonctionnalitée n'est pas finie";
				*/
			}			
		}		
	}

	if (isset($_POST['set_lang_files_form'])) {
		if ($_FILES['fr_lang_file']['error'] > 0 and $_FILES['en_lang_file']['error'] > 0) {
			//rajouter une condition par fichier de langue
			$dl_fail_error = true;
		} else {
			$fr_lang_file_extension = strtolower(substr(strrchr($_FILES['fr_lang_file']['name'], '.')  ,1)  );
			$en_lang_file_extension = strtolower(substr(strrchr($_FILES['en_lang_file']['name'], '.')  ,1)  );
			/*$de_lang_file_extension = strtolower(substr(strrchr($_FILES['de_lang_file']['name'], '.')  ,1)  );
			$es_lang_file_extension = strtolower(substr(strrchr($_FILES['es_lang_file']['name'], '.')  ,1)  );
			$it_lang_file_extension = strtolower(substr(strrchr($_FILES['it_lang_file']['name'], '.')  ,1)  );*/

			if ($fr_lang_file_extension != "php" and $en_lang_file_extension != "php") {
				//rajouter une condition par fichier de langue
				$incorrect_file_extension_error = true;
			} else {
				$lang_file_name = "-lang.php";
				$folder_path = "views/include/";

				$move_fr_file = move_uploaded_file($_FILES['fr_lang_file']['tmp_name'], $folder_path."fr".$lang_file_name);
				$move_en_file = move_uploaded_file($_FILES['en_lang_file']['tmp_name'], $folder_path."en".$lang_file_name);
				/*$move_de_file = move_uploaded_file($_FILES['de_lang_file']['tmp_name'], $folder_path."de".$lang_file_name);
				$move_es_file = move_uploaded_file($_FILES['es_lang_file']['tmp_name'], $folder_path."es".$lang_file_name);
				$move_it_file = move_uploaded_file($_FILES['it_lang_file']['tmp_name'], $folder_path."it".$lang_file_name);*/
				echo "DL réussi et extensions correctes - fichiers de langues mis à jour<br>";
			}			
		}		
	}

	include_once('./views/admin.php');
	
?>						