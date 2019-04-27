<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_BOOK_VIEWER; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_BOOK_VIEWER; ?>">
        <title><?php echo TXT_TAB_BOOK_VIEWER; ?></title>
        <!-- Wowbook -->
        <script type="text/javascript" src="./wow_book/pdf.combined.min.js"></script>
        <script type="text/javascript" src="./wow_book/wow_book.min.js"></script>
        <link rel="stylesheet" href="./wow_book/wow_book.css" type="text/css" />
        <!-- Fichiers maison -->
        <link rel="stylesheet" href="css/book_viewer.css" type="text/css">
        <script>
        $(function(){
            // var fixedButtonWidth = document.getElementById('fixed-button').style.width;
            // document.getElementById('pull-right-box').style.width = fixedButtonWidth;

            var bookOptions = {
                height   : 500,
                width    : 800,
                pageNumbers: false,
                centeredWhenClosed : true,
                toolbar : "lastLeft, left, right, lastRight, zoomin, zoomout, slideshow, fullscreen, thumbnails",
                lightbox: "#show_wowbook",
                thumbnailsPosition : 'left',
                gutterShadow: false,     
                flipSound: 0,
                slideShowDelay: 3000,
                // The pdf and your webpage must be on the same domain
                pdf: <?php echo "'$book_pdf_path'"; ?>
            };
            // creates the book
            $('#wowbook').wowBook(bookOptions);
            /*
            Pour augmenter la taille du bouton pour fermer la liseuse
            .wowbook-lightbox > .wowbook-close{
            height: 2.3em;
            width: 2.3em;

            Les 2 valeurs étaient à 1.5em auparavant.

            Pour enlever la coloration jaune au passage sur un lien interne du book
            .wowbook-pdf .linkAnnotation > a:hover {
            opacity 0;      auparavant : opacity 0.2;*/
        })
        </script>
    </head>
    <body oncontextmenu="return false" >
        <?php include("include/header.php"); ?>
        <div class="container-fluid row">
                <div class="row text-intro">
                    <?php echo TXT_BOOK_VIEWER_EXPLANATION; ?>
                </div>
                <div class="row">
                    <img id="show_wowbook" src="<?php echo $cover_filename; ?>">
                    <div id="wowbook"></div><!-- celui avec lightbox et les liens internes -->
                </div>
                <div class="row thumbnail">
                    <h3><?php echo $book->getBookTitle(); ?></h3>
                    <p><?php echo $book_description; ?></p>
                </div>
                <div class="row thumbnail author_cv">
                    <h3><?php echo $book_author->getAuthorName(); ?></h3>
                    <p><?php echo $artist_description; ?></p>
                    <?php if (isset($cv_link)) { ?>
                        <p><a href="<?php echo $cv_link; ?>" target="_blank"><?php echo TXT_ARTIST_CV; ?></a></p>
                    <?php } ?>
                </div>
                <!-- Les autres oeuvres de cet auteur ? -->
                <!-- Bouton retour catalogue à cet auteur ? à cette collection ? -->
                <a class="btn btn-primary" href="catalogue.php"><?php echo TXT_BACK_TO_CATALOGUE; ?></a>
                <!-- Version initiale pas beau
                <div class="row back-to-catalogue-links">
                    <div id="positioner-box">
                        <a id="before-fixed-button" class="btn btn-primary" href="catalogue.php"><?php echo TXT_BACK_TO_CATALOGUE; ?></a>
                    </div>
                    <br>
                    <div id="pull-right-box">
                        <a id="fixed-button" class="btn btn-primary" href="catalogue.php?collection=<?php echo urlencode($book->getBookCollection()); ?>"><?php echo TXT_BACK_TO_COLLECTION_BOOKS.$book->getBookCollection(); ?></a>
                    </div>
                </div> -->
        </div>
    </body>
</html>
