<?php

    function createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname = NULL, $new_user_name = NULL)
    {
        //on crée un compte que pour un mail valide
        if (filter_var($new_user_mail, FILTER_VALIDATE_EMAIL)) {
            $sql = SQL::getInstance();
            $conn = $sql->getBoolConnexion();
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
                    // Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
                    // Préparation du mail contenant le lien d'activation
                    $destinataire = $new_user_mail;
                    $sujet = "Votre compte Opening book" ;
                    $headers ='From: support@opening-book.com'."\n";
                    $headers = $headers."Content-Type: text/html; charset=UTF-8\n";
                    $headers .='Content-Transfer-Encoding: 8bit';

                    $message = '<html><body style="font-size:20px;">
                    <p>Vous êtes désormais inscrit sur le site d\'Opening en tant que cotisant à l\'association. Votre adhésion expirera le '.$new_user_sub_date.'.<br>
                    <br>
                    <p>Voici votre mot de passe : '.$new_password.'<br>
                    Je vous conseille de le modifier dès votre première visite sur notre site. Pour cela, identifiez-vous sur <a href="https://opening-book.com/index.php">opening-book.com</a> et allez sur la page "Gestion de votre compte".<br>
                    <br>
                    Nous vous souhaitons une agréable consultation de notre collection.</p>
                    ---------------<br>
                    Ceci est un mail automatique, merci de ne pas y répondre.<br>
                    Si vous rencontrer des difficultés lors de l\'utilisation de notre site, vous pouvez contactez <a href="mailto:support@opening-book.com">support@opening-book.com</a><br>
                    <img style="float: right;" src="https://opening-book.com/assets/logo.png" width="80px" height="47px"></body></html>';

                    mail($destinataire, $sujet, $message, $headers); // Envoi du mail

                    //mail admin
                    $object_mail_admin = "Nouveau compte opening" ;
                    $headers_mail_admin = "From: leserveuropeningchezovh\n";
                    $headers_mail_admin .= "Content-Type: text/html; charset=UTF-8\n";
                    $headers_mail_admin .= 'Content-Transfer-Encoding: 8bit';

                    $mail_admin_content = '<html><body style="font-size:20px;">
                    Un nouveau compte vient d\'être créé sur le site opening-book.com<br>
                    mail='.$new_user_mail.'<br>
                    prenom='.$new_user_firstname.'<br>
                    nom='.$new_user_name.'<br>
                    status='.$new_user_type.'<br>
                    date de fin d\'adhesion='.$new_user_sub_date.'<br>
                    <br>
                    Signé : un script qui veut t\'aider<br>
                    <img src="https://opening-book.com/assets/wink.jpg" width="544px" height="255px"></body></html>
                    </body></html>';
                    //mail("admin", $object_mail_admin, $mail_admin_content, $headers_mail_admin);
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
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    if (isset($_SESSION['user_logged']) and $user_logged->getUserStatus() == 5) {
        //que si on est connecté en tant qu'admin
        if (isset($_POST['new_user_form'])) {
            $new_user_mail = stripslashes($_POST['mail']);
            $new_user_sub_date = $_POST['subscripion_end_date'];
            $new_user_type = $_POST['user_type'];
            $new_user_firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
            $new_user_name = isset($_POST['name']) ? $_POST['name'] : NULL;

            $result = createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);
            if ($result) {
                $msg_new_user = "Un nouvel utilisateur a bien été créé, son mail est : ".$new_user_mail." il a le statut=".$new_user_type;
            } else {
                $msg_new_user = "Echec de la création du nouvel utilisateur (erreur détaillée en haut de page)";
            }
        }

        if (isset($_POST['search_user_form'])) {
            $search_user_msg = "";
            $mail_searched = stripslashes($_POST['mail']);
            $retrieved_users = $sql->getUserByMail('%'.$mail_searched.'%');
            if ($retrieved_users != null) {
                //Trouvé!
                $search_user_msg .= "Recherche réussie<br>";
                $json_retrieved_users = json_encode($retrieved_users);
            } else {
                //aucun compte n'existe avec cette adresse
                $search_user_msg .= "Pas d'utilisateur correspondant trouvé";
            }
        }

        # formulaire pour mettre à jour un utilisateur
        if (isset($_POST['update-user'])) {
            $search_user_msg = "";
            $user = unserialize($sql->getUserByID($_POST['id']));

            if ($_POST['status'] !== $user->getUserStatus()) {
                $status_modified = $sql->setUserStatus($user, $_POST['status']);
                if ($status_modified) {
                    $search_user_msg .= "Statut modifié avec succès, nouveau statut=".$_POST['status']."<br>";
                } else {
                    $search_user_msg .= "Echec de la modification du statut<br>";
                }
            }

            if (isset($_POST['firstname'])) {
                if ($_POST['firstname'] !== $user->getUserFirstname()) {
                    $firstname_modified = $sql->setUserFirstname($user, $_POST['firstname']);
                    if ($firstname_modified) {
                        $search_user_msg .= "Prénom modifié avec succès, nouveau prénom=".$_POST['firstname']."<br>";
                    } else {
                        $search_user_msg .= "Echec de la modification du prénom<br>";
                    }
                }
            }

            if (isset($_POST['name'])) {
                if ($_POST['name'] !== $user->getUserName()) {
                    $name_modified = $sql->setUserName($user, $_POST['name']);
                    if ($name_modified) {
                        $search_user_msg .= "Nom modifié avec succès, nouveau nom=".$_POST['name']."<br>";
                    } else {
                        $search_user_msg .= "Echec de la modification du nom<br>";
                    }
                }
            }

            if (isset($_POST['mail'])) {
                if ($_POST['mail'] !== $user->getUserMail()) {
                    $mail_modified = $sql->setUserMail($user, $_POST['mail']);
                    if ($mail_modified) {
                        $search_user_msg .= "Mail modifié avec succès, nouveau mail=".$_POST['mail']."<br>";
                    } else {
                        $search_user_msg .= "Echec de la modification du mail<br>";
                    }
                }
            }

            if (isset($_POST['subscription_date'])) {
                if ($_POST['subscription_date'] !== $user->getUserSubscriptionDate()) {
                    $sub_date_modified = $sql->setUserSubscriptionDate($user, $_POST['subscription_date']);
                    if ($sub_date_modified) {
                        $search_user_msg .= "Date de fin d'adhésion modifiée avec succès, nouvelle date=".$_POST['subscription_date']."<br>";
                    } else {
                        $search_user_msg .= "Echec de la modification de la date de fin d'adhésion<br>";
                    }
                }
            }
            $user = unserialize($sql->getUserByID($_POST['id']));
            $search_user_msg .= "Cet utilisateur a désormais les propriétés suivantes :<br>";
            $search_user_msg .= $user->toString();
        }

        if (isset($_POST['delete-user'])) {
            $search_user_msg = "";
            if (isset($_POST['id'])) {
                $user_to_delete = unserialize($sql->getUserByID($_POST['id']));
                $user_deleted_name = $user_to_delete->getUserFirstname()." ".$user_to_delete->getUserName();
                $success = $sql->deleteUser($_POST['id']);
                if ($success) {
                    $search_user_msg = "Suppression de l'utilisateur".$user_deleted_name." ayant pour id=".$_POST['id']." réussie";
                } else {
                    $search_user_msg = "Echec de la suppression de l'utilisateur ayant pour id=".$_POST['id'];
                }
            }
        }

        if (isset($_POST['search_artist_form'])) {
            $search_artist_msg = "";
            $pseudo_searched = stripslashes($_POST['author_pseudo']);
            $retrieved_artists = $sql->getAuthorsByName('%'.$pseudo_searched.'%');
            if ($retrieved_artists != null) {//Trouvé!
                $search_artist_msg .= "Recherche réussie<br>";
                $json_retrieved_artists = json_encode($retrieved_artists);
            } else {
                //aucun compte n'existe avec cette adresse
                $search_artist_msg = "Pas d'artiste correspondant trouvé";
            }
        }

        if (isset($_POST['update-artist'])) {
            $search_artist_msg = "";
            $artist = unserialize($sql->getAuthorByID($_POST['id']));
            if (isset($_POST['name'])) {
                if ($_POST['name'] !== $artist->getAuthorName()) {
                    $name_modified = $sql->setAuthorName($artist, $_POST['name']);
                    if ($name_modified) {
                        $search_artist_msg .= "Nom modifié avec succès, nouveau nom=".$_POST['name']."<br>";
                    } else {
                        $search_artist_msg .= "Echec de la modification du nom<br>";
                    }
                }
            }

            if (is_uploaded_file($_FILES['artist_cv_file']['tmp_name'])) {
                if ($_FILES['artist_cv_file']['error'] > 0) {
                    $search_artist_msg .= "Echec lors de l'upload du CV<br>";
                } else {
                    $file_extension = strtolower(substr(strrchr($_FILES['artist_cv_file']['name'], '.'), 1));
                    if ($file_extension != "pdf") {
                        $search_artist_msg .= "Fichier du CV de l'artiste invalide, un pdf est attendu<br>";
                    } else {
                        # il faut vérifier s'il existait un cv ou pas
                        $cv_filename = $artist->getAuthorCV();
                        $continue = True;
                        if (is_null($cv_filename)) {
                            # y avait pas de cv, donc on met le nom de famille du compte utilisateur associé à l'artiste
                            $cv_filename = $artist->getAuthorSearchName();
                            $continue = $sql->setAuthorCV($artist, $cv_filename);
                        }
                        if ($continue) {
                            $path = "assets/cv/".$cv_filename;
                            $move_file = move_uploaded_file($_FILES['artist_cv_file']['tmp_name'], $path);
                            if (!$move_file) {
                                $search_artist_msg .= "Echec lors de l'upload du CV<br>";
                            } else {
                                $search_artist_msg .= "CV de l'artiste modifié avec succès<br>";
                            }
                        } else {
                                $search_artist_msg .= "Echec lors de la mise à jour du nom du fichier du CV dans la BDD<br>";
                        }
                    }
                }
            }

            if (is_uploaded_file($_FILES['artist_description_file_fr']['tmp_name'])) {
                if ($_FILES['artist_description_file_fr']['error'] > 0) {
                    $search_artist_msg .= "Echec lors de l'upload du fichier de description de l'artiste en français<br>";
                } else {
                    $file_extension = strtolower(substr(strrchr($_FILES['artist_description_file_fr']['name'], '.') ,1));
                    if ($file_extension != "txt") {
                        $search_artist_msg .= "Fichier de description en français invalide, un fichier texte (.txt) est attendu<br>";
                    } else {
                        $path = "assets/artists_descriptions/fr/".$artist->getAuthorDescription();
                        $move_file = move_uploaded_file($_FILES['artist_description_file_fr']['tmp_name'], $path);
                        if (!$move_file) {
                            $search_artist_msg .= "Echec lors de l'upload du fichier de description de l'artiste en français<br>";
                        } else {
                            $search_artist_msg .= "Fichier de description en français correctement modifié<br>";
                        }
                    }
                }
            }

            if (is_uploaded_file($_FILES['artist_description_file_en']['tmp_name'])) {
                if ($_FILES['artist_description_file_en']['error'] > 0) {
                    $search_artist_msg .= "Echec lors de l'upload du fichier de description de l'artiste en anglais<br>";
                } else {
                    $file_extension = strtolower(substr(strrchr($_FILES['artist_description_file_en']['name'], '.') ,1));
                    if ($file_extension != "txt") {
                        $search_artist_msg .= "Fichier de description en anglais invalide, un fichier texte (.txt) est attendu<br>";
                    } else {
                        $path = "assets/artists_descriptions/en/".$artist->getAuthorDescription();
                        $move_file = move_uploaded_file($_FILES['artist_description_file_en']['tmp_name'], $path);
                        if (!$move_file) {
                            $search_artist_msg .= "Echec lors de l'upload du fichier de description de l'artiste en anglais<br>";
                        } else {
                            $search_artist_msg .= "Fichier de description en anglais correctement modifié<br>";
                        }
                    }
                }
            }

            $artist = unserialize($sql->getAuthorByID($_POST['id']));
            $search_artist_msg .= "Cet artiste a désormais les propriétés suivantes :<br>";
            $search_artist_msg .= $artist->toString();
        }

        if (isset($_POST['delete-artist'])) {
            if (isset($_POST['id'])) {
                $artist = unserialize($sql->getAuthorByID($_POST['id']));
                $associated_user = unserialize($sql->getUserByID($artist->getAuthorAccount()));

                # on vérifie si l'artiste a des books
                $artist_has_books = false;
                foreach ($sql->getAllBooks() as $book) {
                    # pour chaque book, notre artiste en est-t'il effectivement son auteur ?
                    if (in_array($artist->getAuthorID(), $book->getBookAuthors())) {
                        $artist_has_books = true;
                    }
                }

                $search_artist_msg = "";
                if ($artist_has_books) {
                    $search_artist_msg = 'Impossible de supprimer le compteur artiste "'.$artist->getAuthorName().'" car il posséde des books. Il faut supprimer les books dont il est l\'auteur et réessayer la suppression du compte artiste.';
                } else {
                    $delete_user_success = $sql->deleteUser($artist->getAuthorAccount());
                    if ($delete_user_success) {
                        $delete_artist_success = $sql->deleteArtist($artist->getAuthorID());
                        if ($delete_artist_success) {
                            $search_artist_msg = "Suppression du compte artiste ayant pour id=".$_POST['id']." réussie et de son compte utilisateur associé";
                        } else {
                            $search_artist_msg = "Echec de la suppression du compte artiste \"".$artist->getAuthorName()."\" ayant pour id=".$_POST['id']."mais suppression de son compte utilisateur";
                        }
                    } else {
                        $search_artist_msg = "Echec de la suppression du compte utilisateur ayant pour id=".$_POST['id']."associé au compte de l'artiste ".$artist->getAuthorName();
                    }
                }
            }
        }

        if (isset($_POST['new_artist_form'])) {
            $new_artist_msg = "";
            $new_user_name = $_POST['name'];
            $cv_filename = NULL;
            $description_filename = strtolower($new_user_name).".txt";

            $file_upload_success_sofar = true;

            if (is_uploaded_file($_FILES['artist_cv_file']['tmp_name'])) {
                $cv_extension = strtolower(substr(strrchr($_FILES['artist_cv_file']['name'], '.'), 1));
                if ($cv_extension != "pdf") {
                    $new_artist_msg .= "Fichier du CV de l'artiste invalide, un pdf est attendu<br>";
                } else {
                    $cv_filename = strtolower($new_user_name).".pdf";
                    $path = "assets/cv/".$cv_filename;
                    $move_file = move_uploaded_file($_FILES['artist_cv_file']['tmp_name'], $path);
                    if (!$move_file) {
                        $file_upload_success_sofar = false;
                        $new_artist_msg .= "Echec lors de l'upload du CV<br>";
                    }
                }
            }

            if ($_FILES['artist_description_file_fr']['error'] > 0) {
                $file_upload_success_sofar = false;
                $new_artist_msg .= "Echec lors de l'upload du fichier de description français<br>";
            } else {
                $description_extension = strtolower(substr(strrchr($_FILES['artist_description_file_fr']['name'], '.')  ,1));
                if ($description_extension != "txt") {
                    $incorrect_file_extension_error = true;
                    $new_artist_msg .= "Fichier de description français de l'artiste invalide, un fichier texte (txt) est attendu<br>";
                } else {
                    $path = "assets/artists_descriptions/fr/".$description_filename;
                    $move_file = move_uploaded_file($_FILES['artist_description_file_fr']['tmp_name'], $path);
                    if (!$move_file) {
                        $file_upload_success_sofar = false;
                        $new_artist_msg .= "Echec lors de l'upload du fichier de description français<br>";
                    }
                }
            }

            //rebelote en anglais
            if ($_FILES['artist_description_file_en']['error'] > 0) {
                $file_upload_success_sofar = false;
                $new_artist_msg .= "Echec lors de l'upload du fichier de description anglais<br>";
            } else {
                $description_extension = strtolower(substr(strrchr($_FILES['artist_description_file_en']['name'], '.')  ,1));
                if ($description_extension != "txt") {
                    $incorrect_file_extension_error = true;
                    $new_artist_msg .= "Fichier de description anglais de l'artiste invalide, un fichier texte (txt) est attendu<br>";
                } else {
                    $path = "assets/artists_descriptions/en/".$description_filename;
                    $move_file = move_uploaded_file($_FILES['artist_description_file_en']['tmp_name'], $path);
                    if (!$move_file) {
                        $file_upload_success_sofar = false;
                        $new_artist_msg .= "Echec lors de l'upload du fichier de description anglais<br>";
                    }
                }
            }

            if ($file_upload_success_sofar) {
                //files correctly uploaded, we go on
                $new_user_mail = stripslashes($_POST['mail']);
                $new_user_sub_date = $_POST['subscripion_end_date'];
                //Si on utilise le formulaire, c'est pour créer un artiste
                $new_user_type = 4;
                $new_user_firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;

                $isUserCreated = createUser($new_user_mail, $new_user_type, $new_user_sub_date, $new_user_firstname, $new_user_name);

                if ($isUserCreated) {
                    $user = unserialize($sql->getUserByExactMail($new_user_mail));
                    $user_id = $user->getUserID();

                    $new_artist = new Author(0, $_POST['artist_name'], $user_id, $new_user_name, $description_filename, $cv_filename);
                    $success = $sql->addAuthor($new_artist);
                    if ($success) {
                        $new_artist_msg  .= "Succès : creation du compte artiste réussi";
                    } else {
                        $new_artist_msg .= "Echec lors de la creation du compte artiste";
                    }
                } else {
                    $new_artist_msg .= "Echec lors de la creation du compte user de l'artiste";
                }
            } else {
                $new_artist_msg .= "Echec lors de l'upload des fichiers de l'artiste";
            }
        }

        if (isset($_POST['new_book_form'])) {
            //$new_book_msg = "Haha je t'ai vu t'as cliqué! Bon désolé en fait ça rien pour l'instant...";
            $new_book_msg = "";
            //loo over DL files
            $dl_files = array();
            $dl_files[] = "full_book_file";
            $dl_files[] = "extract_book_file";
            $dl_files[] = "description_book_file_fr";
            $dl_files[] = "description_book_file_en";
            $dl_files[] = "cover_file";
            $dl_files[] = "cover_file_extract";
            $dl_files[] = "thumbnail_file";

            $file_upload_success_sofar = true;

            foreach ($dl_files as $file) {
                if ($_FILES[$file]['error'] > 0) {
                    $file_upload_success_sofar = false;
                }
            }
            $new_book_filename = explode(".", $_FILES['full_book_file']['name'], 2)[0];

            $move_file = move_uploaded_file($_FILES['description_book_file_fr']['tmp_name'], "assets/book_description/fr/".$new_book_filename.".txt");
            if (!$move_file) {
                $file_upload_success_sofar = false;
            }

            $move_file = move_uploaded_file($_FILES['description_book_file_en']['tmp_name'], "assets/book_description/en/".$new_book_filename.".txt");
            if (!$move_file) {
                $file_upload_success_sofar = false;
            }

            $move_file = move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], "assets/thumbnails/".$new_book_filename.".jpg");
            if (!$move_file) {
                $file_upload_success_sofar = false;
            }

            $move_file = move_uploaded_file($_FILES['cover_file']['tmp_name'], "assets/covers/".$new_book_filename.".jpg");
            if (!$move_file) {
                $file_upload_success_sofar = false;
            }

            $move_file = move_uploaded_file($_FILES['cover_file_extract']['tmp_name'], "assets/covers/".$new_book_filename."_EXTRAIT.jpg");
            if (!$move_file) {
                $file_upload_success_sofar = false;
            }

            if ($file_upload_success_sofar) {
                $move_file = move_uploaded_file($_FILES['extract_book_file']['tmp_name'], "assets/extracts/".$new_book_filename."_EXTRAIT.pdf");
                if (!$move_file) {
                    $file_upload_success_sofar = false;
                }
            }

            if ($file_upload_success_sofar) {
                $move_file = move_uploaded_file($_FILES['full_book_file']['tmp_name'], "bbff/".$new_book_filename.".pdf");
                if (!$move_file) {
                    $file_upload_success_sofar = false;
                }
            }

            //upload des fichiers sur le serveur réussis!
            if ($file_upload_success_sofar) {
                $infos_seems_correct = true;
                $title = $_POST['title'];
                $authors_ids = array();
                $authors_ids[] = $_POST['author']; //l'id de l'artiste specifie
                $collection = $_POST['collection'];
                if ($collection === "other") {
                    if (isset($_POST['new_collection'])) {
                        $collection = $_POST['new_collection'];
                    } else {
                        $infos_seems_correct = false;
                        $new_book_msg .= "Erreur : pas de nom specifie pour la nouvelle collection<br>";
                    }
                }
                $publish_date = $_POST['publish_date'];
                $date_format = '%Y-%m-%d';
                if (strptime($publish_date, $date_format)) {
                    //Date valide, tout est bon on peut créer notre user!
                } else {
                    $infos_seems_correct = false;
                    $new_book_msg .= "Erreur : la date specifie n'est pas au format valide<br>";
                }

                if ($infos_seems_correct) {
                    $new_book = new Book(0, $title, $new_book_filename, $authors_ids, $collection, $publish_date);
                    if ($sql->addBook($new_book)) {
                        $new_book_msg .= "Ajout du book réussi";
                    } else {
                        $new_book_msg .= "Echec de l'ajout du book à la base de données";
                    }
                }
            } else {
                $new_book_msg .= "upload failed :/";
            }
        }

        if (isset($_POST['set_fr_lang_file'])) {
            if ($_FILES['fr_lang_file']['error'] > 0) {
                $dl_fail_error = true;
            } else {
                $lang_file_extension = strtolower(substr(strrchr($_FILES['fr_lang_file']['name'], '.')  ,1)  );

                if ($lang_file_extension != "php") {
                    $incorrect_file_extension_error = true;
                } else {
                    $lang_file_name = "-lang.php";
                    $folder_path = "views/include/";

                    $move_fr_file = move_uploaded_file($_FILES['fr_lang_file']['tmp_name'], $folder_path."fr".$lang_file_name);
                    $msg_upload_lang_file = "fichier fr-lang.php mis à jour avec succès";
                }
            }
        }

        if (isset($_POST['set_en_lang_file'])) {
            if ($_FILES['en_lang_file']['error'] > 0) {
                $dl_fail_error = true;
            } else {
                $lang_file_extension = strtolower(substr(strrchr($_FILES['en_lang_file']['name'], '.')  ,1)  );

                if ($lang_file_extension != "php") {
                    $incorrect_file_extension_error = true;
                } else {
                    $lang_file_name = "-lang.php";
                    $folder_path = "views/include/";

                    $move_fr_file = move_uploaded_file($_FILES['en_lang_file']['tmp_name'], $folder_path."en".$lang_file_name);
                    $msg_upload_lang_file = "fichier en-lang.php mis à jour avec succès";
                }
            }
        }

        if (isset($_GET['dl'])) {
                switch ($_GET['dl']) {
                        case 'fr':
                        case 'en':
                                $file = 'views/include/'.$_GET['dl'].'-lang.php';
                                if (file_exists($file)) {
                                    header('Content-Description: File Transfer');
                                    header('Content-Type: application/octet-stream');
                                    header('Content-Disposition: attachment; filename="'.basename($file).'"');
                                    header('Expires: 0');
                                    header('Cache-Control: must-revalidate');
                                    header('Pragma: public');
                                    header('Content-Length: ' . filesize($file));
                                    readfile($file);
                                    exit;
                                }
                                break;

                        default:
                                //version pas reconnue, on envoie rien à part un message?
                                break;
                }
        }
    }

    include_once('./views/admin.php');
?>
