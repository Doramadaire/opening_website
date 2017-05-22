<?php

    include_once('classes/useful_functions.php');
    includeOnceAllClasses();

    $sql = SQL::getInstance();
    $conn = $sql->getBoolConnexion();

    try {
        /*
        $compteDPetit = unserialize($sql->getUserByExactMail("mailCompte"));
        $new_pswd_hashed = password_hash("monMDP", PASSWORD_BCRYPT);
        // setUserPassword($user, $new_pswd)
        $sql->setUserPassword($compteDPetit, $new_pswd_hashed);*/

        echo "Ouais, opération réussie! :)";
    } catch (Exception $e) {
        echo "Une erreur est survenue :(";
        echo $e->getMessage();
    }

?>