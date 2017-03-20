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
                        <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                            <img src="/assets/thumbnails/OPENINGBOOK_001" height="150px" width="154px">
                        </a>
                      <p><?php echo $book->getBookTitle(); ?></p>
                    </div>
                <?php } ?>
            </div>
            
            <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
            <h1><?php echo TXT_SECTION_AUTHORS; ?></h1>
            <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
            <div class="row artist_alphabet">
                <?php foreach (range('A', 'Z') as $letter) { 
                    //que ce soit un lien que s'il y a des auteurs pour cette lettre ?>
                    <div class="letter">
                        <a href="?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="row artist_retrieved">            
                <?php 
                    if ($sort_type === "artist_alphabetical") {
                        foreach ($thumbnail_content as $current_thumbnail) { ?>
                            <!-- On redirige vers le book -->
                            <div class="col-sm-4 col-md-3 col-lg-2 thumbnail">
                                <a href="<?php echo 'book_viewer.php?id='.$current_thumbnail["bookID"]; ?>">
                                    <img src="/assets/thumbnails/<?php echo $current_thumbnail["vignette_filename"]; ?>" height="150px" width="154px">
                                </a> 
                                <p><?php echo $current_thumbnail["authorName"]; ?></p>
                            </div>
                        <?php  }
                    } else {
                        //sort_type=default si tout va bien
                        foreach ($thumbnail_content as $current_thumbnail) { ?>
                            <!-- Cas où on redirige vers la page de l'artiste -->
                            <div class="col-sm-4 col-md-3 col-lg-2 thumbnail">
                                <a href="?author=<?php echo $current_thumbnail["authorID"]; ?>">
                                    <!-- DEVDV quand la vignette artiste sera prête
                                    <img src="/assets/thumbnails/<?php echo $thumbnail_content["vignette_filename"]; ?>" height="150px" width="154px"> -->
                                    <img src="/assets/thumbnails/OPENINGBOOKPHOTO_004" height="150px" width="154px">
                                </a>
                                <p><?php echo $current_thumbnail["authorName"]; ?></p>
                            </div>
                        <?php  }
                    } ?>
            </div>
            <!-- L'affichage de toutes les miniatures de la selection par collection -->
            <!-- L'affichage de toutes les miniatures de la selection par année -->
            
        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>