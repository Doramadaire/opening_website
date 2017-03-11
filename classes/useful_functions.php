<?php

    //Fichier pour y mettre mes fonctions maisons

    /**
    * Import des fichiers de classe
    *
    * @return void
    */
    function includeOnceAllClasses()
    {
        include_once('classes/User.php');
        include_once('classes/Author.php');
        include_once('classes/Book.php');
        include_once('classes/SQL.php');
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
                echo "MON NAV A TROUVE CA lang=$lang";
                switch ($lang) {
                    case 'fr':
                    case 'en':
                        //Le paramétrage est bon, on fait rien
                        break;

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
            }
        }        
        include('./views/include/'.$lang.'-lang.php');         
    }

?>