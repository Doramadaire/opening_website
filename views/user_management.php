<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/user_management.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
  
	<?php 
		include("header.php"); 

		if (!isset($_SESSION['user_logged'])) { ?> 
			<!-- 
			TO DO : prévoir fonction qui affiche erreur
			-->
			Vous n'avez pas le droit d'accéder à cette page		
	<?php } else {
				if ($user_logged->getUserStatus()!==5) { ?>
					<!-- 
					TO DO : prévoir fonction qui affiche erreur
					-->
					Vous n'avez pas le droit d'accéder à cette page	
	<?php   	} else { ?>
					<div class="container"> 
						<div class="Section">
							Page de gestion des utilisateurs
						</div>

						Bienvenue cher admin!

						<div class="row">
							<p>Rechercer les informations sur un utilisateur</p>
							<p>En construction</p>
							<!-- pouvoir faire une recherche sur les utilisateurs avec le mail - avoir l'info date de la cotis'-->
						</div>

						<div class="row">
							<p>Création d'un compte utilisateur du site</p>
							<?php  if (isset($msg_new_user)) { echo $msg_new_user."<br>";} ?> 
							<!-- TO DO : la patie du controlleur, création mdp aléatoire, et envoi d'un mail! -->
							<form action="" method="POST">
								<label for="user_type">Quel type de compte souhaitez vous créer?</label><br>
								<select name="user_type" required>
									<option value=2>Compte non adhérent</option>
									<option value=3>Compte adhérent (cotisant à jour)</option>
									<option value=4>Compte artiste</option>
									<option value=5>Compte administrateur</option>
								</select>
								<input type="text" name="mail" placeholder="mail" required>
								<input type="date" name="subscripion_end_date" placeholder="Date jusqu'à laquelle la cotisation est valable" required>
								<input type="submit" name="new_user_form" value="Créer l'utilisateur">	
							</form>	 
						</div>

						<div class="row">
							<p>Ajout d'un artiste</p>
							<!-- TO DO : 
							d'abord récupérer l'id_user du compte utilisateur à associer au compte
							champ pour le nom
							champ pour taper la description - on stocke le path du fichier
							champ pour taper les news - on stocke le path du fichier -->
							<form action="" method="POST">
								<input type="submit" name="new_author_form" value="Ajout de l'artiste">	
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
	
	<?php include("footer.php"); ?> 
	
	</body>
</html>