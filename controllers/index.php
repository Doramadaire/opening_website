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

    // on récupère les images du carousel
    $dir_name = './assets/diapo/';
    $dir_content = scandir($dir_name);
    // on garde que les images
    $dir_imgs = array();
    foreach ($dir_content as $file) {
        if (endsWith($file, ".jpg")) {
            array_push($dir_imgs, $file);
        }
    }
    // on let met dans un ordre aléatoire
    shuffle($dir_imgs);
    // les 2 premières images sont toujours les même
    // $carousel_imgs = array("assets/img/000_cover.jpg",
    //                        "assets/img/001_opening_book.jpg");
    // en fait la cover on la met à la main dans la vue
    $carousel_imgs = array("assets/img/001_opening_book.jpg");
    // on met les images dans $carousel_imgs
    $count = 0; // un compteur pour intercaller 001_opening_book.jpg toutes les 3 images
    foreach ($dir_imgs as $img) {
        if ($count === 3) {
            array_push($carousel_imgs, "assets/img/001_opening_book.jpg");
            $count = 0;
        } else {
            array_push($carousel_imgs, $dir_name.$img);
            $count += 1;
        }
    }

    include_once('./views/index.php');

?>
