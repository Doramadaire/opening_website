<?php

    $lang = setLanguage();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    session_start();    
    $logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
    $user_logged = (isset($_SESSION['user_logged'])) ? $_SESSION['user_logged'] : false;

    if (isset($_POST['dl_call_application'])) {
        $file = 'assets/pdf/candidature_2018.pdf';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

	include_once('./views/about.php');

?>