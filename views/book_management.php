<!DOCTYPE html>
<html>
	<head>
		<?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_BOOK_MANAGEMENT; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_BOOK_MANAGEMENT; ?>">
        <title><?php echo TXT_TAB_BOOK_MANAGEMENT; ?></title>
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
		<?php 	if (!isset($_SESSION['user_logged'])) {
					echo TXT_INTERDICTION;
				} else {
					if (!$user_logged->getUserStatus() >= 4) {
						echo TXT_INTERDICTION;
					} else { ?>
					<!-- L'user connecté est un admin ou un auteur-->
				<div class="row">
					<h1><?php echo TXT_SECTION_GESTION_BOOK_ADMIN; ?></h1>
				</div>
				<div class="row thumbnail">
					<p><?php echo TXT_SHARE_BOOK_EXPLANATION; ?></p>
			  <?php if (isset($_POST['share_book_form'])) {
						if ($success == false) {
							//message d'erreur
							echo "<b>".TXT_SHARE_BOOK_LINK_GENERATION_FAIL."</b><br>";
						} else { ?>
							<p><?php echo TXT_SHARE_BOOK_LINK.$book_shared->getBookTitle();?> : 
								<a id="link_access" href="<?php echo $generated_link; ?>"><?php echo 'opening-book.com/'.$generated_link; ?></a>
							</p>
							<!-- <button onclick="copyToClipboard(<?php echo $generated_link; ?>)">Cliquez ici pour copier le lien</button> -->
							<!-- DEVDEV réparer le mail, le lien est casse à cause du "&" dans les arguments de l'url...
							<a href="mailto:?subject=Le sujet&body=<?php echo $authors_string; ?> a partagé avec vous son book paru dans la collection opening book. %0D%0A
							Vous pouvez le consulter pendant un mois grâce au lien ci-dessous. %0D%0A <?php echo $generated_link; ?> %0D%0A
							Opening book est une collection numérique de books d'artistes conçue pour offrir une visibilité supplémentaire aux artistes plasticiens et photographes en PACA. Il faut adhérer à l'association Opening pour découvrir l'intégralité de la collection et soutenir son action. Dons et cotisations sont déductibles fiscalement car l’association répond aux critères de l’intérêt général.
							opening-book.com">Partager ce book par mail</a> -->
				<?php   }
				 	} ?>
					<form method="POST">
						<label for="book_id"><?php echo $msg_choix_book; ?></label><br>
						<select name="book_id" required>
						<?php   foreach ($books_sharable as $book) { ?>
									<option value="<?php echo $book->getBookID(); ?>"><?php echo $book->getBookTitle(); ?></option>
						<?php 	} ?>
						</select><br>
				<?php   if ($user_logged->getUserStatus() >= 5) { ?>
<!-- 							<label for="duration">Durée du partage du book (en nombre de jours)</label>
							<input id="duration" name="duration" type="number" value="28" min="1" max="31"><br> -->
				<?php } ?>
						<input type="submit" name="share_book_form" class="btn btn-primary" value="<?php echo $msg_partager_book ?>">
					</form>
		<?php	}
			} ?>
				</div>
			</div>
			<div class="col-xs-1"></div>
		</div>
	</body>
</html>