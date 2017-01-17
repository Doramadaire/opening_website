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
	setUserMail($user_logged, $new_mail);
	$user_logged->setUserMail($new_mail]);
	//on vérfie que les modifs sont un succès
	$user_retrieved = $sql->getUserByMail($new_mail);
	$user_retrieved = unserialize($user_retrieved);
	if ($user_retrieved === $user_logged) {
		$msg_new_mail = "Mail de l'utilisateur modifiée avec succès";
	} else {
		$msg_new_mail = "Y a une couille dans le paté :/";
	}
}

if (isset($_POST['adresse'])) {
		$mail = $_POST['mail'];
		$new_mail = $_POST['new_mail'];
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
}

	include_once('./views/user_settings.php');
	
?>