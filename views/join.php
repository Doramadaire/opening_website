<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_JOIN; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_JOIN; ?>">
        <title><?php echo TXT_TAB_JOIN; ?></title>
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
<!--                     <div class="row subscription_form hidden-md hidden-lg">
                        <iframe id="haWidget" src="https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015/widget-vignette" style="width:350px;height:450px;border:none;"></iframe>
                    </div> -->
                    <!-- vignette pour web -->
<!--                     <div class="row subscription_form  hidden-sm hidden-xs ">
                        <iframe id="haWidget" src="https://www.helloasso.com/associations/opening/adhesions/adhesion-opening-2015/widget-vignette-horizontale" style="width:800px;height:400px;border:none;"></iframe>
                    </div> -->
                    <iframe id="haWidget" src="https://www.donnerenligne.fr/opening/faire-un-don/3" style="width:100%;height:750px;border:none;" onload="window.scroll(0, document.querySelector('iframe').offsetTop)"></iframe><div style="width:100%;text-align:center;">Propulsé par <a href="https://www.helloasso.com" rel="nofollow">HelloAsso</a></div>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>
    </body>
</html>
