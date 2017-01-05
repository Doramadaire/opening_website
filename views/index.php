<html>
	<head>
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/index.css" type="text/css">
		
	</head>
	<body>
		 <div class="top">
		Voici le site opening book
		 </div>
		<br/> 
		<div class="action">
		<?php if ($user_logged) { ?>
			Bonjour <?php echo $user_logged->getUserMail();; ?>
			Vous êtes connecté en tant  
		<?php 	switch($_SESSION['user_logged']->getUserStatus()) 
					{
							     case 2: echo "que visiteur"; ?>
					Vous pouvez : <br/> 
						<ul> <li><a href="images.html">Parcourir les oeuvres (extraits)</a></li> 
							 <li><a href="images.html">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 3: echo "que cotisant";  ?>
					Vous pouvez : <br/> 
						<ul> <li><a href="images.html">Parcourir les oeuvres</a></li> 
							 <li><a href="images.html">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 4:	echo "qu'auteur";	?>
					Vous pouvez : <br/> 
					
						<ul> <li><a href="images.html">Parcourir les oeuvres</a></li> 
							 <li><a href="images.html">Gérer votre compte</a></li> 
							 <li><a href="images.html">Gérer vos oeuvres</a></li>  </ul>
							 
					<?php break; case 5:	echo "qu'administrateur"; ?>
					Vous pouvez : <br/> 
						<ul> <li><a href="images.html">Parcourir les oeuvres</a></li> 
							 <li><a href="images.html">Gérer les membres></li> 
							 <li><a href="images.html">Gérer les oeuvres</a></li>  
							 <li><a href="images.html">?</a></li> </ul>
							 
					<?php break;} ?>
			
			<form action="" method="POST">
				<input type="submit" name="loggout_form" value="Se déconnecter">
			</form>
		<?php } else { ?>
			Vous n'êtes pas connecté. 
			<form action="" method="POST">
				<input type="text" name="mail" placeholder="e-mail"> <br>
				<input type="password" name="password" placeholder="mot de passe">  <br>
				<input type="submit" name="logging_form" value="Se connecter">		
			</form>
		<?php } 
			if (isset($error)) {
				echo $error;
			} ?>
			</div> <!-- action-->
	</body>

</html>