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
					<div class="row thumbnail">
						<p>Ajout d'un objet book</p>
						<!-- TO DO : la patie du controlleur -->
						<form action="book_management.php" method="post" enctype="multipart/form-data">
							<label for="new_book_form">On va ajouter un book</label><br>
							Le fichier du book : <input type="file" name="book_file" required/>
							Le fichier de l'extrait : <input type="file" name="book_sample_file" required/>
							<!-- Autre façon de faire
							<div class="fileUpload btn btn-primary">
								<span>Upload</span>		
								<input type="file" class="book_file" />						
							</div				-->							
							<input type="text" name="title" placeholder="titre" required><br>
							Collection : <select name="collection" required>
								<option value=2>OpeningBook</option>
								<option value=3>OpeningBook Photo</option>
							</select><br>
							Année : <input type="number" name="year" value="2017" min="2014" required><br>
							<input type="submit" class="btn btn-primary" name="new_book_form" value="Créer le book">	
						</form>	 
					</div>			
	<?php  	}	 
		} ?> 		
	
		</div>
	<?php include("include/footer.php"); ?> 
	
	</body>
</html>