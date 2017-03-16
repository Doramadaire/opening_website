<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link href="css/join.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container">
            <div class="row">
                <h1 class="Section">
                    <?php echo TXT_SECTION_ADHESION; ?>
                </h1>
            </div>
            <?php echo TXT_ADHESION_TEXTE; ?>
        </div>

        <div class="row subscription_form">
            <iframe id="haWidget" src="https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015/widget" style="width:800px;height:1050px;border:none;">
        </div>

        <?php include("include/footer.php"); ?> 
    </body>
</html>