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
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <h1><?php //echo TXT_SECTION_CATALOGUE_ALL;?></h1>
                <!-- bon y a le titre mais pas la section... -->
                <!-- DEVDEV : mettre les lignes aléatoires dans la div et dans le if -->
                <!-- L'affichage de toutes les miniatures de la selection par auteurs -->
                <div class="row artist_section">
                    <div class="row">
                        <h1><?php echo TXT_SECTION_CATALOGUE_ARTISTS;?></h1>
                    </div>
                    <!-- L'alphabet avec chaque lettre cliquable si y a un auteur -->
                    <div class="row artist_alphabet">
                        <div></div>
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
                    <?php if ($sort_type === "artist_alphabetical") {
                        if (empty($retrieved_authors)) {
                            echo "Aucun auteur trouvé";
                        } else {
                            foreach ($retrieved_authors as $author) {
                                echo $author->toString().'<br>ON EST DANS artist_alphabetical';
                            }
                            foreach ($thumbnail_content as $thumbnail_element) {
                                $book = $thumbnail_element['book'];
                                $authors = $thumbnail_element['authors'];
                                ?>
                                <!-- On redirige vers le book -->
                                <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                    <a href="<?php echo 'book_viewer.php?id='.$book->getBookID(); ?>">
                                        <img class="img-responsive" src="/assets/thumbnails/<?php echo $book->getBookFilename(); ?>" height="150px" width="154px">
                                        <p><?php echo $book->getBookTitle(); ?></p>
                                        <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                    </a>
                                </div>
                    <?php   }
                        } ?>
                        <a href="catalogue.php">Retour aux collections</a>
                <?php   } else {
                        //sort_type=default si tout va bien
                        foreach ($thumbnail_content as $thumbnail_element) { 
                            $book = $thumbnail_element['book'];
                            $authors = $thumbnail_element['authors'];
                            ?>
                            <!-- Cas où on redirige vers la page de l'artiste -->
                            <div class="thumbnail book_vignette center-block col-xs-4 col-sm-3">
                                <a href="<?php 'book_viewer.php?id='.$book->getBookID(); ?>">
                                    <!-- DEVDV quand la vignette artiste sera prête -->
                                    <img class="img-responsive" src="/assets/thumbnails/OPENINGBOOKPHOTO_004" height="150px" width="154px">
                                    <p><?php echo $book->getBookTitle(); ?></p>
                                    <p><?php foreach ($authors as $author) {echo $author->getAuthorName().'<br>'; } ?></p>
                                </a>
                            </div>
                        <?php  }
                    } ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-1"></div>

            <!-- Pour les écrans larges, on met 2 lignes de 5 vignettes -->
            <!-- DEVDEV : mettre les lignes aléatoires dans la div et dans le if -->
            <!-- le début du bordel
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

            <!-- L'affichage de toutes les miniatures de la selection par collection -->
            <!-- <h1><?php echo TXT_SECTION_CATALOGUE_COLLECTION; ?></h1> -->
            <!-- L'affichage de toutes les miniatures de la selection par année : on oublie -->
            
            <!-- bouton nouvelle recherche -->

        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>