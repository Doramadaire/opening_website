<?php if (isset($infraction)) {echo $infraction;} 
else {?>


<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/user_settings.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/user_settings.js"></script>
	</head>
	<body>

	<?php include("header.php"); ?> 
	<div class="Section">
		Gestion de votre compte
	</div>
	<br/> <br/> 
	<?php  if (isset($error)) { echo $error;} ?> 	

	<!-- Si on modifie le mail, il faut garder tracer du mail précédent, un nouveau champ en base avec la liste des mails? ou seulement celui avec lequel le compte a été créé?-->
	<div class="container"> 
		<div class="row">
			<?php 
				if (isset($msg_new_mail)) {
					echo $msg_new_mail;
					echo "<br>Votre mail est désormais : ".$user_logged->getUserMail()."<br>";
				} ?>
			Votre adresse mail actuelle est <?php echo $user_logged->getUserMail() ?><br>
			<input type="button" value="Modifier votre adresse e-mail" onclick="hideThis('form1')" />	

			<!-- form1 et form2 sont des très mauvais id, faut trouver de meilleurs noms, plus clairs -->
			<form  id="form1" class="user_change_settings_form" action="" method="POST">		
				<label for="new_mail">Votre nouvelle adresse</label>
				<input type="text" name="new_mail">  	
				<input type="submit" name="set_new_mail_form" value="Confirmer">	
			</form>	 
		</div>			

		<br>
		<div class="row">
			<?php  if (isset($msg_new_pswd)) { echo $msg_new_pswd."<br>";} ?> 
			<input type="button" value="Modifier votre mot de passe" onclick="hideThis('form2')" />

			<form  id="form2" class="user_change_settings_form" action="" method="POST">
				<label for="previous_password">Mot de passe actuel</label>
				<input type="password" name="previous_password" required><br>
				<label for="new_password">Nouveau mot de passe</label>
				<input type="password" name="new_password" required><br>
				<label for="new_password_bis">Confirmer le nouveau mot de passe</label>
				<input type="password" name="new_password_bis" required><br>
				<input type="submit" name="set_new_password_form" value="Confirmer">		
			</form>
		</div>

		<br>
		Cotisation effective jusqu'au : <?php echo $_SESSION['user_logged']->getUserSubscriptionDate() ?>

	</div>
	
	<?php include("footer.php"); ?> 
	
	</body>

</html>

<?php } ?>