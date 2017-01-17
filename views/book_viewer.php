<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<link rel="stylesheet" href="css/book_viewer.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
	<?php include("header.php"); ?>

	<div class="Section">
		Page de consultation des Opening book
	</div>	

	<?php if (!isset($_SESSION['user_logged'])) { ?> 
			<!-- 
			TO DO : prévoir fonction qui affiche erreur
			-->
			Attention, en tant que visiteur vous n'avez accès qu'à des extraits
	<?php } else {
				if ($user_logged->getUserStatus() >= 3) { ?>
					En tant qu'adhérent vous avez accès à l'ensemble des books						
	<?php  		} else { ?>
					Attention, votre cotisation n'est pas à jour. Vous n'avez accès qu'à des extraits des books.
	<?php		}		
		} ?> 	

	<?php include("footer.php"); ?> 
	
	</body>
</html>