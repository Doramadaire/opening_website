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

	<div class="container"> 
		<div class="row">
			<?php 
				if (isset($msg_new_mail)) {
					echo $msg_new_mail;
					echo "Votre mail est désormais : ".$user_logged->getUserMail();
				} ?>
			Votre adresse mail actuelle est <?php echo $user_logged->getUserMail() ?>
			<input type="button" value="Modifier votre adresse e-mail" onclick="hideThis('form1')" />	

			<form  id="form1" action="" method="POST">		
				Votre nouvelle adresse
				<input type="text" name="new_mail">  	
				<input type="submit" name="set_new_mail_form" value="Confirmer">	
			</form>	 
		</div>			

		<br>

		<input type="button" value="Modifier votre mot de passe" onclick="hideThis('form2')" />

		<form  id="form2" class="set_new_pswd_form" action="" method="POST">
			Votre ancien mot de passe    
			<input type="text" name="mail" placeholder=""> <br>
			Votre nouveau mot de passe    
			<input type="password" name="password" placeholder="">  <br>
			Confirmer le mot de passe    
			<input type="password" name="password_bis" placeholder="">  <br>
			<input type="submit" name="mdp" value="Confirmer">		
		</form>

		<br>
		Cotisation effectée le : <?php echo $_SESSION['user_logged']->getUserSubscriptionDate() ?>

	</div>
	
	<?php include("footer.php"); ?> 
	
	</body>

</html>

<?php } ?>