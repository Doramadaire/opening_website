<html>
	<head>
		<?php include("include/html_header.php"); ?>
        <title>Opening</title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link href="css/book_management.css" rel="stylesheet">
	</head>
	<body>

	<?php 
		include("include/header.php");  ?>

		<div class="container">

	<?php 	if (!isset($_SESSION['user_logged'])) { ?> 
			<!-- 
			TO DO : prévoir fonction qui affiche erreur
			-->
			<?php echo TXT_INTERDICTION; ?>
	<?php } else {
				if ($user_logged->getUserStatus()===4) { ?>
					<!-- L'user connecté est un auteur
					TO DO : pouvoir corriger des trucs sur ses oeuvres
					pouvoir en ajouter
					autres fonctionnalités
					--> <div class="row">
					<h1 class="Section"> <?php echo TXT_GESTION_BOOK_AUTEUR; ?> </h1>
					
					</div>
	<?php   	} else if ($user_logged->getUserStatus()===5) { ?>
					<!-- L'user connecté est un admin -->
					<div class="row">
					<h1 class="Section">
						<?php echo TXT_GESTION_BOOK_ADMIN; ?>
					</h1>
					
					</div>
					<!-- TO DO : rajouter fonctionnalités...
					rajouter en base un livre -->
					
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
	<?php include("include/footer.php"); ?> 
	
	</body>
</html>