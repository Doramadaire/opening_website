<!DOCTYPE html>
<html>
	<head>
        <?php include("html_header.php"); ?>
        <title>Opening</title>
        <!-- Import des fichiers spécifiques à cette page -->
		<link href="css/index.css" rel="stylesheet">
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
		<?php 	if (isset($logging_error)) {echo '<p class="error_message">'.$logging_error.'<p>';}?> 
			<form action="" method="POST">
				<input type="text" name="mail" placeholder="e-mail"> <br>
				<input type="password" name="password" placeholder="mot de passe">  <br><br>
				<p><input class="btn btn-primary" role="button" type="submit" name="logging_form" value="Se connecter"></p>
			</form> 
			 <a onclick="hideThis('oubli')">Mot de passe oublié? </a>	 
			 <?php 	if (isset($reset_pswd_error)) {echo '<p class="error_message">'.$reset_pswd_error.'<p>';}?> 
			 <form id="oubli" class="hide_first" action="" method="POST">
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