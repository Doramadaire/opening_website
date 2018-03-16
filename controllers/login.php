<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    session_start();
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    if ($user_logged) {  // si t'es connecté t'as rien à faire là : retourne à l'accueil
        header('Location: index.php');
    }

    if (isset($_POST['logging_form'])) {  // le formulaire de connexion a été remplie
        $mail_received = stripslashes($_POST['mail']);
        $pswd_received = stripslashes($_POST['password']);
        if ($mail_received != '') {
            if ($sql->checkUserPassword($mail_received, $pswd_received)) {  # Identifiants et mdp corrects, on peut connecter notre visiteur
                $user_retrieved = $sql->getUserByExactMail($mail_received);
                $user_logged = unserialize($user_retrieved);
                $_SESSION['user_logged'] = $user_logged;
                header('Location: index.php');
            } else {  # mdp incorrect
                $logging_error = "mail ou mot de passe incorrect";
            }
        } else {  # mail invalide
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
            $msg_reset_pswd = "Un nouveau mot de passe a été généré pour et envoyé à l'adresse : <b> ".$_POST['mail_pswd_forgotten'];
            // Envoi d'un mail pour activer le compte avec le mdp généré, et invitation à le changer
            // Préparation du mail contenant le lien d'activation
            $destinataire = $user->getUserMail();
            $sujet = "Modification du mot de passe de votre compte sur le site Opening book";
            $headers = "From: support@opening-book.com\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\n";
            $headers .='Content-Transfer-Encoding: 8bit';
            //Message de confirmation
            $message = '<html><body style="font-size:20px;">
            <p>Vous avez demandé la génération d\'un nouveau mot de passe pour votre compte.<br>
            Voici votre nouveau mot de passe : '.$new_password.'<br>
            Je vous conseille de le modifier dès votre prochaine visite sur notre site. Pour cela, identifiez-vous sur <a href="https://opening-book.com/index.php">opening-book.com</a> et allez sur la page "Gestion de votre compte".<p>

            <p>Nous vous souhaitons une agréable consultation de notre collection.</p>
            ---------------
            <p>Ceci est un mail automatique, merci de ne pas y répondre.<br>
            Si vous rencontrer des difficultés lors de l\'utilisation de notre site, vous pouvez contactez <a href="mailto:support@opening-book.com">support@opening-book.com</a><br>
            <img style="float: right;" src="https://opening-book.com/assets/logo.png" width="80px" height="47px"></p></body></html>';
            mail($destinataire, $sujet, $message, $headers); // Envoi du mail
        }
    }

	include_once('./views/login.php');

?>