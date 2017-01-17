<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>OPENING</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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
		<?php 		if (isset($error)) {
						echo $error;
					}	 ?>
			<br>
			<a href="book_viewer.php">Parcourir les oeuvres (seulement des extraits)</a>
		<?php } ?>
		</div> <!-- action-->
		
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	</body>
	
	
	
    
</html>