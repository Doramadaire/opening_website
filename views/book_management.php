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
						<h3><?php echo TXT_ARTIST_BOOK_MANAGEMENT; ?></h3>
						<a href="mailto:?subject=Le sujet&body=var_artiste a partagé avec vous son book paru dans la collection opening book. %0D%0A
						Vous pouvez le consulter pendant un mois grâce au lien ci-dessous. %0D%0A var_lien  %0D%0A
						Opening book est une collection numérique de books d'artistes conçue pour offrir une visibilité supplémentaire aux artistes plasticiens et photographes en PACA. Il faut adhérer à l'association Opening pour découvrir l'intégralité de la collection et soutenir son action. Dons et cotisations sont déductibles fiscalement car l’association répond aux critères de l’intérêt général.
						opening-book.com">Partager un book</a>		
					</div>
	<?php  	
				$sql = SQL::getInstance();
  				$conn = $sql->getBoolConnexion();

				$book = unserialize($sql->getBookByID(1));
				$book->addAccessToken("TestToken");
				echo "ajout token";
				foreach ($book->getAcessTokens() as $tokenc) {
					echo "tokenc=".implode($tokenc)."<br>";
				}
				$book->addAccessToken("TestToken2");
				echo "ajout token";
				foreach ($book->getAcessTokens() as $tokenc) {
					echo "tokenc=".implode($tokenc)."<br>";
				}
				$book->cleanOldTokens();
				echo "après clean";
				foreach ($book->getAcessTokens() as $tokenc) {
					echo "tokenc=".implode($tokenc)."<br>";
				}
			}	 
		} ?> 		
	
		</div>
	<?php include("include/footer.php"); ?> 
	
	</body>
</html>