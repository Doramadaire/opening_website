<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>OPENING</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
		<script src="js/global.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
  
	<body>
		<?php include("header.php"); ?> 
		<?php include("diapo.php"); ?> 
		
					
		
<div class="container-fluid">	
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
     
	  <!-- id="form" -->
      <div  class="caption">
		 
        <?php if ($user_logged) { ?>
			<h3>Bonjour <?php echo $user_logged->getUserMail(); ?></h3>
			
			<?php 	switch($_SESSION['user_logged']->getUserStatus()) 
					{
							     case 2:  ?>
					Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir la collection (seulement des extraits)</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 3:  ?>
					Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir la collection</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> </ul>
							 
					<?php break; case 4:	?>
					Vous pouvez : <br> 
					
						<ul> <li><a href="book_viewer.php">Parcourir la collection</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li> 
							 <li><a href="book_management.php">Gérer vos oeuvres</a></li>  </ul>
							 
					<?php break; case 5: ?>
					Vous pouvez : <br> 
						<ul> <li><a href="book_viewer.php">Parcourir la collection</a></li> 
							 <li><a href="user_settings.php">Gérer votre compte</a></li>							 
							 <li><a href="book_management.php">Gérer les oeuvres</a></li>
							 <li><a href="user_management.php">Gérer les membres</a></li></ul>
							 
					<?php break;} ?>
			
			<form action="" method="POST">
				<input class="btn btn-primary" role="button" type="submit" name="loggout_form" value="Se déconnecter">
			</form>
		<?php } else { ?>
			<h3>Connectez-vous</h3>
		<?php 	if (isset($logging_error)) {echo '<p class="error">'.$logging_error.'<p>';}?> 
			<form action="" method="POST">
				<input type="text" name="mail" placeholder="e-mail"> <br>
				<input type="password" name="password" placeholder="mot de passe">  <br><br>
				<p><input class="btn btn-primary" role="button" type="submit" name="logging_form" value="Se connecter"></p>
			</form> 
			 <a onclick="hideThis('oubli')">Mot de passe oublié? </a>	 
			 <?php 	if (isset($reset_pswd_error)) {echo '<p class="error">'.$reset_pswd_error.'<p>';}?> 
			 <form id="oubli" action="" method="POST">
			 	<p><input type="text" name="mail_pswd_forgotten" placeholder="e-mail"></p>
			 	<p>Attention! Cette action génére un nouveau mot de passe qui sera envoyé à l'adresse mail de votre compte</p>
			 	<p><input class="btn btn-primary" role="button" type="submit" name="pswd_forgotten_form" value="Générer un nouveau mot de passe"></p>
			 </form>
             <?php }?>																																
         
      </div>
    </div>
  </div>
	  
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      
      <div class="caption">
        <h3>Parcourir la collection</h3>
		<br><br><br>
        <p></a><a href="book_viewer.php" class="btn btn-primary" role="button">Recherche</a> </p>
      </div>
    </div>
  </div>
  
  
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
       <div class="caption">
        <h3>Adhésion</h3>
        <p>Pour adhérer à l'association ou renouveler votre cotisation, vous serez redirigé vers Helloasso.</p>
		
        <p><a href="join.php" class="btn btn-primary" role="button">Adhérer</a> </p>
      </div>
    </div>
  </div>
  
</div>
</div>		
		
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	</body>
	
	
	
    
</html>