<!DOCTYPE html>
<html>
	<head>
		<?php include("include/html_header.php"); ?>
		<title><?php echo TXT_TAB_ADMIN; ?></title>
		<!-- Import des fichiers spécifiques à cette page -->
		<link rel="stylesheet" href="css/admin.css" type="text/css">
		<script type="text/javascript">
			function collectionSelecChange(value) {
				if (value === "other") {
					var newSpanText = document.createElement("span");
					newSpanText.id = "add-collection-span";
					newSpanText.innerHTML = "Attention, cette action va créer une nouvelle collection sur la page catalogue<br>";

					var newInputBox = document.createElement("input");
					newInputBox.required = true;
					newInputBox.id = "add-collection-input";
					newInputBox.setAttribute("type", "text");
					newInputBox.setAttribute("name", "new_collection");

					var selectBlock = document.getElementById("select-collection");
					selectBlock.parentNode.insertBefore(newInputBox , selectBlock.nextSibling);
					newInputBox.parentNode.insertBefore(newSpanText , newInputBox.nextSibling);
				} else {
					var uselessInputBox = document.getElementById("add-collection-input");
					var uselessSpanText = document.getElementById("add-collection-span");

					if (uselessInputBox !== null) {
						uselessInputBox.parentNode.removeChild(uselessInputBox);
					}
					if (uselessSpanText !== null) {
						uselessSpanText.parentNode.removeChild(uselessSpanText);
					}
				}
			}
		</script>
		<?php if (isset($json_retrieved_users)) { ?>
		<script type="text/javascript">
			var json_retrieved_users = '<?php echo $json_retrieved_users; ?>';
			var retrieved_users = JSON.parse(json_retrieved_users);

			//création du tableau d'users			
			function createUserTable(retrieved_users, parentID, childID) {
				var retrieved_users_table = document.createElement("table");
				retrieved_users_table.className = "table table-striped";
				retrieved_users_table.id = childID;

				//on fabrique la 1ère ligne
				var header = retrieved_users_table.createTHead();
				var row = header.insertRow(0);
				var cellId = row.insertCell(-1);
				var cellMail = row.insertCell(-1);
				var cellFirstname = row.insertCell(-1);
				var cellLastname = row.insertCell(-1);
				var cellStatus = row.insertCell(-1);
				var cellSubscriptionDate = row.insertCell(-1);
				cellId.innerHTML = 'user_id';
				cellMail.innerHTML = 'mail';
				cellFirstname.innerHTML = 'prenom';
				cellLastname.innerHTML = 'nom';
				cellStatus.innerHTML = 'statut';
				cellSubscriptionDate.innerHTML = 'date fin adhesion';

				var body = document.createElement('tbody');
				retrieved_users_table.appendChild(body);

				var nbRetrievedUsers = retrieved_users.length;
				for (var i = 0; i < nbRetrievedUsers; i++) {
					user = retrieved_users[i];
					var user = retrieved_users[i];
					var row = body.insertRow(-1);
					row.className = "user-row";

					var cellId = row.insertCell(-1);
					// cellId.className = "cell-id-" + user['id'];
					cellId.className = "cell-user-id";
					var cellMail = row.insertCell(-1);
					var cellFirstname = row.insertCell(-1);
					var cellLastname = row.insertCell(-1);
					var cellStatus = row.insertCell(-1);
					var cellSubscriptionDate = row.insertCell(-1);

					cellId.innerHTML = user['id'];
					cellMail.innerHTML = user['mail'];
					cellFirstname.innerHTML = user['firstname'];
					cellLastname.innerHTML = user['name'];
					cellStatus.innerHTML = user['status'];
					cellSubscriptionDate.innerHTML = user['subscription_date'];
				}

				var parent = document.getElementById(parentID);
				var child = document.getElementById(childID);
				parent.replaceChild(retrieved_users_table, child);
			}

			$(function() {
				//console.log("ready!");
				createUserTable(retrieved_users, "search_user", "retrieved_users_table");

				var updateUserModal = document.getElementById('updateUserModal');

				var userSelected = null;
				var userIDSelected = null;
				$(".user-row").click(function() {
					// aller, on fait un modal avec un formulaire et tout le tralala
					updateUserModal.style.display = "block";
					updateUserModal.focus();

					//on recupere l'user sur lequel on a cliqué
					$(this).children().each(function() {
						if (this.className === "cell-user-id") {
							userIDSelected = this.innerHTML;
						};
					});
					var nbRetrievedUsers = retrieved_users.length;
					for (var i = 0; i < nbRetrievedUsers; i++) {
						var user = retrieved_users[i];
						if (userIDSelected === user['id']) {
							userSelected = user;
						};
					}
					//on affiche les valeurs actuelles de cet user
					createUserTable([userSelected], "update-user-header", "user-selected-table");
					//on met les valeurs actuelles dans les formulaire
					var updateUserFormChildNodes = document.getElementById("update-user-form").childNodes;
					for (var i = updateUserFormChildNodes.length - 1; i >= 0; i--) {
						node = updateUserFormChildNodes[i];
						if (node.tagName === "INPUT") {
							var nodeNameAttribute = node.getAttribute("name");
							if (userSelected[nodeNameAttribute] != null) {
								node.setAttribute("value", userSelected[nodeNameAttribute]);
							} else {
								//si pas de valeur, on supprime une éventuelle valeur
								if (node.getAttribute("type") !== "submit" && node.hasAttribute("value")) {
									node.removeAttribute("value");
								}
							}
						} else if (node.tagName === "SELECT") {
							//donc le select index dépend du nombre d'option
							//le -2 est une valeur hardcoded pour que ça marche sans se prendre la tête
							//sinon il faut itérer sur les options pour trouver la bonne... la flemme
							node.selectedIndex = userSelected['status']-2;
						};
					};
					//besoin du user_id dans mon formulaire pour supprimer un user
					var deleteUserFormChildNodes = document.getElementById("delete-user-form").childNodes;
					for (var i = deleteUserFormChildNodes.length - 1; i >= 0; i--) {
						node = deleteUserFormChildNodes[i];
						if (node.tagName === "INPUT" && node.getAttribute("name") === "id") {
							node.setAttribute("value", userSelected['id']);
						}
					}
				});

				$("#delete-user-button").click(function() {
					var confirmation = confirm("Etes vous sûr de vouloir supprimer cet utilisateur?");
					if (!confirmation) {
						return false;
					}
				});

				$(".closeModal").click(function() {
					//reset les valeurs du formulaire avant de le fermer
					document.getElementById("update-user-form").reset();
					updateUserModal.style.display = "none";
				});

				// When the user clicks anywhere outside of the modal, close it
				//deactivated : we don't want to lose data
				// window.onclick = function(event) {
				// 	if (event.target == updateUserModal) {
				// 		updateUserModal.style.display = "none";
				// 	}
				// }
			});
		</script>
		<?php } ?>

		<?php if (isset($json_retrieved_artists)) { ?>
		<script type="text/javascript">
		//création du tableau d'artistes
			function createArtistTable(retrieved_artists, parentID, childID) {
				var retrieved_artist_table = document.createElement("table");
				retrieved_artist_table.className = "table table-striped";

				//on fabrique la 1ère ligne
				var header = retrieved_artist_table.createTHead();
				var row = header.insertRow(0);
				var cellId = row.insertCell(-1);
				var cellName = row.insertCell(-1);
				//var cellSearchName = row.insertCell(-1);
				var cellUserId = row.insertCell(-1);
				cellId.innerHTML = 'artist_id';
				cellName.innerHTML = 'nom';
				//cellSearchName.innerHTML = 'nom recherche';
				cellUserId.innerHTML = 'user_id';

				var body = document.createElement('tbody');
				retrieved_artist_table.appendChild(body);

				var i = 0;
				for (var i = 0; i < retrieved_artists.length; i++) {
					artist = retrieved_artists[i];
					var row = body.insertRow(-1);
					row.className = "artist-row";

					var cellId = row.insertCell(-1);
					cellId.className = "cell-id";
					var cellName = row.insertCell(-1);
					//var cellSearchName = row.insertCell(-1);
					var cellUserId = row.insertCell(-1);

					cellId.innerHTML = artist['id'];
					cellName.innerHTML = artist['name'];
					//cellSearchName.innerHTML = artist['search_name'];
					cellUserId.innerHTML = artist['user'];
				}
				var parent = document.getElementById(parentID);
				var child = document.getElementById(childID);
				parent.replaceChild(retrieved_artist_table, child);
			}

			var json_retrieved_artists = '<?php echo $json_retrieved_artists; ?>';
			var retrieved_artists = JSON.parse(json_retrieved_artists);

			$(function() {
				createArtistTable(retrieved_artists, "search_artist", "retrieved_artist_table");
			});
		</script>
		<?php } ?>
	</head>	
	<body>
	<?php 
		include("include/header.php"); 

		if (!isset($_SESSION['user_logged'])) { ?> 
			<!-- 
			TO DO : prévoir fonction qui affiche erreur
			-->
			<?php echo TXT_INTERDICTION; ?>	
	<?php } else {
				if ($user_logged->getUserStatus()!==5) { ?>
					<!-- 
					TO DO : prévoir fonction qui affiche erreur
					-->
					<?php echo TXT_INTERDICTION; ?>
	<?php   	} else { ?>
					<div class="container-fluid row">
						<div class="col-xs-1"></div>
						<div class="col-xs-10">
							<div class="row">
								<h1><?php echo TXT_GESTION_DES_UTILISATEURS; ?></h1>
								<h2>En construction</h2>
								<p>Les prochaines fonctionnalités sont :</p>
								<ul>
									<li>modifications d'un artiste</li>
									<li>recherche et modifications d'un book</li>
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
									<label for="user_type"><?php echo TXT_RECHERCHE_USER_QUESTION; ?></label><br>
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
												<label for="user_type">Nouvelles valeurs des propriétés de cet utilisateur</label><br>
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
									<label for="user_type"><?php echo TXT_RECHERCHE_AUTHOR_QUESTION; ?></label><br>
									<input type="text" name="author_pseudo" placeholder="<?php echo TXT_PLACEHOLDER_ARTIST_NAME; ?>" >
									<input type="submit" name="search_artist_form" class="btn btn-primary" value="<?php echo TXT_BOUTON_SEARCH_AUTHOR; ?>" >
								</form>	
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
								<?php if(isset($new_author_msg)) echo "<b>$new_author_msg</b><br>"; ?>
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
									<br><?php echo TXT_FICHIER_EXTRAIT; ?>
									<input class="btn btn-file" type="file" name="extract_book_file" required>
									<!-- <br><?php echo TXT_BOOK_DESCRIPTION_FILE; ?> -->
									<br>Le fichier de description du book en <b>français</b>:
									<input class="btn btn-file" type="file" name="description_book_file_fr" required>
									<br>et celui en <b>anglais</b> :
									<input class="btn btn-file" type="file" name="description_book_file_en" required>
									<br>La couverture du book (616x600) <b>complet</b>:
									<input class="btn btn-file" type="file" name="cover_file" required>
									<br>et celle de <b>l'extrait</b> :
									<input class="btn btn-file" type="file" name="cover_file_extract" required>
									<br>La vignette du book (450x438) :
									<input class="btn btn-file" type="file" name="thumbnail_file" required>
									<br>Titre du book : 
									<input type="text" name="title" placeholder="<?php echo TXT_PLACEHOLDER_TITRE; ?>" required>
									L'artiste auteur du book : 
									<select name="author" required>
										<?php foreach ($sql->getAuthorsSortedAlphabetical() as $artist) {
											echo "<option value='".$artist->getAuthorID()."'>".$artist->getAuthorName()."</option>";
										} ?>
									</select>
									<br><?php echo TXT_COLLECTION; ?>
									<select id="select-collection" name="collection" onchange="collectionSelecChange(value);" required>
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
								<!-- <p><?php if (isset($dl_fail_error)) echo TXT_ERR_UPLOAD_FAIL; ?></p>
								<p><?php if (isset($incorrect_file_extension_error)) echo TXT_ERR_INCORRECT_FILE_EXTENSION; ?></p> -->
								<!-- Autre façon de faire pour l'upload de fichier : voir upload book -->
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<?php echo TXT_LANG_FILE_FR; ?>	
									<input class="btn btn-file" type="file" name="fr_lang_file" required/>			
									<br>							
									<?php echo TXT_LANG_FILE_EN; ?>
									<input class="btn btn-file" type="file" name="en_lang_file" required/>
									<br>
									<!-- pour rajouter des langues
									<?php echo TXT_LANG_FILE_DE; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="de_lang_file" required/>	
									</div>
									<br>
									<?php echo TXT_LANG_FILE_ES; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="es_lang_file" required/>
									</div>
									<br>
									<?php echo TXT_LANG_FILE_IT; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="it_lang_file" required/>
									<br>	-->													
									<input type="submit" class="btn btn-primary" name="set_lang_files_form" value="<?php echo TXT_BUTTON_SEND; ?>">	
								</form>	 
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

	<!-- TO DO :
	rajouter boutons:
		*ajouter user
		*changer mail
		*changer date de cotis'
		*changer statu
		*changer mdp?
	-->

	</body>
</html>