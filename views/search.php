<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <link href="css/edito.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container">                      
            <!-- L'affichage de toutes les miniatures de la selection par odre chronologique -->
            <h1><?php echo TXT_SECTION_ALL;?></h1>  
            <?php ?>
            <div class="thumbnail">
                <a href="<?php $index ?>"><img src="/assets/thumbnails/OPENINGBOOK_001" height="150px" width="154px"></a>
            </div>
            <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
            <h1><?php echo TXT_SECTION_AUTHORS;?></h1> 
            <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
            <div class="row">
                <?php //for lettre in albahbet_array... 
                ?>
            </div>
            <?php ?>
            <div class="thumbnail">
                <a href="<?php //$author ?>"><img src="/assets/thumbnails/OPENINGBOOK_001" height="150px" width="154px"></a>
            </div>
            <!-- L'affichage de toutes les miniatures de la selection par collection -->
            
        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>