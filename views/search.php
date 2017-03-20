<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <link href="css/search.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container">                      
            <!-- L'affichage de toutes les miniatures de la selection par odre chronologique -->
            <h1><?php echo TXT_SECTION_ALL;?></h1>
            <div class="row">
                <?php foreach ($all_books as $book) { ?>
                    <div class="col-sm-4 col-md-3 col-lg-2 thumbnail">
                      <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>"><img src="/assets/thumbnails/OPENINGBOOK_001" height="150px" width="154px"></a>
                      <!-- DEVDEV mettre adresse lien thumbnail dynamique -->
                      <p><?php echo $book->getBookTitle(); ?></p>
                    </div>
                <?php }?>
            </div>
            
            <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
            <h1><?php echo TXT_SECTION_AUTHORS;?></h1> 
            <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
            <div class="row artist_alphabet">
                <?php foreach (range('A', 'Z') as $letter) { 
                    //que ce soit un lien que s'il y a des auteurs pour cette lettre ?>
                    <div class="letter">
                        <?php echo "<a href='?sort=author_alphabetical&letter=$letter'>$letter</a>"; ?>
                    </div>
                <?php } ?>
          </div>
            <div class="row artist_retrieved">
                <?php //for lettre in albahbet_array... 
                ?>
            </div>
            <?php ?>
            <div class="col-sm-4 col-md-3 col-lg-2 thumbnail">
                <div class="letter">
                    <a href="<?php //$author ?>"><img src="/assets/thumbnails/OPENINGBOOK_001" height="150px" width="154px"></a>
                    <!-- <p><?php echo $book->getBookAuthor(); ?></p> -->
                </div>
            </div>
            <!-- L'affichage de toutes les miniatures de la selection par collection -->
            <!-- L'affichage de toutes les miniatures de la selection par année -->
            
        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>