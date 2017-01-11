<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/book_management.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>

	<?php 
		include("header.php"); 

		if (!isset($_SESSION['user_logged'])) { ?> 
			<!-- 
			TO DO : prévoir fonction qui affiche erreur
			-->
			Vous n'avez pas le droit d'accéder à cette page		
	<?php } else {
				if ($user_logged->getUserStatus()===4) { ?>
					<!-- L'user connecté est un auteur
					TO DO : pouvoir corriger des trucs sur ses oeuvres
					pouvoir en ajouter
					autres fonctionnalités
					-->
					<div class="Section">
						Page de gestion de vos oeuvres
					</div>
					Bienvenue mon bel auteur
	<?php   	} else if ($user_logged->getUserStatus()===5) { ?>
					<!-- L'user connecté est un admin -->
					<div class="Section">
						Page de gestion des oeuvres
					</div>
					<!-- TO DO : rajouter fonctionnalités... -->
					Bienvenue cher admin!					
	<?php  	}	 
		} ?> 		
	
	<?php include("footer.php"); ?> 
	
	</body>
</html>