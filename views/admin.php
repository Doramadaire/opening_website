<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_ADMIN; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link rel="stylesheet" href="css/admin.css" type="text/css">
        <?php if (isset($json_retrieved_users)) { ?>
        <script type="text/javascript">
        	//création du tableau d'users
        	
        	function createUserTable() {
			    var json_retrieved_users = '<?php echo $json_retrieved_users; ?>';
        		var retrieved_users = JSON.parse(json_retrieved_users);
        		//DEVDEV pb : on passe un ARRAY encode en json d'users
        		//voir pour récupérer cet objet array peinard...
        		//ça m'a l'air bon là

        		var retrieved_users_table = document.createElement("table");
        		retrieved_users_table.className = "table table-striped";

        		//on fabrique la 1ère ligne
        		var header = retrieved_users_table.createTHead();
        		var row = header.insertRow(0);
        		var cellId = row.insertCell(-1);
        		var cellMail = row.insertCell(-1);
        		var cellName = row.insertCell(-1);
				cellId.innerHTML = 'user_id';
				cellMail.innerHTML = 'mail';
				cellName.innerHTML = 'name';

				var body = document.createElement('tbody');
				retrieved_users_table.appendChild(body);

        		var i = 0;
				for (var i = 0; i < retrieved_users.length; i++) {
					user = retrieved_users[i];
					var row = body.insertRow(-1);
					row.className = "user-row";

					//à tester
					/*
					row.id = "user" + i;// attribut id incertain
					function editUser (index) {
						var parent = document.getElementById("user" + index);
						// insert blabla
					}*/

				    var cellId = row.insertCell(-1);
				    cellId.className = "cell-id";
				    var cellMail = row.insertCell(-1);
				    var cellName = row.insertCell(-1);

				    cellId.innerHTML = user['id'];
				    cellMail.innerHTML = user['mail'];
				    cellName.innerHTML = user['name'];
				    //console.log("id=" + user['id'] + " mail=" + user['mail']);
				}
        		var parent = document.getElementById("search_user");
				var child = document.getElementById("retrieved_users_table");
				parent.replaceChild(retrieved_users_table, child);
			}

			$(function() {
			    console.log("ready!");
			    createUserTable();

			    $(".user-row").click(function() {
				console.log("click sur ma ligne");
				console.log($(this).find("cell-id"));
				console.log("html" + $(this).find("cell-id").html());
				console.log("text" + $(this).find("cell-id").text());
				console.log("val" + $(this).find("cell-id").val());
    			});
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
									<li>recherche et modifications d'un utilisateur</li>
									<li>recherche et modifications d'un artiste</li>
									<li>recherche et modifications d'un book</li>
									<li>gestion des actualités</li>
									<li>ajout d'un artiste</li>
									<li>ajout d'un book</li>
								</ul>
							</div>

							<!-- on cache tout pour la 1.0 tant que c'est pas fonctionnel
	
							<div id="search_user" class="row thumbnail">
								<p><?php echo TXT_RECHERCHE_UTILISATEUR; ?></p>							
								<!-- pouvoir faire une recherche sur les utilisateurs avec le mail - avoir l'info date de la cotis'-->
								<!-- DEVDEV façon moche <?php  if (isset($msg_user_search)) { echo $msg_user_search."<br>";} ?> -->
					<!--	<?php 	if (isset($_POST['search_user_form'])) {
									echo "$msg_user_search";
								} ?>
									<div id="retrieved_users_table">
										<?php 
								        //DEVDEV faire une unique variable qui active ou pas le script
								        //on initialise ensuite la bonne partie du code
								        //if (isset($_POST['search_user_form'])) { ?>
									</div>
									<form action="" method="POST">
									<label for="user_type"><?php echo TXT_RECHERCHE_USER_QUESTION; ?></label><br>
									<input type="text" name="mail" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?> >
									<input type="submit" name="search_user_form" class="btn btn-primary" value=<?php echo '"'.TXT_BOUTON_RECHERCHE_UTILISATEUR.'"'; ?>>	
								</form>	
							</div>
	
							<div class="row thumbnail">
								<p><?php echo TXT_RECHERCHE_AUTHOR; ?></p>							
								<!-- GERER MESSAGES MIEUX -->
						<!--		<?php  if (isset($msg_author_search)) { echo $msg_author_search."<br>";} ?>
								<form action="" method="POST">
									<label for="user_type"><?php echo TXT_RECHERCHE_AUTHOR_QUESTION; ?></label><br>
									<input type="text" name="author_pseudo" placeholder=<?php echo '"'.TXT_PLACEHOLDER_ARTIST_NAME.'"'; ?> >
									<input type="submit" name="search_author_form" class="btn btn-primary" value=<?php echo '"'.TXT_BOUTON_SEARCH_AUTHOR.'"'; ?>>	
								</form>	
							</div>

							-->
							<!-- La création d'user est fonctionnel et on en a besoin -->
	
							<div class="row thumbnail">
								<h3><?php echo TXT_NOUVEL_UTILISATEUR; ?></h3>
								<?php  if (isset($msg_new_user)) { echo $msg_new_user."<br>";} ?> 
								<!-- TO DO : la patie du controlleur, création mdp aléatoire, et envoi d'un mail! -->
								<form action="" method="POST">
									<label for="user_type"><?php echo TXT_TYPE_COMPTE; ?></label><br>
									<select name="user_type" required>
										<!-- <option value=2><?php echo TXT_TYPE_NON_ADHERENT; ?></option> je désactive car dans les faits je m'en sert pas, mais je me sers de la date de subscription... -->
										<option value=3><?php echo TXT_TYPE_ADHERENT; ?></option>
										<!-- il faut crer le compte artiste associe en meme temps <option value=4><?php echo TXT_TYPE_ARTISTE; ?></option> -->
										<option value=5><?php echo TXT_TYPE_ADMINISTRATEUR; ?></option>
									</select>
									<input type="text" name="firstname" placeholder="<?php echo TXT_PLACEHOLDER_FIRSTNAME; ?>" >
									<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_NAME; ?>" >
									<input type="text" name="mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" required>
									<input type="date" name="subscripion_end_date" placeholder="<?php echo TXT_PLACEHOLDER_DATE; ?>" required>
									<input type="submit" name="new_user_form" class="btn btn-primary" value="<?php echo TXT_CREER_COMPTE; ?>" >	
								</form>	 
							</div>

							<div class="row thumbnail">
								<h3><?php echo TXT_NOUVEL_ARTISTE; ?></h3>
								<?php if(isset($new_author_msg)) {echo "<b>$new_author_msg</b><br>";} ?>
								<form action="" method="POST" enctype="multipart/form-data">
									<input type="text" name="firstname" placeholder="<?php echo TXT_PLACEHOLDER_FIRSTNAME; ?>" >
									<input type="text" name="name" placeholder="<?php echo TXT_PLACEHOLDER_NAME; ?>" required>
									<input type="text" name="mail" placeholder="<?php echo TXT_PLACEHOLDER_MAIL; ?>" required>
									<input type="text" name="artist_name" placeholder="<?php echo TXT_PLACEHOLDER_ARTIST_NAME; ?>" required>
									<input type="date" name="subscripion_end_date" placeholder="<?php echo TXT_PLACEHOLDER_DATE; ?>" required>
									<br><?php echo TXT_AUTHOR_SUBMIT_CV; ?><input class="btn btn-file" type="file" name="artist_cv_file" required>
									<br>Fichier .txt de description de l'artiste en français :
									<input class="btn btn-file" type="file" name="artist_description_file_fr" required>
									<br>Fichier .txt de description de l'artiste en anglais :
									<input class="btn btn-file" type="file" name="artist_description_file_en" required>
									<br>
									<input type="submit" name="new_artist_form" class="btn btn-primary" value="<?php echo TXT_CREER_ARTISTE; ?>">
								</form>
							</div>
	
					<!--		on cache tout pour la 1.0 tant que c'est pas fonctionnel
								<div class="row thumbnail">
								<p><?php echo TXT_AJOUT_BOOK; ?></p>
								<p><?php if (isset($dl_fail_error)) echo TXT_ERR_UPLOAD_FAIL; ?></p>
								<p><?php if (isset($incorrect_file_extension_error)) echo TXT_ERR_INCORRECT_FILE_EXTENSION; ?></p>
								<form action="admin.php" method="post" enctype="multipart/form-data">
									<!-- <label for="new_book_form"><?php echo TXT_AJOUT_BOOK2; ?></label><br> -->
					<!--				<?php echo TXT_FICHIER_COMPLET; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="full_book_file" required/>					
									</div>
									<br>
									<?php echo TXT_FICHIER_EXTRAIT; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="extract_book_file" required/>				
									</div>
									<br>
									<?php echo TXT_BOOK_DESCRIPTION_FILE; ?>
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" name="description_book_file"/>				
									</div>
									<br>
									<!-- Autre façon de faire
									<div class="fileUpload btn btn-primary">
										<span>Upload</span>		
										<input type="file" class="book_file" />						
									</div				-->							
					<!--				<input type="text" name="title" placeholder=<?php echo '"'.TXT_PLACEHOLDER_TITRE.'"'; ?> required><br>
									<?php echo TXT_COLLECTION; ?><select name="collection" required>
										<option value="opening book"><?php echo TXT_COLLECTION_OPENINGBOOK; ?></option>
										<option value="opening book photo"><?php echo TXT_COLLECTION_OPENINGBOOK_PHOTO; ?></option>
									</select><br>
									<?php echo TXT_ANNEE; ?><input type="number" name="publish_date" value="<?php echo date("YYYY-MM-DD"); ?>" min="2015-01-01" required><br>
									<input type="submit" class="btn btn-primary" name="new_book_form" value=<?php echo '"'.TXT_BOUTON_CREER_BOOK.'"'; ?>>	
								</form>	 
							</div>
	
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
									<br>    -->													
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