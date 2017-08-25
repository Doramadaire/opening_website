<?php

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
        include_once('classes/useful_functions.php');
        include_once('classes/User.php');
        include_once('classes/Author.php');
        include_once('classes/Book.php');
        //require("/home/openingbqo/opening_website_assets/database_configuration.php");
        require("/home/openingbqo/opening_website_assets/beta_database_configuration.php");
        
        if (defined('DB_TYPE')) {
            include_once('classes/SQL_'.DB_TYPE.'.php');
        } else {
            die("Error DB_TYPE not defined");
        }
    }

?>