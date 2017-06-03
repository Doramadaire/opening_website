<?php

    // $destinataire = "guilhem-claverie@orange.fr";
    $sujet = "Votre compte Opening book" ;
    $headers ='From: support@opening-book.com'."\n";
    $headers = $headers."Content-Type: text/html; charset=UTF-8\n";
    $headers .='Content-Transfer-Encoding: 8bit';

    $message = '<html><body style="font-size:20px;">
    <p>Vous êtes désormais inscrit sur le site d\'Opening en tant que cotisant à l\'association. Votre adhésion expirera le $new_user_sub_date.<br>

    <p>Voici votre mot de passe : $new_password<br>
    Je vous conseille de le modifier dès votre première visite sur notre site. Pour cela, identifiez-vous sur <a href="https://opening-book.com/index.php">opening-book.com</a> et allez sur la page "Gestion de votre compte".<br>
    <br>
    Nous vous souhaitons une agréable consultation de notre collection.</p>
    ---------------<br>
    Ceci est un mail automatique, merci de ne pas y répondre.<br>
    Si vous rencontrer des difficultés lors de l\'utilisation de notre site, vous pouvez contactez <a href="mailto:support@opening-book.com">support@opening-book.com</a><br>
    <img style="float: right;"" src="https://opening-book.com/assets/logo.png" width="80px" height="47px"></body></html>';

    //mail($destinataire, $sujet, $message, $headers) ; // Envoi du mail

    $object_mail_admin = "Nouveau compte opening" ;
    $headers_mail_admin = "From: leserveuropeningchezovh\n";
    $headers_mail_admin .= "Content-Type: text/html; charset=UTF-8\n";
    $headers_mail_admin .= 'Content-Transfer-Encoding: 8bit';

    $mail_admin_content = '<html><body style="font-size:20px;">
    Un nouveau compte vient d\'être créé sur le site opening-book.com<br>
    mail=$new_user_mail<br>
    prenom=$new_user_firstname<br>
    nom=$new_user_name<br>
    status=$new_user_type<br>
    date de fin d\'adhesion=$new_user_sub_date<br>
    <br>
    Signé : un script qui veut t\'aider<br>
    <img src="https://opening-book.com/assets/wink.jpg" width="544px" height="255px"></body></html>
    </body></html>';
    //mail("guilhem-claverie@orange.fr", $object_mail_admin, $mail_admin_content, $headers_mail_admin);

    echo "mail send<br>";
    echo time();

?>