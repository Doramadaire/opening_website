<?php

    //---------------------------------------------------------
    // généraux # test DL
    //---------------------------------------------------------

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
    define('TXT_NAVBAR_ADHERER', 'donate');
    define('TXT_NAVBAR_LANGUE', 'language');

    define('TXT_MENU', 'you can');
    define('TXT_MENU_COMPTE', 'Manage your account');
    define('TXT_MENU_OEUVRES', 'Share your books');
    define('TXT_MENU_OEUVRES_ADMIN', 'Share books');
    define('TXT_MENU_ADMIN_PAGE', "Go to the administration page");
    define('TXT_MENU_RECHERCHE', 'Find book');
    define('TXT_MENU_RECHERCHE_EXTRAITS', 'Find extract');

    define('TXT_NAVBAR_DISCONNECT', "Log out");

    define('TXT_FOOTER_BACK_HOME', "Back to home page");

    //---------------------------------------------------------
    // index.php
    //---------------------------------------------------------

    define('TXT_TAB_INDEX', "Homepage - Opening book association");

    define('TXT_BONJOUR', 'Hello');

    define('TXT_H3_SECTION_CONNEXION', 'Have an account ?');
    define('TXT_BOUTON_SE_CONNECTER', "log in");
    define('TXT_BOUTON_SE_DECONNECTER', "log out");

    define('TXT_PLACEHOLDER_MAIL', "e-mail");
    define('TXT_PLACEHOLDER_MDP', "password");

    define('TXT_ATTENTION_MDP_OUBLIE', "Warning! Will send a new password to your mailbox");
    define('TXT_BOUTON_RESET_MDP_OUBLIE', "Send me a new password");
    define('TXT_MDP_OUBLIE', "Forgot password?");
    define('TXT_RESET_PSWD_SUCCESS', 'A mail with your new password has been sent');

    define('TXT_H3_SECTION_RECHERCHE', 'Discover opening book');
    define('TXT_P_RECHERCHE', "Digital collections where artists portfolios and books of art meet");
    //exemple balise liens : <a href="about.php"><b>En savoir plus</b></a>
    define('TXT_BOUTON_VISITOR_COLLECTION', "Collections");
    define('TXT_BOUTON_LOGGED_COLLECTION', "See our collection");

    define('TXT_H3_SECTION_ADHERER', "Opening association");
    define('TXT_P_ADHERER', "Donate");
    define('TXT_BOUTON_ADHERER', "Join");

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

    define('TXT_TAB_BOOK_MANAGEMENT', "Share your Opening books - Opening book");

    define('TXT_SECTION_GESTION_BOOK_AUTEUR', 'Management page of your book');
    define('TXT_SECTION_GESTION_BOOK_ADMIN', 'Page de gestion des oeuvres'); # texte vu par admin uniquement

    define('TXT_SHARE_BOOK_EXPLANATION', "On this page you can generate access links to you favourite  Opening portfolio. Any person having the link can then consult the corresponding book.");
    define('TXT_SHARE_BOOK_LINK_GENERATION_FAIL', "Privileged link creation failure");
    define('TXT_SHARE_BOOK_LINK', "Here is the favored access link to reach in l'");

    define('TXT_ARTIST_BOOK_MANAGEMENT', "your books");

    //---------------------------------------------------------
    // book_viewer.php
    //---------------------------------------------------------

    define('TXT_TAB_BOOK_VIEWER', "Opening book - Opening book");

    define('TXT_VISITOR', "Attention, as visitor you only have access  to portfolio extracts.");
    define('TXT_USER_SUBSCRIPTION_EXPIRED', "Watch out, your contribution is not up to date. You have access only to extracts of portfolios.");
    define('TXT_BOOK_VIEWER_EXPLANATION', 'Click the cover to start the reading');
    define('TXT_ARTIST_CV', 'Read CV');

    define('TXT_BACK_TO_COLLECTION_BOOKS', 'collection ');
    define('TXT_BACK_TO_ARTIST_BOOKS', "");
    define('TXT_BACK_TO_CATALOGUE', "All collections");

    //---------------------------------------------------------
    // user_settings.php
    //---------------------------------------------------------

    define('TXT_TAB_USER_SETTINGS', "Manage your account - Opening book");

    define('TXT_GESTION_COMPTE_USER', 'Your account');
    define('TXT_NOUVEAU_MAIL', 'Your new mail adress');
    define('TXT_MAIL_ACTUEL', 'Your current mail adress : ');
    define('TXT_MAIL_CONFIRM', 'Your mail is now : ');
    define('TXT_MDP_ACTUEL', 'Current password');
    define('TXT_NOUVEAU_MPD', 'New password');
    define('TXT_CONFIRME_MDP', 'Confirm your new password');
    define('TXT_COTISATION', "Your membership lasts until : ");
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

    define('TXT_PLACEHOLDER_FIRSTNAME', "firstname");
    define('TXT_PLACEHOLDER_NAME', "Name");

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

    define('TXT_TAB_JOIN', "Opening book");

    define('TXT_SECTION_ADHESION', 'Donate');
    define('TXT_ADHESION_TEXTE', "Follow the link...<br>
            <ul>
                <li>You are helping to support the artists</li>
            </ul>
            <br>
            Opening is an association under law 1901 which responds to the general interest criteria according to the conditions prescribed in the articles 200 and 238 bis of the general code of taxation. Donations are tax deductible.<br>
            <p>You can also send a check payable to Opening  68 rue des dominicaines 13001 Marseille by indicating your address and phone number as well as an e-mail address.</p>");

    //---------------------------------------------------------
    // login.php
    //---------------------------------------------------------

    define('TXT_TAB_LOGIN', "Se connecter - Opening book");

    define('TXT_SECTION_LOGIN', "Espace membre");

    define('TXT_TITLE_LOGIN', "Se connecter");
    define('TXT_SHOW_FORGOTTEN_PASSWORD', "Mot de passe oublié ?");
    define('TXT_FORGOTTEN_PASSWORD_WARNING', "Attention! Cette action génére un nouveau mot de passe qui sera envoyé à l'adresse mail de votre compte");
    define('TXT_CONFIRM_FORGOTTEN_PASSWORD', "Générer un nouveau mot de passe");

    //---------------------------------------------------------
    // about.php
    //---------------------------------------------------------

    define('TXT_TAB_ABOUT', "Opening book");

    define('TXT_SECTION_EDITO', 'Opening book');
    define('TXT_EDITO_TEXTE', "<p>Opening book about.......... </p>
                    <p><b>A digital collection </b>of artists books, conceived in order to offer a visibiity platform for visual arts artists, opening book was born from the vision of a passionate art lover and a professional artist in 2015. Followed in 2016 by opening book photo, it allows both amateur and professional art lovers to discover and explore both emerging and established artists.</p>

                    <p>In each book, twelve works of art can be explored in a  refined page layout constructed around the works and their details, with fluid navigation between the pages and a powerful zoom for in depth examination. Opening thereby offers artists essential tools for building and consolidating their reputation : professional quality photographic reproductions and membership of a wide diffusion network.</p>

                    <p><b>Why donate? </b></p>
                    <p>To help us and supporting the artists</p>

                    <p> You will be able to consult a digital art library and you wil be participating in the running of the association, along side our indispensible public partners (at this time, the regional Provence Alps Côte d'Azure council and the departement council Bouches-du-Rhône). Donations are tax-deductible, as our association complies with the General Interest criteria.</p>

                    <p><b>Call for applications</b>
                    Artists wishing to integrate the collection are invited to present a coherent selection of twelve works, accompanied by a short text explaining the pertinence of their selection. The definitive selection will be made in collaboration with Opening. Propositions should be addressed to “contact@opening-book.com” with, in the object section of the email, the precision “candidature opening book”. </p>

                    <p>Requested elements : twelve images + explanatory note + C.V ( potentially links to internet sites or blogs or documentation about projects already realised.) Formats pdf jpg doc odt (word or open office) for more information contact us.</p>

                    <p>Selection criteria : the quality and seriousness of the artistic work / justification of a professional career history and a certain number of works of art/ the pertinence of the proposed works of art.</p>
                    <p><b>Terms and conditions.</b>
                    Selected artists must become members of the association Opening at the artists price of 50 Euros. If necessary Opening will take charge of the digitalisation (photography or scanning) of the works chosen for publication.</p>
                    <form method='POST'>
                        <input type='submit' class='btn btn-primary' name='dl_call_application' value=\"Download the call for applications\">
                    </form>
                    <br>
                    <p><b>Who we are?</b></p>
                    <p>Caroline CIRENDINI</p>
                    <p>A qualified art historian, a cultural mediater for the past 14 years, she has co-ordinated numerous publishing projects and art commissions with the Bureau des compétences et désirs (Action Nouveaux commanditaires de la Fondation de France), and before that with centre d'art contemporain du Crestet (co-édition avec Actes Sud).</p>
                    <p>Isabelle SCHNEIDER</p>
                    <p>An artist, she workes concurrently as a painter and videographer. She is part of the Experimental video festival,  Images Contre Nature in Marseilles. She regulary collaborates with experimental theatre companies.(Germany, Greece, France.) </p>
                    <p><img src='assets/media/img/portrait_opening.jpg' width='700px'></p>
                    <p>Opening recieves funding from the Regional Provence-Alpes-Côte d'Azur and the Bouches-du-Rhône councils.</p>");

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