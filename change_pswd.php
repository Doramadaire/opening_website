<?php

    include_once('classes/useful_functions.php');
    includeOnceAllClasses();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    try {
        
        $compteDpetit = unserialize($sql->getUserByExactMail("dpetit"));
        $compteYthir = unserialize($sql->getUserByExactMail("ythiriet"));
        $compteSdam = unserialize($sql->getUserByExactMail("sdamoy"));
        $compteFbuad = unserialize($sql->getUserByExactMail("fbuadas"));
        $compteMdere = unserialize($sql->getUserByExactMail("mderegibus"));
        $compteOrebuf = unserialize($sql->getUserByExactMail("orebufa"));
        $compteAmer = unserialize($sql->getUserByExactMail("amerian"));
        $compteVhorw = unserialize($sql->getUserByExactMail("vhorwitz"));
        $compteEsarr = unserialize($sql->getUserByExactMail("esarrouy"));

        $new_pswd_hashed1 = password_hash("opening36Dpetit", PASSWORD_BCRYPT);
        $new_pswd_hashed2 = password_hash("opening73Ythiriet", PASSWORD_BCRYPT);
        $new_pswd_hashed3 = password_hash("opening17Sdamoy", PASSWORD_BCRYPT);
        $new_pswd_hashed4 = password_hash("opening70Fbuadas", PASSWORD_BCRYPT);
        $new_pswd_hashed5 = password_hash("opening82Mderegibus", PASSWORD_BCRYPT);
        $new_pswd_hashed6 = password_hash("opening81Orebufa", PASSWORD_BCRYPT);
        $new_pswd_hashed7 = password_hash("opening68Amerian", PASSWORD_BCRYPT);
        $new_pswd_hashed8 = password_hash("opening19Vhorwitz", PASSWORD_BCRYPT);
        $new_pswd_hashed9 = password_hash("opening04Esarrouy", PASSWORD_BCRYPT);
        // setUserPassword($user, $new_pswd)
        $sql->setUserPassword($compteDpetit, $new_pswd_hashed1);
        $sql->setUserPassword($compteYthir, $new_pswd_hashed2);
        $sql->setUserPassword($compteSdam, $new_pswd_hashed3);
        $sql->setUserPassword($compteFbuad, $new_pswd_hashed4);
        $sql->setUserPassword($compteMdere, $new_pswd_hashed5);
        $sql->setUserPassword($compteOrebuf, $new_pswd_hashed6);
        $sql->setUserPassword($compteAmer, $new_pswd_hashed7);
        $sql->setUserPassword($compteVhorw, $new_pswd_hashed8);
        $sql->setUserPassword($compteEsarr, $new_pswd_hashed9);

        echo "Ouais, opération réussie! :)";
    } catch (Exception $e) {
        echo "Une erreur est survenue :(";
        echo $e->getMessage();
    }

?>