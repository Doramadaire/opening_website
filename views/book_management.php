<html>
	<head>
		<?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link href="css/book_management.css" rel="stylesheet">

        <script type="text/javascript">
			function copyToClipboard(text) {
				window.prompt("Copier dans le presse-papier: Ctrl+C", text);
			}
        </script>
	</head>
	<body>
		<?php include("include/header.php"); ?>
		<div class="container-fluid row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
		<?php 	if (!isset($_SESSION['user_logged'])) { ?> 
				<!-- 
				TO DO : prévoir fonction qui affiche erreur
				-->
				<?php echo TXT_INTERDICTION; ?>
			<?php } else { ?>
				<div class="row">
					<h1 class="Section">
						<?php echo TXT_SECTION_GESTION_BOOK_ADMIN; ?>
					</h1>
				</div>					
			<?php  	if ($user_logged->getUserStatus() >= 4) { ?>
					<!-- L'user connecté est un admin ou un auteur-->					
					<div class="row thumbnail">
						<h3><?php //echo TXT_ARTIST_BOOK_MANAGEMENT; ?></h3>
						<p>Sur cette page vous pouvez générer des liens d'accès privilégiés vers vos Opening book. N'importe quelle personne disposant du lien pourra alors consulter l'oeuvre correspondante.</p>
						<form action="" method="POST">
							<label for="book_id"><?php echo "Choix du book à partager"; ?></label><br>
							<select name="book_id" required>
								<?php
									foreach ($books_sharable as $book) { ?>
										<option value=<?php echo '"'.$book->getBookID().'"'; ?>><?php echo $book->getBookTitle(); ?></option>
								<?php } ?>
							</select>
							<input type="submit" name="share_book_form" class="btn btn-primary" value=<?php echo '"'."Partager le book".'"'; ?>>
						</form>
						<?php if (isset($_POST['share_book_form'])) {
							if ($success == false) {
								//message d'erreur
								echo "<b>Echec de la création du lien privilégié</b><br>";
							} else { ?>
								Le lien d'accès privilégié : 
								<a id="link_access" href="<?php echo $generated_link; ?>"><?php echo 'opening-book.com/'.$generated_link; ?></a><br>
								<!-- <button onclick="copyToClipboard(<?php echo $generated_link; ?>)">Cliquez ici pour copier le lien</button> -->
								<a href="mailto:?subject=Le sujet&body=<?php echo $authors_string; ?> a partagé avec vous son book paru dans la collection opening book. %0D%0A
								Vous pouvez le consulter pendant un mois grâce au lien ci-dessous. %0D%0A <?php echo $generated_link; ?> %0D%0A
								Opening book est une collection numérique de books d'artistes conçue pour offrir une visibilité supplémentaire aux artistes plasticiens et photographes en PACA. Il faut adhérer à l'association Opening pour découvrir l'intégralité de la collection et soutenir son action. Dons et cotisations sont déductibles fiscalement car l’association répond aux critères de l’intérêt général.
								opening-book.com">Partager ce book par mail</a>
					<?php   }
				   		} ?>
					</div>
		<?php  	} 
		} ?>
		</div>
			<div class="col-xs-1"></div>
		</div>
		<?php include("include/footer.php"); ?> 
	</body>
</html>