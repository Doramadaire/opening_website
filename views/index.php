<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
		<link href="css/index.css" rel="stylesheet">
        <link href="css/diapo.css" rel="stylesheet">
	</head>
  
	<body>
		<?php include("include/header.php"); ?> 
		<?php include("include/diapo.php"); ?> 					
		
<div class="container-fluid">	
<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
     
	  <!-- id="form" -->
      <div  class="caption">
		 
        <?php if ($user_logged) { ?>
			<h3><?php echo TXT_BONJOUR; ?> <?php echo $user_logged->getUserMail(); ?></h3>
			
			<?php 	switch($_SESSION['user_logged']->getUserStatus()) 
					{
							     case 2:  ?>
					<?php echo TXT_MENU; ?> : <br> 
						<ul> <li><a href="book_viewer.php"><?php echo TXT_MENU_RECHERCHE_EXTRAITS; ?></a></li> 
							 <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li> </ul>
							 
					<?php break; case 3:  ?>
					<?php echo TXT_MENU; ?> <br> 
						<ul> <li><a href="book_viewer.php"><?php echo TXT_MENU_RECHERCHE; ?></a></li> 
							 <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li> </ul>
							 
					<?php break; case 4:	?>
					<?php echo TXT_MENU; ?><br> 
					
						<ul> <li><a href="book_viewer.php"><?php echo TXT_MENU_RECHERCHE; ?></a></li> 
							 <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li> 
							 <li><a href="book_management.php"><?php echo TXT_MENU_OEUVRES; ?></a></li>  </ul>
							 
					<?php break; case 5: ?>
					<?php echo TXT_MENU; ?><br> 
						<ul> <li><a href="book_viewer.php"><?php echo TXT_MENU_RECHERCHE; ?></a></li> 
							 <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>							 
							 <li><a href="book_management.php"><?php echo TXT_MENU_OEUVRES_ADMIN; ?></a></li>
							 <li><a href="user_management.php"><?php echo TXT_MENU_COMPTES_ADMIN; ?></a></li></ul>
							 
					<?php break;} ?>
			
			<form action="" method="POST">
				<input class="btn btn-primary" role="button" type="submit" name="loggout_form" value=<?php echo '"'.TXT_BOUTON_SE_DECONNECTER.'"'; ?>>
			</form>
		<?php } else { ?>
			<h3><?php echo TXT_SECTION_CONNEXION; ?></h3>
		<?php 	if (isset($logging_error)) {echo '<p class="error_message">'.$logging_error.'<p>';}?> 
			<form action="" method="POST">
				<input type="text" name="mail" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?>> <br>
				<input type="password" name="password" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MDP.'"'; ?>>  <br><br>
				<p><input class="btn btn-primary" role="button" type="submit" name="logging_form" value=<?php echo '"'.TXT_BOUTON_SE_CONNECTER.'"'; ?>></p>
			</form> 
			 <a onclick="hideThis('oubli')"><?php echo TXT_MDP_OUBLIE; ?></a>	 
			 <?php 	if (isset($reset_pswd_error)) {echo '<p class="error_message">'.$reset_pswd_error.'<p>';}?> 
			 <form id="oubli" class="hide_first" action="" method="POST">
			 	<p><input type="text" name="mail_pswd_forgotten" placeholder=<?php echo '"'.TXT_PLACEHOLDER_MAIL.'"'; ?>></p>
			 	<p><?php echo TXT_ATTENTION_MDP_OUBLIE; ?></p>
			 	<p><input class="btn btn-primary" role="button" type="submit" name="pswd_forgotten_form" value=<?php echo '"'.TXT_BOUTON_RESET_MDP_OUBLIE.'"'; ?>></p>
			 </form>
             <?php }?>																																
         
      </div>
    </div>
  </div>
	  
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">      
      <div class="caption">
        <h3><?php echo TXT_SECTION_RECHERCHE; ?></h3>
		<br><br><br>
        <p></a><a href="book_viewer.php" class="btn btn-primary" role="button"><?php echo TXT_BOUTON_RECHERCHE; ?></a> </p>
      </div>
    </div>
  </div>
  
  
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
       <div class="caption">
        <h3><?php echo TXT_SECTION_ADHERER; ?></h3>
        <p><?php echo TXT_ADHERER; ?></p>
		
        <p><a href="join.php" class="btn btn-primary" role="button"><?php echo TXT_BOUTON_ADHERER; ?></a> </p>
      </div>
    </div>
  </div>
  
</div>
</div>		


	</body>    
</html>