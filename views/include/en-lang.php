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

    define('TXT_NAVBAR_HOME', 'home');
    define('TXT_NAVBAR_A_PROPOS', 'about');
    define('TXT_NAVBAR_CATALOGUE', 'collection');
    define('TXT_NAVBAR_CONTACT', 'contact');
    define('TXT_NAVBAR_NEWS', 'news');
    define('TXT_NAVBAR_ADHERER', 'join us');
    define('TXT_NAVBAR_LANGUE', "language");

    define('TXT_MENU', 'you can');
    define('TXT_MENU_COMPTE', 'Manage your account');
    define('TXT_MENU_OEUVRES', 'Share your books');
    define('TXT_MENU_OEUVRES_ADMIN', 'Share books');
    define('TXT_MENU_ADMIN_PAGE', "Go to the administration page");
    define('TXT_MENU_RECHERCHE', 'Find book');
    define('TXT_MENU_RECHERCHE_EXTRAITS', 'Find extract');

    define('TXT_NAVBAR_DISCONNECT', "Log out");

    define('TXT_FOOTER_BACK_HOME', "R"); # Back to home page

    //---------------------------------------------------------
    // index.php
    //---------------------------------------------------------

    define('TXT_TAB_INDEX', "Homepage - Opening book association");

    define('TXT_BONJOUR', 'Hello');

    define('TXT_H3_SECTION_CONNEXION', 'Have an account ?');
    define('TXT_BOUTON_SE_CONNECTER', "log in");
    define('TXT_BOUTON_SE_DECONNECTER', "log out");

    define('TXT_PLACEHOLDER_MAIL', "e-mail");
    define('TXT_PLACEHOLDER_FIRSTNAME', "firstname");
    define('TXT_PLACEHOLDER_NAME', "Name");
    define('TXT_PLACEHOLDER_MDP', "password");

    define('TXT_ATTENTION_MDP_OUBLIE', "Warning! Will send a new password in your mailbox");
    define('TXT_BOUTON_RESET_MDP_OUBLIE', "Send me a new password");
    define('TXT_MDP_OUBLIE', "Password forgotten ?");
    define('TXT_RESET_PSWD_SUCCESS', 'A mail with your new password has been sent');

    define('TXT_H3_SECTION_RECHERCHE', 'Découvrir opening book');
    define('TXT_P_RECHERCHE', 'des collections numériques à la croisée du livre d’art et du book d’artiste');
    //exemple balise liens : <a href="about.php"><b>En savoir plus</b></a>
    define('TXT_BOUTON_VISITOR_COLLECTION', "découvrir des extraits");
    define('TXT_BOUTON_LOGGED_COLLECTION', "découvrir les collections");

    define('TXT_H3_SECTION_ADHERER', "Subscribe");
    define('TXT_P_ADHERER', "Get access to our entire collection");
    define('TXT_BOUTON_ADHERER', "subscribe");

    //---------------------------------------------------------
    // catalogue.php
    //---------------------------------------------------------

    define('TXT_TAB_CATALOGUE', "Our entire collection - Navigate through all our Opening books - Opening book");

    define('TXT_SECTION_CATALOGUE_ALL', "Books");
    define('TXT_SECTION_CATALOGUE_ARTISTS', "Artists");
    define('TXT_SECTION_CATALOGUE_COLLECTION', "Collections");

    define('TXT_NO_AUTHOR_FOUND', 'No author found');

    define('TXT_BUTTON_BACK', 'Back to our entire collection');

    define('TXT_BOOK_BY', 'By');
    define('TXT_BOOK_BY_AND', 'and');

    //---------------------------------------------------------
    // book_management.php
    //---------------------------------------------------------

    define('TXT_TAB_BOOK_MANAGEMENT', "Partage de vos Opening books - Opening book");

    define('TXT_SECTION_GESTION_BOOK_AUTEUR', 'Page de gestion de vos books');
    define('TXT_SECTION_GESTION_BOOK_ADMIN', 'Page de gestion des books'); # texte vu par admin uniquement

    define('TXT_SHARE_BOOK_EXPLANATION', "Sur cette page vous pouvez générer des liens d'accès privilégiés vers vos Opening book. N'importe quelle personne disposant du lien pourra alors consulter l'oeuvre correspondante.");
    define('TXT_SHARE_BOOK_LINK_GENERATION_FAIL', "Echec de la création du lien privilégié");
    define('TXT_SHARE_BOOK_LINK', "Voici le lien d'accès privilégié pour accéder à l'");

    define('TXT_ARTIST_BOOK_MANAGEMENT', "Vos books");

    //---------------------------------------------------------
    // book_viewer.php
    //---------------------------------------------------------

    define('TXT_TAB_BOOK_VIEWER', "Consultation d'un Opening book - Opening book");

    define('TXT_VISITOR', "As visitor you only have access to extracts.");
    define('TXT_USER_SUBSCRIPTION_EXPIRED', "Your contribution is not up to date. You only have access to extracts of portfolios.");
    define('TXT_BOOK_VIEWER_EXPLANATION', 'Click the cover to start the reading');
    define('TXT_ARTIST_CV', 'Read CV');

    define('TXT_BACK_TO_COLLECTION_BOOKS', 'collection ');
    define('TXT_BACK_TO_ARTIST_BOOKS', "");
    define('TXT_BACK_TO_CATALOGUE', "toutes les collections");

    //---------------------------------------------------------
    // user_settings.php
    //---------------------------------------------------------

    define('TXT_TAB_USER_SETTINGS', "Manage your account - Opening book");

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
    // admin.php
    //---------------------------------------------------------

    define('TXT_TAB_ADMIN', "Page d'administration - Opening book");

    define('TXT_GESTION_DES_UTILISATEURS', "Page d'administration");
    define('TXT_RECHERCHE_UTILISATEUR', 'Rechercher des informations sur un utilisateur');
    define('TXT_RECHERCHE_USER_QUESTION', "Quel utilisateur recherchez-vous?");
    define('TXT_BOUTON_RECHERCHE_UTILISATEUR', "Rechercher un utilisateur");
    define('TXT_RECHERCHE_AUTHOR', 'Rechercher des informations sur un auteur');
    define('TXT_RECHERCHE_AUTHOR_QUESTION', "Quel auteur recherchez-vous?");
    define('TXT_BOUTON_SEARCH_AUTHOR', "Rechercher un auteur");
    define('TXT_NOUVEL_UTILISATEUR', "Création d'un compte utilisateur du site");

    define('TXT_TYPE_COMPTE', "Quel type de compte souhaitez vous créer?");
    define('TXT_TYPE_PRESENTATION', "Compte de présentation (2)");
    define('TXT_TYPE_ADHERENT', "Compte adhérent (cotisant à jour - 3)");
    define('TXT_TYPE_ARTISTE', "Compte artiste (4)");
    define('TXT_TYPE_ADMINISTRATEUR', "Compte administrateur (5)");

    define('TXT_PLACEHOLDER_DATE', "Date AAAA-MM-JJ");
    define('TXT_CREER_COMPTE', "Créer l'utilisateur");

    define('TXT_NOUVEL_ARTISTE', "Création d'un compte artiste");
    define('TXT_PLACEHOLDER_ARTIST_NAME', "Nom d'artiste");
    define('TXT_AUTHOR_SUBMIT_CV', "Fichier PDF du CV de l'artiste");
    define('TXT_CREER_ARTISTE', "Ajout de l'artiste");

    define('TXT_SECTION_NEWS', "Actualités");

    define('TXT_AJOUT_BOOK', "Ajout d'un objet book");
    define('TXT_AJOUT_BOOK2', "On va ajouter un book");
    define('TXT_FICHIER_COMPLET', "Le fichier du book complet : ");
    define('TXT_FICHIER_EXTRAIT', "Le fichier de l'extrait : ");
    define('TXT_BOOK_DESCRIPTION_FILE', "Le fichier de description du book : ");
    define('TXT_COLLECTION', "Collection : ");
    define('TXT_COLLECTION_OPENINGBOOK', "OpeningBook");
    define('TXT_COLLECTION_OPENINGBOOK_PHOTO', "OpeningBook Photo");
    define('TXT_PUBLISH_DATE', "Date de publication 20AA-MM-JJ : ");
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

    define('TXT_TAB_JOIN', "Join our association - Opening book");

    define('TXT_SECTION_ADHESION', 'Join');
    define('TXT_ADHESION_TEXTE',
            "En adhérant à l’association Opening :<br>
            <ul>
                <li>vous contribuez à soutenir les artistes  </li>
                <li>vous découvrez les opening books dans leur intégralité </li>
            </ul>
            Cotisation : 30 € by year<br>
            Opening is an association under law 1901 which responds to the general interest criteria according to the conditions prescribed in the articles 200 and 238 bis of the general code of taxation.Donations and subscriptions are tax deductible. The regulations are available for consultation, and please don't hesitate to contact us for further information therein.<br>
            Plese subscribe using the secured form below.
            <p>You can also send a check payable to Opening  68 rue des dominicaines 13001 Marseille by indicating your address and phone number as well as an e-mail address. You will receive by email your password to connect.</p>");

    //---------------------------------------------------------
    // about.php
    //---------------------------------------------------------

    define('TXT_TAB_ABOUT', "About our association - Opening book");

    define('TXT_SECTION_EDITO', 'about');
    define('TXT_EDITO_TEXTE', "<p>Opening book is .......... </p>
                    <p>Opening book is a new editorial and artistic object, conceived in order to give visibility to artistic photographers and visual art artists, both known and less well known.</p>
                    <p>It is a collection that can be referred to on-screen, and which deliberately places the emphasis on the works of art, thanks to High Definition photographic reproductions especially realized to this effect, along with conscientious graphic design and a navigation conceived for digital technology.</p>
                    <p>Opening book est aussi un dispositif qui offre aux artistes des outils essentiels pour promouvoir leur travail : des reproductions photographiques de qualité professionnelle, une interface de gestion en ligne des archives photographiques (espace membres) et l’inscription dans un large réseau de diffusion.</p>");

    //exemple de balise pour mettre une image : <img src='https://coloriage.info/images/ccovers/1460917190bananes-fruit.gif' width='476' height='405'>

    //---------------------------------------------------------
    // news.php
    //---------------------------------------------------------

    define('TXT_TAB_NEWS', "News - Opening book");

    define('TXT_SECTION_ACTUALITES', 'News');
    define('TXT_ACTUALITES_VIDE', "Il n'y a aucune nouvelle à afficher");

    //---------------------------------------------------------
    // contact.php
    //---------------------------------------------------------

    define('TXT_TAB_CONTACT', "Contact - Opening book");

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