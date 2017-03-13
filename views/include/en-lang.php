<?php
 	 
	//---------------------------------------------------------
	// communs à plusieurs pages
	//---------------------------------------------------------	
	
	
	define('TXT_INTERDICTION', "You can't access this page");
	define('TXT_CONFIRMER', "Update");

	//---------------------------------------------------------
	// barre de navigation et noms des pages associées
	//---------------------------------------------------------
 
 	define('TXT_A_PROPOS', 'About');
 	define('TXT_ARTISTES', 'Artists');
  	define('TXT_CONTACT', 'Contact');
	define('TXT_ADHERER', 'Join');
	define('TXT_LANGUE', "Language");
	
	//---------------------------------------------------------
 	// index.php
 	//---------------------------------------------------------
 	 
 	define('TXT_CONNEXION', 'Login');
	define('TXT_RECHERCHE', 'Search');
	define('TXT_RECHERCHE_EXTRAITS', 'Extracts');
	define('TXT_BONJOUR', 'Hello');
	define('TXT_MENU', 'You can');
	define('TXT_COMPTE', 'Manage your account');
	define('TXT_OEUVRES', 'Manage your books');
	define('TXT_OEUVRES_ADMIN', 'Manage all books');
	define('TXT_COMPTES_ADMIN', 'Manage all users');
	define('TXT_SE_DECONNECTER', "Logout");
	define('TXT_SE_CONNECTER', "Login");
	
	
	//---------------------------------------------------------
 	// book_management.php
 	//---------------------------------------------------------	
		
 	define('TXT_GESTION_BOOK_AUTEUR', 'Manage your books');
	define('TXT_GESTION_BOOK_ADMIN', 'Manage all books');
	
	
	//---------------------------------------------------------
 	// user_settings.php
 	//---------------------------------------------------------	
		
 	define('TXT_GESTION_COMPTE_USER', 'Your account');
	define('TXT_NOUVEAU_MAIL', 'Your new mail adress');
	define('TXT_MAIL_ACTUEL', 'Your current mail adress :');
	define('TXT_MAIL_CONFIRM', 'Your mail is now :');
	define('TXT_MDP_ACTUEL', 'Current password');
	define('TXT_NOUVEAU_MPD', 'New password');  
	define('TXT_CONFIRME_MDP', 'Confirm your new password');
	define('TXT_COTISATION', "Your membership lasts until :"); 
	define('TXT_MODIF_MAIL', 'Change your e-mail');
	define('TXT_MODIF_MDP', "Change your password"); 
	
	
	//---------------------------------------------------------
 	// user_management.php
 	//---------------------------------------------------------	
		
 	define('TXT_GESTION_DES_UTILISATEURS', 'Page de gestion des utilisateurs');
	define('TXT_RECHERCHE_UTILISATEUR', 'Rechercher les informations sur un utilisateur');
	define('TXT_NOUVEL_UTILISATEUR', "Création d'un compte utilisateur du site");
	// EN ATTENTE DE VALIDATION
	
	
	//---------------------------------------------------------
 	// join.php
 	//---------------------------------------------------------	
		
 	define('TXT_ADHESION', 'Join');
	define('TXT_ADHESION_TUTO', "<p>Follow the link...</p>
            <p>Après votre adhésion, vous recevrez par mail le lien vers les opening books sous 48 heures.</p>
            <p><a href=".'"https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015" target="_blank"'."> Adhérer ou renouveler sa cotisation</a> </p>
            <p>En adhérant à l’association Opening :  </p>
            <ul>
                <li>vous contribuez à soutenir les artistes  </li>
                <li>vous découvrez les opening books dans leur intégralité </li>
            </ul>
            <p>Montant de la cotisation :</p>
            <p>30 € par an </p>
            <p>Opening est une association loi 1901 répondant aux critères de l’intérêt général, ce qui vous permet de défiscaliser une partie de vos dons et cotisations.</p>
            <p>Vous pouvez également envoyer un chèque à l’ordre d’Opening  68 rue des dominicaines 13001 Marseille en indiquant vos coordonnées ainsi qu’une adresse mail.</p>
            <p>Vous recevrez ensuite par mail le lien vers les opening books.</p>");
	
	
	//---------------------------------------------------------
 	// edito.php
 	//---------------------------------------------------------	
		
 	define('TXT_EDITO', 'Edito');
	define('TXT_EDITO_TEXTE', "<p>Opening book is .......... </p>
                    <p>Opening book n’est ni catalogue d’exposition, ni monographie (il ne tend pas à l’exhaustivité et ne propose pas d’outil critique), ni livre d’artiste (ce n’est pas une création artistique en soi), ni book d’artiste au sens classique du terme.</p>
                    <p>Opening book est un format pré-défini de douze pages offertes à un artiste pour y exposer douze œuvres et les diffuser sur tout type d’écran : ordinateur, tablette, smartphone. La collection propose une approche directe des œuvres grâce à la qualité des reproductions, à une mise en page épurée construite autour de l’œuvre et du détail et à un mode de navigation conçu pour le numérique.</p>
                    <p>Opening book est aussi un dispositif qui offre aux artistes des outils essentiels pour promouvoir leur travail : des reproductions photographiques de qualité professionnelle, une interface de gestion en ligne des archives photographiques (espace membres) et l’inscription dans un large réseau de diffusion.</p>
                    <a href=".'"join.php"'.">Pour consulter les opening books dans leur intégralité, devenez adhérents.</a>");
 
 
 ?>