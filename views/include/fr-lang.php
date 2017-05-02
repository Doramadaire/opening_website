
<?php
 	
	//---------------------------------------------------------
	// généraux
	//---------------------------------------------------------	
	
	define('TXT_ONGLET', "Opening");
	define('TXT_INTERDICTION', "Vous n'avez pas le droit d'accéder à cette page");
	define('TXT_CONFIRMER', "Confirmer");
	
	//---------------------------------------------------------
	// barre de navigation et noms des pages associées
	//---------------------------------------------------------
 
 	define('TXT_NAVBAR_A_PROPOS', 'à propos');
 	define('TXT_NAVBAR_CATALOGUE', 'collections');
  	define('TXT_NAVBAR_CONTACT', 'contact');
  	define('TXT_NAVBAR_NEWS', 'actualités');
	define('TXT_NAVBAR_ADHERER', "adhérer");
	define('TXT_NAVBAR_LANGUE', "langue");

	define('TXT_MENU', 'vous pouvez');
	define('TXT_MENU_COMPTE', 'Gérer votre compte');
	define('TXT_MENU_OEUVRES', 'Partager vos books');
	define('TXT_MENU_OEUVRES_ADMIN', 'Partager les books');
	define('TXT_MENU_ADMIN_PAGE', "Aller à la page d'administration");

	define('TXT_SECTION_CONNEXION', 'Connectez-vous');
	define('TXT_NAVBAR_DISCONNECT', "Vous déconnecter");
	
	//---------------------------------------------------------
 	// index.php
 	//---------------------------------------------------------

	define('TXT_TAB_INDEX', "Accueil - association Opening");

	define('TXT_SECTION_RECHERCHE', 'Parcourir la collection');
	define('TXT_MENU_RECHERCHE', 'Parcourir la collection');
	define('TXT_MENU_RECHERCHE_EXTRAITS', 'Parcourir la collection (seulement des extraits)');
	define('TXT_BONJOUR', 'Bonjour');

	define('TXT_BOUTON_SE_CONNECTER', "se connecter");
	define('TXT_BOUTON_SE_DECONNECTER', "Se déconnecter");

	define('TXT_ATTENTION_MDP_OUBLIE', "Attention! Cette action génére un nouveau mot de passe qui sera envoyé à l'adresse mail de votre compte");
	define('TXT_BOUTON_RESET_MDP_OUBLIE', "Générer un nouveau mot de passe");
	define('TXT_MDP_OUBLIE', "Mot de passe oublié?");
	define('TXT_RESET_PSWD_SUCCESS', 'Un nouveau mot de passe vous a été envoyé par mail');
	
	define('TXT_BOUTON_RECHERCHE', "Recherche");
	define('TXT_BOUTON_ADHERER', "Adhérer");
	
	define('TXT_SECTION_ADHERER', "Pour adhérer ");
	define('TXT_ADHERER', "Pour adhérer à l'association ou renouveler votre cotisation, vous serez redirigé vers Helloasso.");
	
	define('TXT_PLACEHOLDER_MAIL', "e-mail");
	define('TXT_PLACEHOLDER_FIRSTNAME', "Prénom");
	define('TXT_PLACEHOLDER_NAME', "Nom");
	define('TXT_PLACEHOLDER_MDP', "mot de passe");	

	//---------------------------------------------------------
 	// catalogue.php
 	//---------------------------------------------------------

 	define('TXT_TAB_CATALOGUE', "L'ensemble de notre collection - Retrouvez tous nos Opening book - Opening");
	
	define('TXT_SECTION_CATALOGUE_ALL', "Les books");
	define('TXT_SECTION_CATALOGUE_ARTISTS', "Par artiste");
	define('TXT_SECTION_CATALOGUE_COLLECTION', "Par collection");

	define('TXT_NO_AUTHOR_FOUND', 'Aucun auteur trouvé');

	define('TXT_BUTTON_BACK', "Retourner à l'ensemble des collections");

	define('TXT_BOOK_BY', 'Par');
	define('TXT_BOOK_BY_AND', 'et');
		
	//---------------------------------------------------------
 	// book_management.php
 	//---------------------------------------------------------	

 	define('TXT_TAB_BOOK_MANAGEMENT', "Partage de vos Opening books - Opening");
		
 	define('TXT_SECTION_GESTION_BOOK_AUTEUR', 'Page de gestion de vos books');
	define('TXT_SECTION_GESTION_BOOK_ADMIN', 'Page de gestion des books');

	define('TXT_SHARE_BOOK_EXPLANATION', "Sur cette page vous pouvez générer des liens d'accès privilégiés vers vos Opening book. N'importe quelle personne disposant du lien pourra alors consulter l'oeuvre correspondante.");
	define('TXT_SHARE_BOOK_LINK_GENERATION_FAIL', "Echec de la création du lien privilégié");
	define('TXT_SHARE_BOOK_LINK', "Voici le lien d'accès privilégié pour accéder à l'");

	define('TXT_ARTIST_BOOK_MANAGEMENT', "Vos books");

	//---------------------------------------------------------
 	// book_viewer.php
 	//---------------------------------------------------------

 	define('TXT_TAB_BOOK_VIEWER', "Consultation d'un Opening book - Opening");

 	define('TXT_VISITOR', "Attention, en tant que visiteur vous n'avez accès qu'à des extraits.");
 	define('TXT_USER_SUBSCRIPTION_EXPIRED', "Attention, votre cotisation n'est pas à jour. Vous n'avez accès qu'à des extraits des books.");
 	define('TXT_BOOK_VIEWER_EXPLANATION', 'Veuillez cliquer sur la couverture pour démarrer la consultation de cet opening book');
 	define('TXT_ARTIST_CV', 'Consulter son CV');

	//---------------------------------------------------------
 	// user_settings.php
 	//---------------------------------------------------------	
	
	define('TXT_TAB_USER_SETTINGS', "Gestion de votre compte - Opening");

 	define('TXT_GESTION_COMPTE_USER', 'Gestion de votre compte');
	define('TXT_NOUVEAU_MAIL', 'Votre nouvelle adresse');
	define('TXT_MAIL_ACTUEL', 'Votre adresse mail actuelle est : ');
	define('TXT_MAIL_CONFIRM', 'Votre mail est désormais : ');
	define('TXT_MDP_ACTUEL', 'Mot de passe actuel');
	define('TXT_NOUVEAU_MPD', 'Nouveau mot de passe');  
	define('TXT_CONFIRME_MDP', 'Confirmer le nouveau mot de passe');
	define('TXT_COTISATION', "Cotisation effective jusqu'au "); 
	define('TXT_MODIF_MAIL', "Modifier votre adresse e-mail");
	define('TXT_MODIF_MDP', 'Modifier votre mot de passe'); 
	
	//---------------------------------------------------------
 	// admin.php
 	//---------------------------------------------------------	
		
	define('TXT_TAB_ADMIN', "Page d'administration - Opening");

 	define('TXT_GESTION_DES_UTILISATEURS', "Page d'administration");
	define('TXT_RECHERCHE_UTILISATEUR', 'Rechercher des informations sur un utilisateur');
	define('TXT_RECHERCHE_USER_QUESTION', "Quel utilisateur recherchez-vous?");
	define('TXT_BOUTON_RECHERCHE_UTILISATEUR', "Rechercher un utilisateur");
	define('TXT_RECHERCHE_AUTHOR', 'Rechercher des informations sur un auteur');
	define('TXT_RECHERCHE_AUTHOR_QUESTION', "Quel auteur recherchez-vous?");
	define('TXT_BOUTON_SEARCH_AUTHOR', "Rechercher un auteur");
	define('TXT_NOUVEL_UTILISATEUR', "Création d'un compte utilisateur du site");
	
	define('TXT_TYPE_COMPTE', "Quel type de compte souhaitez vous créer?");
	define('TXT_TYPE_NON_ADHERENT', "Compte non adhérent");
	define('TXT_TYPE_ADHERENT', "Compte adhérent (cotisant à jour)");
	define('TXT_TYPE_ARTISTE', "Compte artiste");
	define('TXT_TYPE_ADMINISTRATEUR', "Compte administrateur");
	
	define('TXT_PLACEHOLDER_DATE', "Date AAAA-MM-JJ");
	define('TXT_CREER_COMPTE', "Créer l'utilisateur");
	
	define('TXT_NOUVEL_ARTISTE', "Création d'un compte artiste");
	define('TXT_PLACEHOLDER_ARTIST_NAME', "Pseudo");	
	define('TXT_AUTHOR_SUBMIT_CV', "Fichier PDF du CV de l'artiste (optionnel)");	
	define('TXT_CREER_ARTISTE', "Ajout de l'artiste");

	define('TXT_SECTION_NEWS', "Actualités");

	define('TXT_AJOUT_BOOK', "Ajout d'un objet book");
	define('TXT_AJOUT_BOOK2', "On va ajouter un book");
	define('TXT_FICHIER_COMPLET', "Le fichier du book : ");
	define('TXT_FICHIER_EXTRAIT', "Le fichier de l'extrait : ");
	define('TXT_BOOK_DESCRIPTION_FILE', "Le fichier de description du book : ");
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

	define('TXT_SECTION_LANG', "Modifier les fichiers textes de langue");
	define('TXT_UPLOAD_LANG_FILES', "Uploader les différents fichiers de langue");
	define('TXT_BUTTON_SEND', "Envoyer");
	define('TXT_LANG_FILE_FR', "Fichier des textes en français");
	define('TXT_LANG_FILE_EN', "Fichier des textes en anglais");
	define('TXT_LANG_FILE_DE', "Fichier des textes en allemand");
	define('TXT_LANG_FILE_ES', "Fichier des textes en espagnol");
	define('TXT_LANG_FILE_IT', "Fichier des textes en italien");	
	
	//---------------------------------------------------------
 	// join.php
 	//---------------------------------------------------------	

 	define('TXT_TAB_JOIN', "Adhérez à l'association - Opening");
		
 	define('TXT_SECTION_ADHESION', 'Adhérer');
	define('TXT_ADHESION_TEXTE', "En adhérant à l’association Opening :<br>
            <ul>
                <li>vous contribuez à soutenir les artistes  </li>
                <li>vous découvrez les opening books dans leur intégralité </li>
            </ul>
            Montant de la cotisation : 30 € par an<br>
            Opening est une association loi 1901 répondant aux critères de l’intérêt général, ce qui vous permet de défiscaliser une partie de vos dons et cotisations.<br>
			<p>Vous pouvez adhérer en remplissant le formulaire ci-dessous ou en envoyant un chèque à l’ordre d’Opening 68 rue des Dominicaines 13001 Marseille en indiquant vos coordonnées ainsi qu’une adresse mail. Vous recevrez ensuite par mail le lien vers les opening books.</p>
			Laissez-vous guider par le formulaire ci-dessous pour l’adhésion en ligne et le paiement sécurisé<br>");
	
	
	//---------------------------------------------------------
 	// about.php
 	//---------------------------------------------------------	
	
	define('TXT_TAB_ABOUT', "A propos de notre association - Opening");

 	define('TXT_SECTION_EDITO', 'Edito');
	define('TXT_EDITO_TEXTE', "<p>Opening book est un nouvel objet artistique et éditorial conçu pour donner une visibilité aux artistes photographes et plasticiens actifs en région Paca, connus ou moins connus.</p>
                    <p>Opening book n’est ni catalogue d’exposition, ni monographie (il ne tend pas à l’exhaustivité et ne propose pas d’outil critique), ni livre d’artiste (ce n’est pas une création artistique en soi), ni book d’artiste au sens classique du terme.</p>
                    <p>Opening book est un format pré-défini de douze pages offertes à un artiste pour y exposer douze œuvres et les diffuser sur tout type d’écran : ordinateur, tablette, smartphone. La collection propose une approche directe des œuvres grâce à la qualité des reproductions, à une mise en page épurée construite autour de l’œuvre et du détail et à un mode de navigation conçu pour le numérique.</p>
                    <p>Opening book est aussi un dispositif qui offre aux artistes des outils essentiels pour promouvoir leur travail : des reproductions photographiques de qualité professionnelle, une interface de gestion en ligne des archives photographiques (espace membres) et l’inscription dans un large réseau de diffusion.</p>
                    <a href=".'"join.php"'.">Pour consulter les opening books dans leur intégralité, devenez adhérents.</a>");

	//---------------------------------------------------------
 	// news.php
 	//---------------------------------------------------------	
 
 	define('TXT_TAB_NEWS', "Actualités de l'association et de nos artistes - Opening");
	
	define('TXT_SECTION_ACTUALITES', 'Actualités');
	define('TXT_ACTUALITES_VIDE', "Il n'y a aucune nouvelle à afficher");
	
	//---------------------------------------------------------
 	// contact.php
 	//---------------------------------------------------------	
	
	define('TXT_TAB_CONTACT', "Contact - Opening");

 	define('TXT_SECTION_CONTACT', 'Contact');
	define('TXT_CONTACT_TEXTE', "
			Association Opening<br>
			68 rue des dominicaines<br>
			13001 Marseille<br>
			tel +33 (0)7 83 30 59 45<br>
			mail : <a href=".'"mailto:contact@opening-book.com"'.">contact@opening-book.com</a><br>
			<a href=".'"https://www.facebook.com/opening-book-872866662728445/"'.">facebook</a><br>
			<a href=".'"https://twitter.com/opening_asso"'.">twitter</a><br>");
 
 ?>