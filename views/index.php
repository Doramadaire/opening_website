<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/index.css" type="text/css">
		
	</head>
	<body>
		<?php include("header.php"); ?> 

		<div class="action">
		<?php if ($user_logged) { ?>
			Bonjour <?php echo $user_logged->getUserMail(); ?>
			<br>
			Vous êtes connecté en tant  
		<?php 	switch($_SESSION['user_logged']->getUserStatus()) 
					{
							     case 2: echo "que non cotisant"; ?>
					<br> Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir les oeuvres (seulement des extraits)</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 3: echo "que cotisant";  ?>
					<br>Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir les oeuvres</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 4:	echo "qu'auteur";	?>
					<br>Vous pouvez : <br> 
					
						<ul> <li><a href="book_viewer.php">Parcourir les oeuvres</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> 
							 <li><a href="book_management.php">Gérer vos oeuvres</a></li>  </ul>
							 
					<?php break; case 5:	echo "qu'administrateur"; ?>
					<br>Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir les oeuvres</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li>							 
							 <li><a href="book_management.php">Gérer les oeuvres</a></li>
							 <li><a href="user_management.php">Gérer les membres</li> </ul>
							 
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
			}	 ?>
			</div> <!-- action-->
	</body>

</html>