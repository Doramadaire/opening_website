<?php

    //Fichier pour y mettre mes fonctions maisons

    /**
    * Import des fichiers de classe
    *
    * @return void
    */
    function includeOnceAllClasses()
    {
        //pour le debug sur le serveur ovh
        //ini_set('display_errors',1);
        //version php ec-m.fr : 5.6.30
        //version php wamp Pierre 5.6.25
        //version beta.opening-book.eu : 5.6.30
        //grâce à .ovhconfig à la racine du dossier correspondant
        include_once('classes/User.php');
        include_once('classes/Author.php');
        include_once('classes/Book.php');
        require("/home/openingbqo/opening_website_assets/database_configuration.php");
        include_once('classes/SQL_'.DB_TYPE.'.php');
    }

    /**
    * Paramétrage de la langue de la page
    *
    * @return void
    */
    function setLanguage()
    {  
        if (isset($_GET['lang'])) {
            //L'utilisateur a demandé une langue
            if ($_GET['lang']=='fr') {
                $lang = 'fr';
            } elseif ($_GET['lang']=='en') {
                $lang = 'en';       
            } elseif ($_GET['lang']=='de') {
                $lang = 'de';       
            } elseif ($_GET['lang']=='es') {
                $lang = 'es';       
            } elseif ($_GET['lang']=='it') {
                $lang = 'it';       
            } 
            //On enregistre la préférence de l'utilisateur dans un cookie
            //définition de la durée du cookie (1 an)   
            $expire = 365*24*3600;    
            //enregistrement du cookie au nom de lang   
            setcookie("lang", $lang, time() + $expire, null, null, false, true);  
        } else {
            //Pas de demande particulière
            if(isset($_COOKIE['lang']))  
            {   
               $lang = $_COOKIE['lang'];
            } else {   
                // si aucune langue n'est déclarée on tente de reconnaitre la langue par défaut du navigateur   
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
                switch ($lang) {
                    case 'fr':
                    case 'en':   
                    //enlever les commentaires des langues à proposer            
                    //case 'de':
                    //case 'es':
                    //case 'it':
                        //Le paramétrage est bon, on fait rien
                        break;

                    //supprimer ou mettre en commentaire lsfe cas des langues qu'on souhaite proposer
                    case 'de':
                    case 'es':
                    case 'it':
                        //Pour les internationaux par défaut on met en anglais
                        $lang = 'en';
                        break;
                    
                    default:
                        $lang = 'fr';
                        break;
                }
                //On enregistre cette valeur
                $expire = 365*24*3600;    
                //enregistrement du cookie au nom de lang   
                setcookie("lang", $lang, time() + $expire, null, null, false, true);
                return $lang;
            }
        }        
        include('./views/include/'.$lang.'-lang.php');         
    }

    function generateAccessToken() {
        //génération d'un token pour avoir un accès privilégié à un book
        $caract = "ABCDEFGHIJKLMNOPQRSTYVWXYZabcdefghijklmnopqrstuvwyxz0123456789";
        $nb_caract_possible = strlen($caract);
        $token_generated = '';
        for($i = 1; $i <= 20; $i++) {
            $token_generated = $token_generated.$caract[mt_rand(0,$nb_caract_possible-1)];
        }
        return $token_generated;
    }

?>