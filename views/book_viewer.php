<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_BOOK_VIEWER; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->	      

        <!-- jQuery est déjà inclus pour bootstrap <script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script> -->
        <!-- Wowbook -->
        <script type="text/javascript" src="./wow_book/pdf.combined.min.js"></script>
        <script type="text/javascript" src="./wow_book/wow_book.min.js"></script>
        <link rel="stylesheet" href="./wow_book/wow_book.css" type="text/css" />
        <!-- Fichiers maison -->
        <link rel="stylesheet" href="css/book_viewer.css" type="text/css">
        <script>
        $(function(){
            //var PreviousButtonWidth = document.getElementById('before-fixed-button').offsetWidth;
            //var fixedButtonWidth = document.getElementById('fixed-button').offsetWidth;
            var fixedButtonWidth = document.getElementById('fixed-button').style.width;
            document.getElementById('pull-right-box').style.width = fixedButtonWidth;

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
			opacity 0;		auparavant : opacity 0.2;*/		
        })
        </script>	
	</head>
	<body oncontextmenu="return false" >
	   <?php include("include/header.php"); ?>

	   <div class="container-fluid row">
            <div class="col-xs-1"></div>
	        <!-- <h1 class="Section">
	   	       Page de consultation des Opening book
	        </h1> -->
            <div class="col-xs-10">
                <div class="row text-intro">
            <?php   if (!isset($_SESSION['user_logged'])) {
                        if (!isset($privileged_access_granted)) {
                            echo TXT_VISITOR;
                        }
                    } else {
        				if (!$user_logged->getUserStatus() >= 3) {
                            echo TXT_USER_SUBSCRIPTION_EXPIRED;
        					//En tant qu'adhérent vous avez accès à l'ensemble des books<br> -->
                            //DEVEVDV mettre une marge en CSS plutot que un br? -->
                        }
                    }
                    echo TXT_BOOK_VIEWER_EXPLANATION; ?>
                </div>
                <div class="row">
                    <img id="show_wowbook" src="<?php echo $cover_filename; ?>" height="600px" width="616px">
                    <div id="wowbook"></div> <!-- celui avec lightbox et les liens internes -->
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
                <!--<div class="row">
                    <div class="thumbnail">
                        <h3>Les autres oeuvres de cet auteur</h3>
                        <p>Du texte, ou autre?</p>
                    </div>
                </div> -->
                <div class="row back-to-catalogue-links">
                    <div id="positioner-box">
                        <a id="before-fixed-button" class="btn btn-primary" href="catalogue.php"><?php echo TXT_BACK_TO_CATALOGUE; ?></a>
                    </div>
            <?php //foreach ($book->getBookAuthors() as $artist_id) {echo "<br><a class='btn btn-primary' href='catalogue.php?artist_id=$artist_id'>".TXT_BACK_TO_ARTIST_BOOKS.unserialize($sql->getAuthorByID($artist_id))->getAuthorName()    ."</a>"; } ?>
                    <br><div id="pull-right-box">
                        <a id="fixed-button" class="btn btn-primary" href="catalogue.php?collection=<?php echo urlencode($book->getBookCollection()); ?>"><?php echo TXT_BACK_TO_COLLECTION_BOOKS.$book->getBookCollection(); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>           
	</body>
</html>