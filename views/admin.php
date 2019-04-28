<!DOCTYPE html>
<html>
	<head>
		<?php include("include/html_header.php"); ?>
		<title><?php echo TXT_TAB_ADMIN; ?></title>
		<!-- Import des fichiers spécifiques à cette page -->
		<link rel="stylesheet" href="css/admin.css" type="text/css">
		<script src="js/admin.js"></script>
		<script type="text/javascript">
<?php 	if (isset($json_retrieved_users)) { ?>
			var json_retrieved_users = '<?php echo $json_retrieved_users; ?>';
<?php	} elseif (isset($json_retrieved_artists)) { ?>
			var json_retrieved_artists = '<?php echo $json_retrieved_artists; ?>';
<?php	} elseif (isset($json_retrieved_books)) { ?>
			var json_retrieved_books = '<?php echo $json_retrieved_books; ?>';
<?php	} ?>
		</script>
<?php 	if (isset($json_retrieved_users)) {
			echo "<script src='js/admin_users.js'></script>";
		} elseif (isset($json_retrieved_artists)) {
			echo "<script src='js/admin_artists.js'></script>";
		} elseif (isset($json_retrieved_books)) {
			echo "<script src='js/admin_books.js'></script>";
		} ?>
	</head>
	<body>
	<?php
		include("include/header.php");

		if (!isset($_SESSION['user_logged'])) { ?>
			<!-- TO DO : prévoir fonction qui affiche erreur -->
			<?php echo TXT_INTERDICTION; ?>
	<?php } else {
				if ($user_logged->getUserStatus()!==5) { ?>
					<?php echo TXT_INTERDICTION; ?>
	<?php   	} else { ?>
					<div class="container-fluid row">
						<div class="col-xs-1"></div>
						<div class="col-xs-10">
							<div class="row">
								<h1><?php echo TXT_GESTION_DES_UTILISATEURS; ?></h1>
								<h2>En construction</h2>
								<h3>Nouvelles fonctionnalités :</h3>
								<ul>
									<li>modifications d'un artiste</li>
									<li>recherche des books</li>
									<li>modifications d'un book</li>
								</ul>
								<p>Fonctionnalité(s) future(s) ?</p>
								<ul>
									<li>modifications des fichiers d'un book ? (le pdf complet, la vignette, la couverture et les descriptions</li>
								</ul>
							</div>

							<div id="search_user" class="row thumbnail">
								<p><?php echo TXT_RECHERCHE_UTILISATEUR; ?></p>
								<!-- pouvoir faire une recherche sur les utilisateurs avec le mail - avoir l'info date de la cotis'-->
								<!-- DEVDEV façon moche <?php  if (isset($msg_user_search)) { echo $msg_user_search."<br>";} ?> -->
								<?php if(isset($search_user_msg)) echo "<p><b>$search_user_msg</b><p>"; ?>
									<div id="retrieved_users_table">
										<?php
										//DEVDEV faire une unique variable qui active ou pas le script
										//on initialise ensuite la bonne partie du code
										//if (isset($_POST['search_user_form'])) { ?>
									</div>
									<form action="" method="POST">
									<label for="mail"><?php echo TXT_RECHERCHE_USER_QUESTION; ?></label><br>
									<input type="text" name="mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" >
									<input type="submit" name="search_user_form" class="btn btn-primary" value="<?php echo TXT_BOUTON_RECHERCHE_UTILISATEUR; ?>" >
								</form>
							</div>

							<div id="updateUserModal" class="modal" role="dialog" aria-labelledby="updateUserModalLabel">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div id="update-user-header" class="modal-header">
											<button type="button" class="close closeModal" data-dismiss="modal">&times;</button>
											<br><h3 id="updateUserModalLabel">Modification des propriétés d'un utilisateur</h3>
											<form id="delete-user-form" method="POST">
												<input type="hidden" name="id">
												<input id="delete-user-button" type="submit" name="delete-user" class="btn btn-danger" value="Supprimer cet utilisateur">
											</form>
											<div id="user-selected-table"></div>
										</div>
										<div class="modal-body">
											<form id="update-user-form" method="POST">
												<label for="id">Nouvelles valeurs des propriétés de cet utilisateur</label><br>
												<input type="hidden" name="id">
												<select name="status" required>
													<option value=2><?php echo TXT_TYPE_PRESENTATION; ?></option>
													<option value=3><?php echo TXT_TYPE_ADHERENT; ?></option>
													<option value=4><?php echo TXT_TYPE_ARTISTE; ?></option>
													<option value=5><?php echo TXT_TYPE_ADMINISTRATEUR; ?></option>
												</select>
												<input type="text" name="firstname" placeholder="<?php echo TXT_PLACEHOLDER_FIRSTNAME; ?>" >
												<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_NAME; ?>" ><br>
												<input type="text" name="mail" class="input-mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" required>
												<input type="date" name="subscription_date" placeholder="<?php echo TXT_PLACEHOLDER_DATE; ?>" required><br>
												<input type="submit" name="update-user" class="btn btn-primary" value="Sauvegarder les modifications">
												<button type="button" class="btn btn-default btn-lg pull-right closeModal" data-dismiss="modal">Fermer</button>
											</form>
										</div>
									</div>
								</div>
							</div>

							<div id="search_artist" class="row thumbnail">
								<p><?php echo TXT_RECHERCHE_AUTHOR; ?></p>
								<?php if(isset($search_artist_msg)) echo "<p><b>$search_artist_msg</b><p>"; ?>
								<div id="retrieved_artist_table"></div>
								<form action="" method="POST">
									<label for="author_pseudo">Quel artiste recherchez-vous ?</label><br>
									<input type="text" name="author_pseudo" placeholder="<?php echo TXT_PLACEHOLDER_ARTIST_NAME; ?>" >
									<input type="submit" name="search_artist_form" class="btn btn-primary" value="<?php echo TXT_BOUTON_SEARCH_AUTHOR; ?>" >
								</form>
							</div>

							<div id="updateArtistModal" class="modal" role="dialog" aria-labelledby="updateArtistModalLabel">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div id="update-artist-header" class="modal-header">
											<button type="button" class="close closeModal" data-dismiss="modal">&times;</button>
											<br><h3 id="updateArtistModalLabel">Modification des propriétés d'un artiste</h3>
											<form id="delete-artist-form" method="POST">
												<input type="hidden" name="id">
												<input id="delete-artist-button" type="submit" name="delete-artist" class="btn btn-danger" value="Supprimer cet artiste">
											</form>
											<div id="artist-selected-table"></div>
										</div>
										<div class="modal-body">
											<form id="update-artist-form" method="POST" enctype="multipart/form-data">
												<label>Nouvelles valeurs des propriétés de cet artiste</label><br>
												<input type="hidden" name="id">
												<label for="name">Nom de l'artiste</label>
												<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_ARTIST_NAME; ?>" required>
												<!-- <input type="text" name="artist_search_name" placeholder="Search name (en général le nom de famille)" required> -->
												<br><?php echo TXT_AUTHOR_SUBMIT_CV; ?><input class="btn btn-file" type="file" name="artist_cv_file">
												<br>Fichier .txt de description de l'artiste en français :
												<input class="btn btn-file" type="file" name="artist_description_file_fr" >
												<br>Fichier .txt de description de l'artiste en anglais :
												<input class="btn btn-file" type="file" name="artist_description_file_en" >
												<br>
												<input type="submit" name="update-artist" class="btn btn-primary" value="Sauvegarder les modifications">
												<button type="button" class="btn btn-default btn-lg pull-right closeModal" data-dismiss="modal">Fermer</button>
											</form>
										</div>
									</div>
								</div>
							</div>

							<div id="search_book" class="row thumbnail">
								<p><?php echo TXT_RECHERCHE_BOOK; ?></p>
								<?php if(isset($search_book_msg)) echo "<p><b>$search_book_msg</b><p>"; ?>
								<div id="retrieved_book_table"></div>
								<form action="" method="POST">
									<label for="book_title">Quel book recherchez-vous ?</label><br>
									<input type="text" name="book_title" placeholder="<?php echo TXT_PLACEHOLDER_BOOK_TITLE; ?>" >
									<input type="submit" name="search_book_form" class="btn btn-primary" value="<?php echo TXT_BOUTON_SEARCH_BOOK; ?>" >
								</form>
							</div>

							<div id="updateBookModal" class="modal" role="dialog" aria-labelledby="updateBookLabel">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div id="update-book-header" class="modal-header">
											<button type="button" class="close closeModal" data-dismiss="modal">&times;</button>
											<br><h3 id="updateBookModal">Modification des propriétés d'un book</h3>
											<form id="delete-book-form" method="POST">
												<input type="hidden" name="id">
												<input id="delete-book-button" type="submit" name="delete-book" class="btn btn-danger" value="Supprimer ce book">
											</form>
											<div id="book-selected-table"></div>
										</div>
										<div class="modal-body">
											<form id="update-book-form" method="POST" enctype="multipart/form-data">
												<label>Nouvelles valeurs des propriétés de ce book</label><br>
												<input type="hidden" name="id">
												Titre du book
												<input type="text" name="title" placeholder="<?php echo TXT_PLACEHOLDER_BOOK_TITLE; ?>" required>
												<br>
												L'artiste auteur du book :
												<select name="artist" required>
													<?php foreach ($existing_artists as $artist) {
														echo "<option value='".$artist->getAuthorID()."'>".$artist->getAuthorName()."</option>";
													} ?>
												</select>
												<br><?php echo TXT_COLLECTION; ?>
												<select id="select-collection" name="collection" onchange="collectionSelecChange(this);" required>
													<?php foreach ($sql->getAvalaibleCollections() as $collection) {
														echo '<option value="'.$collection.'">'.$collection.'</option>';
													}  ?>
													<option value="other">Autre: nouvelle collection</option>
												</select>
												<br><?php echo TXT_PUBLISH_DATE; ?><input type="date" name="publish_date" value="<?php echo date("Y-m-d"); ?>" min="2015-01-01" required>
												<br>
												<input type="submit" name="update-book" class="btn btn-primary" value="Sauvegarder les modifications">
												<button type="button" class="btn btn-default btn-lg pull-right closeModal" data-dismiss="modal">Fermer</button>
											</form>
										</div>
									</div>
								</div>
							</div>

							<div class="row thumbnail">
								<h3><?php echo TXT_NOUVEL_UTILISATEUR; ?></h3>
								<?php  if (isset($msg_new_user)) { echo $msg_new_user."<br>";} ?>
								<!-- TO DO : la patie du controlleur, création mdp aléatoire, et envoi d'un mail! -->
								<form action="" method="POST">
									<label for="user_type"><?php echo TXT_TYPE_COMPTE; ?></label><br>
									<select name="user_type" required>
										<option value=3><?php echo TXT_TYPE_ADHERENT; ?></option>
										<!-- il faut crer le compte artiste associe en meme temps <option value=4><?php echo TXT_TYPE_ARTISTE; ?></option> -->
										<option value=5><?php echo TXT_TYPE_ADMINISTRATEUR; ?></option>
										<option value=2><?php echo TXT_TYPE_PRESENTATION; ?></option>
									</select>
									<input type="text" name="firstname" placeholder="<?php echo TXT_PLACEHOLDER_FIRSTNAME; ?>" >
									<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_NAME; ?>" >
									<input type="text" name="mail" class="input-mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" required>
									<input type="date" name="subscripion_end_date" placeholder="<?php echo TXT_PLACEHOLDER_DATE; ?>" required>
									<input type="submit" name="new_user_form" class="btn btn-primary" value="<?php echo TXT_CREER_COMPTE; ?>" >
								</form>
							</div>

							<div class="row thumbnail">
								<h3><?php echo TXT_NOUVEL_ARTISTE; ?></h3>
								<?php if(isset($new_artist_msg)) echo "<b>$new_artist_msg</b><br>"; ?>
								<form action="" method="POST" enctype="multipart/form-data">
									<input type="text" name="firstname" placeholder="<?php echo TXT_PLACEHOLDER_FIRSTNAME; ?>" >
									<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_NAME; ?>" required>
									<input type="text" name="mail" class="input-mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" required>
									<input type="text" name="artist_name" placeholder="<?php echo TXT_PLACEHOLDER_ARTIST_NAME; ?>" required>
									<input type="date" name="subscripion_end_date" placeholder="<?php echo TXT_PLACEHOLDER_DATE; ?>" required>
									<br><?php echo TXT_AUTHOR_SUBMIT_CV; ?><input class="btn btn-file" type="file" name="artist_cv_file">
									<br>Fichier .txt de description de l'artiste en français :
									<input class="btn btn-file" type="file" name="artist_description_file_fr" required>
									<br>Fichier .txt de description de l'artiste en anglais :
									<input class="btn btn-file" type="file" name="artist_description_file_en" required>
									<br>
									<input type="submit" name="new_artist_form" class="btn btn-primary" value="<?php echo TXT_CREER_ARTISTE; ?>">
								</form>
							</div>

								<div class="row thumbnail">
								<h3><?php echo TXT_AJOUT_BOOK; ?></h3>
								<?php if(isset($new_book_msg)) echo "<p><b>$new_book_msg</b><p>"; ?>
								<!-- Supprimer les deux autres messages -->
								<?php if (isset($dl_fail_error)) echo TXT_ERR_UPLOAD_FAIL; ?>
								<?php if (isset($incorrect_file_extension_error)) echo TXT_ERR_INCORRECT_FILE_EXTENSION; ?>
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<!-- on peut mettre des labels mais j'aime pas ça fait juste du texte en gras<label for="new_book_form"><?php echo TXT_FICHIER_COMPLET; ?></label> -->
									<?php echo TXT_FICHIER_COMPLET; ?>
									<input class="btn btn-file" type="file" name="full_book_file" required>
<!-- 									<br><?php echo TXT_FICHIER_EXTRAIT; ?>
									<input class="btn btn-file" type="file" name="extract_book_file" required> -->
									<!-- <br><?php echo TXT_BOOK_DESCRIPTION_FILE; ?> -->
									<br>Le fichier de description du book en <b>français</b>:
									<input class="btn btn-file" type="file" name="description_book_file_fr" required>
									<br>et celui en <b>anglais</b> :
									<input class="btn btn-file" type="file" name="description_book_file_en" required>
									<br>La couverture du book (616x600) <b>complet</b>:
									<input class="btn btn-file" type="file" name="cover_file" required>
<!-- 									<br>et celle de <b>l'extrait</b> :
									<input class="btn btn-file" type="file" name="cover_file_extract" required> -->
									<br>La vignette du book (450x438) :
									<input class="btn btn-file" type="file" name="thumbnail_file" required>
									<br>Titre du book :
									<input type="text" name="title" placeholder="<?php echo TXT_PLACEHOLDER_TITRE; ?>" required>
									L'artiste auteur du book :
									<select name="author" required>
										<?php foreach ($existing_artists as $artist) {
											echo "<option value='".$artist->getAuthorID()."'>".$artist->getAuthorName()."</option>";
										} ?>
									</select>
									<br><?php echo TXT_COLLECTION; ?>
									<select id="select-collection" name="collection" onchange="collectionSelecChange(this);" required>
										<?php foreach ($sql->getAvalaibleCollections() as $collection) {
											echo '<option value="'.$collection.'">'.$collection.'</option>';
										}  ?>
										<option value="other">Autre: nouvelle collection</option>
									</select>
									<?php echo TXT_PUBLISH_DATE; ?><input type="date" name="publish_date" value="<?php echo date("Y-m-d"); ?>" min="2015-01-01" required>
									<br>
									<input type="submit" class="btn btn-primary" name="new_book_form" value="<?php echo TXT_BOUTON_CREER_BOOK; ?>">
								</form>
							</div>

							<!--		on cache tout pour la 1.0 tant que c'est pas fonctionnel

							<div class="row">
								<h1 class="Section"><?php echo TXT_SECTION_NEWS; ?></h1>
							</div>

							<div class="thumbnail">
								<h3>Ajouter une actualité</h3>
								<form action="" method="POST">
									<select name="lang" required>
										<option value='fr'>Fr</option>
										<option value='en'>En</option>
										<!-- <option value='es'>Es</option> -->
					<!--				</select>
									<br>
									<textarea style="max-width: 100%;  max-height: 100%;" rows="10" cols="400" name="news_text"></textarea>
									<br>
									<input type="submit" name="news_form" class="btn btn-primary" value="<?php echo TXT_BUTTON_SEND; ?>">
								</form>
							</div>

							<div class="row">
								<h1 class="Section"><?php echo TXT_SECTION_LANG; ?></h1>
							</div>

							-->

							<div class="row thumbnail">
								<!-- DEVDEVDEV TO DO : affichage propre des messages d'erreurs/confirmation -->
								<h3><?php echo TXT_UPLOAD_LANG_FILES; ?></h3>
							<?php if (isset($msg_upload_lang_file)) echo "<b>$msg_upload_lang_file</b>"; ?>
								<!-- <p><?php if (isset($dl_fail_error)) echo TXT_ERR_UPLOAD_FAIL; ?></p>
								<p><?php if (isset($incorrect_file_extension_error)) echo TXT_ERR_INCORRECT_FILE_EXTENSION; ?></p> -->
								<!-- Autre façon de faire pour l'upload de fichier : voir upload book -->
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<?php echo TXT_LANG_FILE_FR; ?>
									<input class="btn btn-file" type="file" name="fr_lang_file" required/>
									<input type="submit" class="btn btn-primary" name="set_fr_lang_file" value="<?php echo TXT_BUTTON_SEND; ?>">
								</form>
								<br>
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<?php echo TXT_LANG_FILE_EN; ?>
									<input class="btn btn-file" type="file" name="en_lang_file" required/>
									<input type="submit" class="btn btn-primary" name="set_en_lang_file" value="<?php echo TXT_BUTTON_SEND; ?>">
								</form>
								<!-- pour rajouter des langues
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<?php echo TXT_LANG_FILE_DE; ?>
									<input class="btn btn-file" type="file" name="de_lang_file" required/>
									<input type="submit" class="btn btn-primary" name="set_de_lang_file" value="<?php echo TXT_BUTTON_SEND; ?>">
								</form> -->
							</div>

							<div class="row thumbnail dl-lang-files">
								<h3>Télécharger les fichiers définissant les textes du site dans chaque langue</h3>
								<a href="admin.php?dl=fr" class="btn btn-primary">Download fr-lang.php</a><br>
								<a href="admin.php?dl=en" class="btn btn-primary">Download en-lang.php</a>
							</div>

						</div>
						<div class="col-xs-1"></div>
					</div>
	<?php  	}
		} ?>
	</body>
</html>