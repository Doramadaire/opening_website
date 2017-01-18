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
		include("header.php");  ?>

		<div class="container">

	<?php 	if (!isset($_SESSION['user_logged'])) { ?> 
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
					Bienvenue cher artiste
	<?php   	} else if ($user_logged->getUserStatus()===5) { ?>
					<!-- L'user connecté est un admin -->
					<div class="Section">
						Page de gestion des oeuvres
					</div>
					<!-- TO DO : rajouter fonctionnalités...
					rajouter en base un livre -->
					Bienvenue cher admin!
					<br>
					<div class="row">
						<p>Paramétrage d'un objet book</p>
						<!-- TO DO : la patie du controlleur -->
						<form action="" method="POST" enctype="multipart/form-data">
							<input type="file" name="book_file">
							<input type="submit" name="new_book_form" value="Créer le book">	
						</form>	 
					</div>			
	<?php  	}	 
		} ?> 		
	
		</div>
	<?php include("footer.php"); ?> 
	
	</body>
</html>