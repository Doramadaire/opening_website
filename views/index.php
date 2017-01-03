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
		<?php if ($logged) { ?>
			Bien joué beau gosse! Alors comme ça je peux te contacter en t'envoyant un mail à <?php echo $user_mail ?> ?			
		<?php } else { ?>
			Bouh, t'es pas connecté! Allez spa grave on va arranger ça
			<form action="" method="POST">
				<input type="text" name="mail" placeholder="e-mail"> <br>
				<input type="password" name="password" placeholder="mot de passe">  <br>
				<input type="submit" name="submit" value="Se connecter">		
			</form>
			<br>
			<form action="" method="POST">
				<input type="submit" name="grosmit" value="CLICK">		
			</form>
		<?php } 
		if (isset($_POST['mail'])) {
			echo $_POST['mail'];
		} else {
			echo "disparu";
		}


		?>
	</body>

</html>