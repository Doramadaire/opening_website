<?php
 	 
	//---------------------------------------------------------
	// généraux
	//---------------------------------------------------------	
	
	define('TXT_ONGLET', "Opening");
	define('TXT_INTERDICTION', "You can't access this page");
	define('TXT_CONFIRMER', "Update");
	
	
	//---------------------------------------------------------
	// barre de navigation et noms des pages associées
	//---------------------------------------------------------
 
 	define('TXT_NAVBAR_A_PROPOS', 'About');
 	define('TXT_NAVBAR_ARTISTES', 'Artists');
  	define('TXT_NAVBAR_CONTACT', 'Contact');
	define('TXT_NAVBAR_ADHERER', 'Join');
	define('TXT_NAVBAR_LANGUE', "Language");
	
	//---------------------------------------------------------
 	// index.php
 	//---------------------------------------------------------
 	 
 	define('TXT_SECTION_CONNEXION', 'Login');
	define('TXT_SECTION_RECHERCHE', 'Library');
	define('TXT_MENU_RECHERCHE', 'Find book');
	define('TXT_MENU_RECHERCHE_EXTRAITS', 'Find extract');
	define('TXT_BONJOUR', 'Hello');
	define('TXT_MENU', 'You can');
	define('TXT_MENU_COMPTE', 'Manage your account');
	define('TXT_MENU_OEUVRES', 'Manage your books');
	define('TXT_MENU_OEUVRES_ADMIN', 'Manage all books');
	define('TXT_MENU_COMPTES_ADMIN', 'Manage all users');
	
	define('TXT_BOUTON_SE_DECONNECTER', "Logout");
	define('TXT_BOUTON_SE_CONNECTER', "Login");
	define('TXT_ATTENTION_MDP_OUBLIE', "Warning! Will send a new password in your mailbox");
	define('TXT_BOUTON_RESET_MDP_OUBLIE', "Send me a new password");
	define('TXT_MDP_OUBLIE', "Forgotten password?");
	
	define('TXT_BOUTON_RECHERCHE', "Search");
	define('TXT_BOUTON_ADHERER', "Join");
	
	define('TXT_SECTION_ADHERER', "Join");
	define('TXT_ADHERER', "To join, you have to go...");
	
	define('TXT_PLACEHOLDER_MAIL', "e-mail");
	define('TXT_PLACEHOLDER_MDP', "password");
	
	
	//---------------------------------------------------------
 	// book_management.php
 	//---------------------------------------------------------	
		
 	define('TXT_SECTION_GESTION_BOOK_AUTEUR', 'Page de gestion de vos oeuvres');
	define('TXT_SECTION_GESTION_BOOK_ADMIN', 'Page de gestion des oeuvres');
	
	define('TXT_AJOUT_BOOK', "Ajout d'un objet book");
	define('TXT_AJOUT_BOOK2', "On va ajouter un book");
	define('TXT_FICHIER_COMPLET', "Le fichier du book : ");
	define('TXT_FICHIER_EXTRAIT', "Le fichier de l'extrait : ");
	define('TXT_COLLECTION', "Collection : ");
	define('TXT_COLLECTION_OPENINGBOOK', "OpeningBook");
	define('TXT_COLLECTION_OPENINGBOOK_PHOTO', "OpeningBook Photo");
	define('TXT_ANNEE', "Année : ");
	
	define('TXT_BOUTON_CREER_BOOK', "Créer le book");
	
	define('TXT_COLLECTION_OPENINGBOOK_AUTRE', "Nouvelle collection");
	define('TXT_PLACEHOLDER_TITRE', "Titre");

	define('TXT_ERR_UPLOAD_FAIL', "Erreur lors du transfert des fichiers");	
	define('TXT_ERR_INCORRECT_FILE_EXTENSION', "Erreur : extension du fichier incorrecte. Veuillez charger un document au format PDF");
	
	define('TXT_NEW_BOOK_SUCCESS', "Book chargé en base avec succès");
	
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
	define('TXT_RECHERCHE_QUESTION', "Quel utilisateur recherchez-vous?");
	define('TXT_BOUTON_RECHERCHE_UTILISATEUR', "Rechercher l'utilisateur");
	define('TXT_NOUVEL_UTILISATEUR', "Création d'un compte utilisateur du site");
	
	define('TXT_TYPE_COMPTE', "Quel type de compte souhaitez vous créer?");
	define('TXT_TYPE_NON_ADHERENT', "Compte non adhérent");
	define('TXT_TYPE_ADHERENT', "Compte adhérent (cotisant à jour)");
	define('TXT_TYPE_ARTISTE', "Compte artiste");
	define('TXT_TYPE_ADMINISTRATEUR', "Compte administrateur");
	
	define('TXT_PLACEHOLDER_DATE', "Date AAAA-MM-JJ");
	define('TXT_CREER_COMPTE', "Créer l'utilisateur");
	
	define('TXT_NOUVEL_ARTISTE', "Création d'un compte artiste");
	define('TXT_PLACEHOLDER_NAME', "Nom");	
	define('TXT_AUTHOR_SUBMIT_CV', "Fichier PDF du CV de l'artiste (optionnel)");
	define('TXT_CREER_ARTISTE', "Ajout de l'artiste");
	
	
	//---------------------------------------------------------
 	// join.php
 	//---------------------------------------------------------	
		
 	define('TXT_SECTION_ADHESION', 'Join');
	define('TXT_ADHESION_TEXTE', "<p>Follow the link...</p>
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
		
 	define('TXT_SECTION_EDITO', 'Edito');
	define('TXT_EDITO_TEXTE', "<p>Opening book is .......... </p>
                    <p>Opening book n’est ni catalogue d’exposition, ni monographie (il ne tend pas à l’exhaustivité et ne propose pas d’outil critique), ni livre d’artiste (ce n’est pas une création artistique en soi), ni book d’artiste au sens classique du terme.</p>
                    <p>Opening book est un format pré-défini de douze pages offertes à un artiste pour y exposer douze œuvres et les diffuser sur tout type d’écran : ordinateur, tablette, smartphone. La collection propose une approche directe des œuvres grâce à la qualité des reproductions, à une mise en page épurée construite autour de l’œuvre et du détail et à un mode de navigation conçu pour le numérique.</p>
                    <p>Opening book est aussi un dispositif qui offre aux artistes des outils essentiels pour promouvoir leur travail : des reproductions photographiques de qualité professionnelle, une interface de gestion en ligne des archives photographiques (espace membres) et l’inscription dans un large réseau de diffusion.</p>
                    <a href=".'"join.php"'.">Pour consulter les opening books dans leur intégralité, devenez adhérents.</a>");
 
 
 
	//---------------------------------------------------------
 	// contact.php
 	//---------------------------------------------------------	
		
 	define('TXT_SECTION_CONTACT', 'Contact');
	define('TXT_CONTACT_TEXTE', "
			<p> Association Opening</p>
			<p>68 rue des dominicaines </p>
			<p>13001 Marseille</p>
			<p>tel +33 (0)7 83 30 59 45</p>
			<p>mail : <a href=".'"mailto:contact@opening-book.com"'."> contact@opening-book.com </a> </p>
			<p>facebook <a class=".'""'." href=".'"#"'."> <img class=".'""'." alt=".'""'." src=".'"..."'."> </a>  </p>
			<p>twitter <a class=".'""'." href=".'"#"'."> <img class=".'""'." alt=".'""'." src=".'"..."'."> </a>  </p>");
 
 ?>