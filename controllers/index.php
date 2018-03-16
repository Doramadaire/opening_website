<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();
    //$sql->createTables();

    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    //formulaire de déconnexion
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }

    include_once('./views/index.php');

?>
