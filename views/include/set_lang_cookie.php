<?php    
    if(isset($_COOKIE['lang']))  
    {   
	$lang = $_COOKIE['lang'];
	} else {   
	// si aucune langue n'est déclarée on tente de reconnaitre la langue par défaut du navigateur   
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
	}
	
	if(isset($_GET['lang']) and $_GET['lang']=='fr') {           // si la langue est 'fr' (français) on inclut le fichier fr-lang.php   
		
		$lang = 'fr';
    }    
    elseif (isset($_GET['lang']) and $_GET['lang']=='en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php   
		
		$lang = 'en';		
    }   
    elseif(!isset($_COOKIE['lang'])){                       // si aucune langue n'est déclarée on inclut le fichier fr-lang.php par défaut   
		 
		$lang = 'fr';
    } 
	
	include('./views/include/'.$lang.'-lang.php');	
    //définition de la durée du cookie (1 an)   
    $expire = 365*24*3600;    
    //enregistrement du cookie au nom de lang   
    setcookie("lang", $lang, time() + $expire, null, null, false, true);    
?>