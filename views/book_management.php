<html>
	<head>
		<?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
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
					<h1 class="Section"> <?php echo TXT_SECTION_GESTION_BOOK_AUTEUR; ?> </h1>
					
					</div>
	<?php   	} else if ($user_logged->getUserStatus()===5) { ?>
					<!-- L'user connecté est un admin -->
					<div class="row">
						<h1 class="Section">
							<?php echo TXT_SECTION_GESTION_BOOK_ADMIN; ?>
						</h1>					
					</div>
					<div class="row thumbnail">
						<p><?php echo TXT_AJOUT_BOOK; ?></p>
						<p><?php if (isset($dl_fail_error)) echo TXT_ERR_UPLOAD_FAIL; ?></p>
						<p><?php if (isset($incorrect_file_extension_error)) echo TXT_ERR_INCORRECT_FILE_EXTENSION; ?></p>
						<form action="book_management.php" method="post" enctype="multipart/form-data">
							<label for="new_book_form"><?php echo TXT_AJOUT_BOOK2; ?></label><br>
							<?php echo TXT_FICHIER_COMPLET; ?><input type="file" name="full_book_file" required/>
							<?php echo TXT_FICHIER_EXTRAIT; ?><input type="file" name="extract_book_file" required/>
							<!-- Autre façon de faire
							<div class="fileUpload btn btn-primary">
								<span>Upload</span>		
								<input type="file" class="book_file" />						
							</div				-->							
							<input type="text" name="title" placeholder=<?php echo '"'.TXT_PLACEHOLDER_TITRE.'"'; ?> required><br>
							<?php echo TXT_COLLECTION; ?> <select name="collection" required>
								<option value="opening book"><?php echo TXT_COLLECTION_OPENINGBOOK; ?></option>
								<option value="opening book photo"><?php echo TXT_COLLECTION_OPENINGBOOK_PHOTO; ?></option>
							</select><br>
							<?php echo TXT_ANNEE; ?><input type="number" name="year" value="<?php echo date("Y"); ?>" min="2015" required><br>
							<input type="submit" class="btn btn-primary" name="new_book_form" value=<?php echo '"'.TXT_BOUTON_CREER_BOOK.'"'; ?>>	
						</form>	 
					</div>
					<div class="row thumbnail">
						<h3><?php echo TXT_ARTIST_BOOK_MANAGEMENT; ?></h3>
						<a href="mailto:?subject=Le sujet&body=var_artiste a partagé avec vous son book paru dans la collection opening book. %0D%0A
						Vous pouvez le consulter pendant un mois grâce au lien ci-dessous. %0D%0A var_lien  %0D%0A
						Opening book est une collection numérique de books d'artistes conçue pour offrir une visibilité supplémentaire aux artistes plasticiens et photographes en PACA. Il faut adhérer à l'association Opening pour découvrir l'intégralité de la collection et soutenir son action. Dons et cotisations sont déductibles fiscalement car l’association répond aux critères de l’intérêt général.
						opening-book.com">Partager un book</a>		
					</div>
	<?php  	}	 
		} ?> 		
	
		</div>
	<?php include("include/footer.php"); ?> 
	
	</body>
</html>