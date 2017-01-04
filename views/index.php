<html>
	<head>
		<title>
			Opening 
		</title>
	</head>
	<body>
		<br>
		Voici le site opening book
		<br> 
		<?php if ($user_logged != false) { ?>
			Bien joué beau gosse! Alors comme ça je peux te contacter en t'envoyant un mail à <?php echo $user_logged->getUserMail();; ?> ?
			<form action="" method="POST">
				<input type="submit" name="loggout_form" value="Se déconnecter">
			</form>
		<?php } else { ?>
			Bouh, t'es pas connecté! Allez spa grave on va arranger ça
			<form action="" method="POST">
				<input type="text" name="mail" placeholder="e-mail"> <br>
				<input type="password" name="password" placeholder="mot de passe">  <br>
				<input type="submit" name="logging_form" value="Se connecter">		
			</form>
		<?php } 
			if (isset($error)) {
				echo $error;
			} ?>
	</body>

</html>