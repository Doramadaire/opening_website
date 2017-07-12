<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_ABOUT; ?></title>
        <!-- <link href="css/about.css" rel="stylesheet"> -->
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container-fluid row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <div class="row">
                    <h1><?php echo TXT_SECTION_EDITO; ?></h1>
                </div>
                <div class="row">
                    <?php echo TXT_EDITO_TEXTE; ?>
                    <p>Artiste? Participez à l'aventure Opening book !</p>
                    <form method="POST">
                        <input type="submit" class="btn btn-primary" name="dl_call_application" value="Télécharger l'appel à candidature">
                    </form>
                </div>
            </div>            
            <div class="col-xs-1"></div>
        </div>        
    </body>
</html>