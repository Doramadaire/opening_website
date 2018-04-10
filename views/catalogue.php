<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_CATALOGUE; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_CATALOGUE; ?>">
        <title><?php echo TXT_TAB_CATALOGUE; ?></title>
        <link href="css/catalogue.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?>
        <div class="container-fluid">
            <?php if ($sort_type === "letter") { ?>
                <div class="row artist_retrieved"> 
                <?php if (empty($retrieved_authors)) { ?>
                    <div class="row">
                        <?php echo TXT_NO_AUTHOR_FOUND; ?>
                        <br>
                   </div>
                <?php } else {
                        foreach ($thumbnail_content as $thumbnail_element) {
                            $book = $thumbnail_element['book'];
                            $authors = $thumbnail_element['authors'];
                            $book_name = $book->getBookFilename().'.jpg'; ?>
                            <!-- L'affichage de toutes les miniatures de la selection par artiste -->
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book_name; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                        <?php }
                    } ?>
                    <div class="row back_button">
                        <a class="btn btn-primary" href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                    </div>
                </div>
                <?php } elseif ($sort_type === "artist_id") { // pas utilisé mais fonctionnel ?>
                            <div class="row">
                                <h3><?php echo $artist->getAuthorName();?></h3>
                            </div>
                        <!-- Les vignettes des books de l'ariste demandée -->
                        <div class="row block-vignettes center-block">
                <?php   foreach ($artist_vignettes as $vignette) {
                            $book = $vignette['book'];
                            $authors = $vignette['authors']; ?>
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <!-- DEVDV quand la vignette artiste sera prête -->
                                    <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename().'.jpg'; ?>" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                <?php } ?>
                        </div>
                        <div class="row back_button">
                            <a class="btn btn-primary" href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                        </div>
                <?php } elseif ($sort_type === "by_collection") { ?>
                            <div class="row">
                                <h3><?php echo $collection;?></h3>
                            </div>
                        <!-- Les vignettes de la collection demandée -->
                        <div class="row block-vignettes center-block">
                <?php foreach ($my_collection_vignettes as $vignette) {
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
                <?php } ?>
                        </div>
                        <div class="row back_button">
                            <a class="btn btn-primary" href="catalogue.php"><?php echo TXT_BUTTON_BACK; ?></a>
                        </div>
                  <?php } else {  //sort_type=default si tout va bien ?>
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
                <?php } ?>
                        </div>
                    </div>
            <?php } ?>
                        <!-- L'affichage de 2 lignes de vignettes au hasard parmi tous les books -->
                <!--    <div class="row catalogue_random">
                            <div class="row">
                                <h1><?php echo TXT_SECTION_CATALOGUE_ALL;?></h1>
                            </div>
                            <div class="row block-vignettes">
                        <?php   foreach ($rand_books as $book) {
                                    $authors = array(); //un array contenant les objets auteurs du book
                                    foreach ($book->getBookAuthors() as $author_id) {
                                        $authors[] = unserialize($sql->getAuthorByID($author_id));
                                    } ?>
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
            <!-- L'affichage de toutes les miniatures de la selection par année : on oublie -->
        </div>
    </body>
</html>