<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_JOIN; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link href="css/join.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container-fluid row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <div class="row">
                    <h1><?php echo TXT_SECTION_ADHESION; ?></h1>
				</div>
				<div class="row">
					<?php echo TXT_ADHESION_TEXTE; ?>

					<!-- vignette pour mobile -->
					<div class="row subscription_form hidden-md hidden-lg">
						<iframe id="haWidget" src="https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015/widget-vignette" style="width:350px;height:450px;border:none;"></iframe>
					</div>
		
					<!-- vignette pour web -->
					<div class="row subscription_form  hidden-sm hidden-xs ">
						<iframe id="haWidget" src="https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015/widget-vignette-horizontale" style="width:800px;height:400px;border:none;"></iframe>
					</div>
				</div>
			</div>
			<div class="col-xs-1"></div>
		</div>

        <?php include("include/footer.php"); ?> 
    </body>
</html>