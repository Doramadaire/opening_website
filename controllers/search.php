<?php   

    setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    session_start();
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    $all_books = $sql->getAllBooks();
    
    include_once('./views/search.php');

?>