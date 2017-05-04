<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_CATALOGUE; ?></title>
        <link href="css/catalogue.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container-fluid">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <!-- DEVDEVDEV TODO : cacher les vignettes en fct de la largeur au delà de 2 ou 3 lignes -->

                <?php if ($sort_type === "artist_alphabetical") { ?>

                <div class="row artist_retrieved"> 
            <?php   if (empty($retrieved_authors)) { ?>
                    <div class="row">
                        <?php echo TXT_NO_AUTHOR_FOUND; ?>
                   </div>
                   <div class="row">
                   <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
            <?php   } else {
                        foreach ($thumbnail_content as $thumbnail_element) {
                            $book = $thumbnail_element['book'];
                            $authors = $thumbnail_element['authors'];
                            ?>
                            <!-- On redirige vers le book -->
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                    <?php   }
                        } ?>
                    </div>
                    <div class="row back_button">
                        <a href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                    </div>
                </div>
                <?php   } elseif ($sort_type === "artist_id") { ?>
                            <div class="row">
                                <h1><?php echo $artist->getAuthorName();?></h1>
                            </div>
                        <!-- Les vignettes des books de l'ariste demandée -->
                        <div class="row block-vignettes center-block">
                <?php   foreach ($artist_vignettes as $vignette) {
                            $book = $vignette['book'];
                            $authors = $vignette['authors'];
                            ?>
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <!-- DEVDV quand la vignette artiste sera prête -->
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                <?php  } ?>
                        </div>
                        <div class="row back_button">
                            <a href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                        </div>




                <?php   } elseif ($sort_type === "by_collection") { ?>
                            <div class="row">
                                <h1><?php echo $collection;?></h1>
                            </div>
                        <!-- Les vignettes de la collection demandée -->
                        <div class="row block-vignettes center-block">
                <?php   foreach ($my_collection_vignettes as $vignette) {
                            $book = $vignette['book'];
                            $authors = $vignette['authors'];
                            ?>
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <!-- DEVDV quand la vignette artiste sera prête -->
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                <?php  } ?>
                        </div>
                        <div class="row back_button">
                            <a href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                        </div>
                  <?php } else {
                        //sort_type=default si tout va bien ?>

                    <div class="row collection_section">
                        <div class="row">
                            <h1><?php echo TXT_SECTION_CATALOGUE_COLLECTION; ?></h1>
                        </div>
                <?php       for ($i=0; $i < count($collections_vignettes); $i++) {
                            //foreach ($collections_vignettes as $collection_vignette) {
                            $collection = $collections_vignettes[$i]['collection'];
                            $book = $collections_vignettes[$i]['book'];
                            $authors = $collections_vignettes[$i]['authors'];
                            ?>
                            <div class="thumbnail book_vignette search_collection_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'catalogue.php?collection='.urlencode($collection); ?>">                
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $collection; ?></p>
                                </a>
                            </div>
                <?php       } ?>
                    </div>

                    <div class="row artist_section">
                        <div class="row">
                            <h1><?php echo TXT_SECTION_CATALOGUE_ARTISTS; ?></h1>
                        </div>
                        <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
                        <div class="row artist_alphabet center-block">
                            <?php foreach (range('A', 'Z') as $letter) {
                                //que ce soit un lien que s'il y a des auteurs pour cette lettre ?>
                                <div class="letter<?php if(!in_array($letter, $possible_letters)) echo ' inactive-link'; ?>">
                                    <a href="?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row block-vignettes center-block">
                <?php   foreach ($thumbnail_content as $thumbnail_element) {
                            $book = $thumbnail_element['book'];
                            $authors = $thumbnail_element['authors'];
                            ?>
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
            <?php       } ?>
                        </div>
                    </div>

                        <!-- L'affichage de 2 lignes de vignettes au hasard parmi tous les books -->
                        <!--
                        <div class="row catalogue_random">
                            <div class="row">
                                <h1><?php echo TXT_SECTION_CATALOGUE_ALL;?></h1>
                            </div>
                            <div class="row block-vignettes">
                        <?php   foreach ($rand_books as $book) {
                                    $authors = array(); //un array contenant les objets auteurs du book
                                    foreach ($book->getBookAuthors() as $author_id) {
                                        $authors[] = unserialize($sql->getAuthorByID($author_id));
                                    }
                                    ?>
                                    <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                        <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                            <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename(); ?>" height="150px" width="154px">
                                            <p><?php echo $book->getBookTitle(); ?></p>
                                            <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                        </a>
                                    </div>
                        <?php  } ?>
                            </div>
                        </div> -->

            <?php   } ?>
            </div>
            <div class="col-xs-1"></div>

            <!-- le début du bordel
            <!-- Pour les écrans larges, on met 2 lignes de 5 vignettes
            <div class="row hide_first random_vignettes_large">       
                    <div class="col-md-1"></div>
                    <?php 
                        for ($i=0; $i < count($ten_rand_books); $i++) {
                            $book = $ten_rand_books[$i];
                            if ($i != 0 && $i % 5 == 0) { ?>
                                <!-- 1er élément d'une nouvelle ligne DEVDEV du bordel a commenter?
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
            <!-- Pour les écrans petits, on met 3 lignes de 3 vignettes 
            DEVDEV du bordel a commenter?
            <div class="random_vignettes_small">       
                <div class="row">
                    <div class="col-sm-1"></div>
                    <?php 
                        for ($i=0; $i < min(count($ten_rand_books), 9); $i++) {
                            $book = $ten_rand_books[$i];
                            if ($i != 0 && $i % 3 == 0 && $i != 9) { ?>
                                <!-- 1er élément d'une nouvelle ligne 
                                DEVDEV du bordel a commenter?
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
            fin bordel -->

            <!-- L'affichage de toutes les miniatures de la selection par année : on oublie -->
        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>