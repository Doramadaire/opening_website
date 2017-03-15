<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link rel="stylesheet" href="css/user_management.css" type="text/css">	
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
					<div class="container"> 
						<div class="row">
							<h1 class="Section"><?php echo TXT_GESTION_DES_UTILISATEURS; ?></h1>
							<h2>En construction</h2>
							</div>

						<div class="row thumbnail">
							<p><?php echo TXT_RECHERCHE_UTILISATEUR; ?></p>							
							<!-- pouvoir faire une recherche sur les utilisateurs avec le mail - avoir l'info date de la cotis'-->
							<?php  if (isset($msg_user_search)) { echo $msg_user_search."<br>";} ?>
							<form action="" method="POST">
								<label for="user_type"><?php echo TXT_RECHERCHE_QUESTION; ?></label><br>
								<input type="text" name="mail" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?> required>
								<input type="submit" name="search_user_form" class="btn btn-primary" value=<?php echo '"'.TXT_BOUTON_RECHERCHE_UTILISATEUR.'"'; ?>>	
							</form>	
						</div>

						<div class="row thumbnail">
							<p><?php echo TXT_NOUVEL_UTILISATEUR; ?></p>
							<?php  if (isset($msg_new_user)) { echo $msg_new_user."<br>";} ?> 
							<!-- TO DO : la patie du controlleur, création mdp aléatoire, et envoi d'un mail! -->
							<form action="" method="POST">
								<label for="user_type"><?php echo TXT_TYPE_COMPTE; ?></label><br>
								<select name="user_type" required>
									<option value=2><?php echo TXT_TYPE_NON_ADHERENT; ?></option>
									<option value=3><?php echo TXT_TYPE_ADHERENT; ?></option>
									<option value=4><?php echo TXT_TYPE_ARTISTE; ?></option>
									<option value=5><?php echo TXT_TYPE_ADMINISTRATEUR; ?></option>
								</select>
								<input type="text" name="mail" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?> required>
								<input type="date" name="subscripion_end_date" placeholder=<?php echo '"'.TXT_PLACEHOLDER_DATE.'"'; ?> required>
								<input type="submit" name="new_user_form" class="btn btn-primary" value=<?php echo '"'.TXT_CREER_COMPTE.'"'; ?>>	
							</form>	 
						</div>

						<div class="row thumbnail">
							<p><?php echo TXT_NOUVEL_ARTISTE; ?></p>
							<!-- TO DO : 
							d'abord récupérer l'id_user du compte utilisateur à associer au compte
							champ pour le nom
							champ pour taper la description - on stocke le path du fichier
							champ pour taper les news - on stocke le path du fichier -->
							<form action="" method="POST">
								<input type="text" name="mail" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?>  required>
								<input type="date" name="subscripion_end_date" placeholder=<?php echo '"'.TXT_PLACEHOLDER_DATE.'"'; ?>  required>
								<input type="submit" name="new_author_form" class="btn btn-primary" value=<?php echo '"'.TXT_CREER_ARTISTE.'"'; ?> >	
							</form>	 
						</div>
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
	
	<?php include("include/footer.php"); ?> 
	
	</body>
</html>