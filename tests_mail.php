<?php

    // $destinataire = "guilhem-claverie@orange.fr";
    $sujet = "Votre compte Opening book" ;
    $headers ='From: contact@opening-book.com'."\n";
    $headers = $headers."Content-Type: text/html; charset=UTF-8\n";
    $headers .='Content-Transfer-Encoding: 8bit';

    $message = '<html><body style="font-size:20px;">
    <p>Vous êtes désormais inscrit sur le site d\'Opening, en tant que cotisant à l\'association. Votre adhésion expirera le $new_user_sub_date.<br>

    <p>Voici votre mot de passe : $new_password<br>
    Je vous conseille de le modifier dès votre première visite sur notre site. Pour cela, identifiez-vous sur <a href="https://opening-book.com/index.php">opening-book.com</a> et allez sur la page "Gestion de votre compte".<br>
    <br>
    Nous vous souhaitons une agréable consultation de notre collection.</p>
    ---------------<br>
    Ceci est un mail automatique, merci de ne pas y répondre.<br>
    <img style="float: right;"" src="https://opening-book.com/assets/logo.png" width="80px" height="47px"></body></html>';

    // mail($destinataire, $sujet, $message) ; // Envoi du mail
    mail($destinataire, $sujet, $message, $headers) ; // Envoi du mail
    echo "mail send<br>";
    echo time();

?>