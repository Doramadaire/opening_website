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
					<div class="Section">
						Page de gestion des utilisateurs
					</div>

					Bienvenue cher admin!					
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