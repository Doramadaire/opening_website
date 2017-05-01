<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
		<link rel="stylesheet" href="css/user_settings.css">
	</head>
	<body>
		<?php include("include/header.php"); ?> 
		<div class="container-fluid row"> 
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<?php if (!isset($_SESSION['user_logged'])) { ?> 
					<!-- Pas de session utilisateur -->
					<?php echo TXT_INTERDICTION; ?>
				<?php } else { ?>
					<div class="row">
						<h1><?php echo TXT_GESTION_COMPTE_USER; ?></h1>
					</div>
					<br/>
		
				<!-- Si on modifie le mail, il faut garder tracer du mail précédent, un nouveau champ en base avec la liste des mails? ou seulement celui avec lequel le compte a été créé?-->
		
				<div class="row">
					<?php 
						if (isset($msg_new_mail)) {
							echo $msg_new_mail;
							if ($new_mail_success) {
								echo "<br>".TXT_MAIL_CONFIRM.$user_logged->getUserMail()."<br>";
							}
						} 
						else {echo TXT_MAIL_ACTUEL.$user_logged->getUserMail()."<br>";}
						?><br>
					<input type="button" class="btn btn-primary"  value=<?php echo '"'.TXT_MODIF_MAIL.'"'; ?> onclick="hideThis('form1')" />	
		
					<!-- form1 et form2 sont des très mauvais id, faut trouver de meilleurs noms, plus clairs -->
					<form  id="form1" class="hide_first" action="" method="POST">		
						<label for="new_mail"><?php echo TXT_NOUVEAU_MAIL; ?></label>
						<input type="text" name="new_mail" required>  	
						<input type="submit" class="btn btn-primary"  name="set_new_mail_form" value=<?php echo '"'.TXT_CONFIRMER.'"'; ?>>	
					</form>	 
				</div>			
		
				<br>
				<div class="row">
					<?php  if (isset($msg_new_pswd)) { echo $msg_new_pswd."<br>";} ?> 
					<input type="button"  class="btn btn-primary"  value=<?php echo '"'.TXT_MODIF_MDP.'"'; ?> onclick="hideThis('form2')" />
		
					<form  id="form2" class="hide_first" action="" method="POST">
						<label for="previous_password"><?php echo TXT_MDP_ACTUEL; ?></label>
						<input type="password" name="previous_password" required><br>
						<label for="new_password"><?php echo TXT_NOUVEAU_MPD; ?></label>
						<input type="password" name="new_password" required><br>
						<label for="new_password_bis"><?php echo TXT_CONFIRME_MDP; ?></label>
						<input type="password" name="new_password_bis" required><br>
						<input type="submit" class="btn btn-primary"  name="set_new_password_form" value=<?php echo '"'.TXT_CONFIRMER.'"'; ?>>		
					</form>
				</div>	
				<br>
				<div class="row">
					<?php echo TXT_COTISATION.$_SESSION['user_logged']->getUserSubscriptionDate() ?>
				</div>
				<?php } ?>
			</div>
			<div class="col-xs-1"></div>
		</div>
		<?php include("include/footer.php"); ?> 
	
	</body>
</html>