<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <link href="css/catalogue.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container-fluid">                      
            <!-- L'affichage de 2 lignes de vignettes au hasard parmi tous les books -->
            <div class="row">
                <div class="col-sm-1"></div>
                <h1 class="col-12 col-sm-10"><?php echo TXT_SECTION_CATALOGUE_ALL;?></h1>
                <div class="col-sm-1"></div>
            </div>
            <!-- Pour les écrans larges, on met 2 lignes de 5 vignettes -->
            <div class="hide_first random_vignettes_large">       
                <div class="row">
                    <div class="col-md-1"></div>
                    <?php 
                        for ($i=0; $i < count($ten_rand_books); $i++) {
                            $book = $ten_rand_books[$i];
                            if ($i != 0 && $i % 5 == 0) { ?>
                                <!-- 1er élément d'une nouvelle ligne -->
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                            <?php } ?>
                            <div class="thumbnail col-md-2">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <img height="150" width="154" src="/assets/thumbnails/<?php echo $book->getBookFilename(); ?>">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <?php //on va afficher le ou les auteurs de ce livre
                                        $book_authors_ids = $book->getBookAuthors();
                                        echo "<p>".unserialize($sql->getAuthorByID($book_authors_ids[0]))->getAuthorName()."</p>";
                                        if (count($book_authors_ids) > 1) {
                                            foreach (array_slice($book_authors_ids, 1, count($book_authors_ids)-1) as $author_id) {
                                                echo "<p>".unserialize($sql->getAuthorByID($author_id))->getAuthorName()."</p>";
                                            }
                                        } ?>
                                </a>
                            </div>
                        <?php } ?>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <!-- Pour les écrans petits, on met 3 lignes de 3 vignettes -->
            <div class="random_vignettes_small">       
                <div class="row">
                    <div class="col-sm-1"></div>
                    <?php 
                        for ($i=0; $i < min(count($ten_rand_books), 9); $i++) {
                            $book = $ten_rand_books[$i];
                            if ($i != 0 && $i % 3 == 0 && $i != 9) { ?>
                                <!-- 1er élément d'une nouvelle ligne -->
                                    <div class="col-sm-1"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                            <?php } ?>
                            <div class="thumbnail col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <img height="150" width="154" src="/assets/thumbnails/OPENINGBOOK_001">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <?php //on va afficher le ou les auteurs de ce livre
                                        $book_authors_ids = $book->getBookAuthors();
                                        echo "<p>".TXT_BOOK_BY." ".unserialize($sql->getAuthorByID($book_authors_ids[0]))->getAuthorName()."</p>";
                                        if (count($book_authors_ids) > 1) {
                                            foreach (array_slice($book_authors_ids, 1, count($book_authors_ids)-1) as $author_id) {
                                                echo "<p>".TXT_BOOK_BY_AND." ". unserialize($sql->getAuthorByID($author_id))->getAuthorName()."</p>";
                                            }
                                        } ?>
                                </a>
                            </div>
                        <?php } ?>
                    <div class="col-sm-1"></div>
                </div>
            </div>

            <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
            <div class="row">
                <div class="col-sm-1"></div>
                <h1 class="col-12 col-sm-10"><?php echo TXT_SECTION_CATALOGUE_ARTISTS;?></h1>
                <div class="col-sm-1"></div>
            </div>
            <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
            <div class="row artist_alphabet">
                <?php foreach (range('A', 'Z') as $letter) { 
                    //que ce soit un lien que s'il y a des auteurs pour cette lettre ?>
                    <div class="letter">
                        <a href="?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
                    </div>
                <?php } ?>
            </div>
            <!-- On fait un affichage random en mosaique de 
            5x2 en grand
            3x3 en moyen
            ? en petit -->

            <div class="row artist_retrieved">
                <div class="col-sm-1"></div>
                <div class="col-12 col-sm-10"> 
                    <?php 
                        if ($sort_type === "artist_alphabetical") {
                            foreach ($retrieved_authors as $author) {
                                echo $author->toString();
                            }
                            foreach ($thumbnail_content as $current_thumbnail) { ?>
                                <!-- On redirige vers le book -->
                                <!-- <div class="col-xs-3 col-lg-2 thumbnail book_vignette"> -->
                                <div class="col-xs-4 col-sm-3 col-md-2 thumbnail book_vignette">
                                    <a href="<?php echo 'book_viewer.php?id='.$current_thumbnail["bookID"]; ?>">
                                        <img src="/assets/thumbnails/<?php echo $current_thumbnail["vignette_filename"]; ?>" height="150px" width="154px">
                                        <p>Titre book</p>
                                        <p><?php echo $current_thumbnail["authorName"]; ?></p>
                                    </a> 
                                </div>
                            <?php  }
                        } else {
                            //sort_type=default si tout va bien
                            foreach ($thumbnail_content as $current_thumbnail) { ?>
                                <!-- Cas où on redirige vers la page de l'artiste -->
                                <!-- <div class="col-xs-3 col-lg-2 thumbnail book_vignette"> -->
                                <div class="col-xs-4 col-sm-3 col-md-2 thumbnail book_vignette">
                                    <a href="?author=<?php echo $current_thumbnail["authorID"]; ?>">
                                        <!-- DEVDV quand la vignette artiste sera prête
                                        <img src="/assets/thumbnails/<?php echo $thumbnail_content["vignette_filename"]; ?>" height="150px" width="154px"> -->
                                        <img src="/assets/thumbnails/OPENINGBOOKPHOTO_004" height="150px" width="154px">
                                        <p>Titre book</p>
                                        <p><?php echo $current_thumbnail["authorName"]; ?></p>
                                    </a>     
                                </div>
                            <?php  }
                        } ?>
                </div>
                <div class="col-sm-1"></div>
            </div>

            <!-- L'affichage de toutes les miniatures de la selection par collection -->
            <!-- <h1><?php echo TXT_SECTION_CATALOGUE_COLLECTION; ?></h1> -->
            <!-- L'affichage de toutes les miniatures de la selection par année : on oublie -->
            
            <!-- bouton nouvelle recherche -->

        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>