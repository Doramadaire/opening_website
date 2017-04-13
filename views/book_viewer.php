<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
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

	<div class="container-fluid">
	    <div class="row">
            <div class="col-xs-1"></div>
		    <!-- <h1 class="Section">
			    Page de consultation des Opening book
		    </h1> -->
            <div class="col-xs-10">
                <div class="row text-intro">
            <?php if (!isset($_SESSION['user_logged'])) { ?> 
    				<!-- TO DO : prévoir fonction qui affiche erreur -->
    				Attention, en tant que visiteur vous n'avez accès qu'à des extraits
    		<?php } else {
    					if ($user_logged->getUserStatus() >= 3) { ?>
    						<!-- En tant qu'adhérent vous avez accès à l'ensemble des books<br> -->
                            <!-- DEVEVDV mettre une marge en CSS plutot que un br? -->
    		<?php  		} else { ?>
    						Attention, votre cotisation n'est pas à jour. Vous n'avez accès qu'à des extraits des books.
    		<?php		}		
    			} ?>
                    Veuillez cliquer sur la couverture pour démarrer la consultation de cet opening book
                </div>
                <div class="row">
                    <img id="show_wowbook" src="<?php echo $cover_filename; ?>" height="600px" width="616px">
                    <div id="wowbook"></div> <!-- celui avec lightbox et les liens internes -->
                </div>	
        
                <div class="row thumbnail">
                    <h3><?php echo $book->getBookTitle(); ?></h3>
                    <?php echo $description; ?>
                </div>
                <div class="row thumbnail author_cv">
                    <h3><?php echo $book_author->getAuthorName(); ?> est l'auteur(e) de ce book</h3>
                    <a href="<?php echo $cv_filename; ?>" target="_blank">Consulter son CV</a>
                </div>
                <!--<div class="row">
                    <div class="thumbnail">
                        <h3>Les autres oeuvres de cet auteur</h3>
                        <p>Du texte, ou autre?</p>
                    </div>
                </div> -->
            </div>
            <div class="col-xs-1"></div>
        </div>
    </div>

	<?php include("include/footer.php"); ?>
           
	</body>
</html>