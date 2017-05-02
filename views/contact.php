<!DOCTYPE html>
<html>
	<head>
		<?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_CONTACT; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
		<link href="css/contact.css" rel="stylesheet">
	</head>  
	<body>
		<?php include("include/header.php"); ?> 
   		<div class="container-fluid row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <div class="row">
                    <h1><?php echo TXT_SECTION_CONTACT; ?></h1>
				</div>
			
				<div class="row">
					<?php echo TXT_CONTACT_TEXTE; ?>
				</div>
			</div>
            <div class="col-xs-1"></div>
        </div>
		<?php include("include/footer.php"); ?> 
	</body>    
</html>