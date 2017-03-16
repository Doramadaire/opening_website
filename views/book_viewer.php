<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_ONGLET; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->	
		<!-- CSS -->
		<link rel="stylesheet" href="css/viewer.css">
		<link rel="stylesheet" href="css/main.css">
		
		 <!-- Scripts liseuse -->
        <script src="js/jquery.min.js"></script>
        <script src="js/main.js"></script>  
        <!-- Wowbook -->
        <script type="text/javascript" src="./wow_book/pdf.combined.min.js"></script>
        <script type="text/javascript" src="./wow_book/wow_book.min.js"></script>
        <link rel="stylesheet" href="./wow_book/wow_book.css" type="text/css" />
		
        <!-- Fichiers maison -->
        <link rel="stylesheet" href="css/book_viewer.css" type="text/css">	

        <script>
        $(function(){
            var bookOptions1 = {
                height   : 500,
                width    : 800,
                pageNumbers: false,
                
                centeredWhenClosed : true,
                toolbar : "lastLeft, left, right, lastRight, zoomin, zoomout, slideshow, fullscreen, thumbnails",
                lightbox: "#show_wowbook",
                thumbnailsPosition : 'left',                
                /*
                           
                hardcovers : true, 
                responsiveHandleWidth : 50,
                
                containerPadding: "20px",
                */
                // The pdf and your webpage must be on the same domain
                pdf: "resources/books/OPENINGBOOK_001.pdf"
            };
            // creates the book
            $('#wowbook1').wowBook(bookOptions1);
            var bookOptions2 = {
                height   : 1000,
                width    : 1200,
                pageNumbers: false,                
                centeredWhenClosed : true,
                container: true,
                gutterShadow: false,
                toolbar : "lastLeft, left, right, lastRight, zoomin, zoomout, slideshow, fullscreen, thumbnails",              
                pdf: "resources/books/OPENINGBOOK_002.pdf"
            };
            $('#wowbook2').wowBook(bookOptions2);
        })
    </script>	
	</head>
	<body oncontextmenu="return false">
	<?php include("include/header.php"); ?>

	<div class="container">
	   <div class="row">
		    <h1 class="Section">
			    Page de consultation des Opening book
		    </h1>		
		<?php if (!isset($_SESSION['user_logged'])) { ?> 
				<!-- 
				TO DO : prévoir fonction qui affiche erreur
				-->
				Attention, en tant que visiteur vous n'avez accès qu'à des extraits
		<?php } else {
					if ($user_logged->getUserStatus() >= 3) { ?>
						En tant qu'adhérent vous avez accès à l'ensemble des books<br>	
		<?php  		} else { ?>
						Attention, votre cotisation n'est pas à jour. Vous n'avez accès qu'à des extraits des books.
		<?php		}		
			} ?> 	
		</div>
		<div class="row"> 
            <div class="col-sm-2 col-md-3">
            </div>
            <div class="col-sm-8 col-md-6">	  
    		    <?php if (!isset($_SESSION['user_logged'])) { ?> 
    				<!-- TO DO : prévoir fonction qui affiche erreur -->
    		    <div class="docs-galley">          
                    <ul class="docs-pictures clearfix">
                        <li width='100%'><img data-original="resources/jpg/page_0000.jpg" src="resources/jpg/page_0000.jpg" alt="p1" width='100%'></li>
                        <li hidden><img data-original="resources/jpg/page1.jpg" src="resources/jpg/page1.jpg" alt="La légende de la page 1 qui est très très très très longue"></li>
                        <li hidden><img data-original="resources/jpg/page2.jpg" src="resources/jpg/page2.jpg" alt="p2"></li>
                        <li hidden><img data-original="resources/jpg/page3.jpg" src="resources/jpg/page3.jpg" alt="p3"></li>
                        <li hidden><img data-original="resources/jpg/page4.jpg" src="resources/jpg/page4.jpg" alt="p4"></li>        
                    </ul>
        	    </div>
                <br>
               <!-- FLIP EXTRAIT <div class="row fliphtml5">
                    <iframe title="opening-book" frameborder="0" type="text/html" width="700" height="700" src="http://online.fliphtml5.com/izscb/rgzc/" allowfullscreen="true" scroll="no" marginwidth="0" marginheight="0"></iframe>
                </div>         -->         
    		    <?php } else {
    				if ($user_logged->getUserStatus() >= 3) { ?>
    			<!-- DEVDEVDEV t'as le droit de foire le book complet si t'es loggé avec abonnement à jour, ou si t'es auteur et que c'est ton book, ou que t'es admin? -->
    		    <div class="docs-galley">             
                    <ul class="docs-pictures clearfix">
                        <li width='100%'><img data-original="resources/jpg/page_0000.jpg" src="resources/jpg/page_0000.jpg" alt="p1" width='100%'></li>
                        <li hidden><img data-original="resources/jpg/page1.jpg" src="resources/jpg/page1.jpg" alt="La légende de la page 1 qui est très très très très longue"></li>
                        <li hidden><img data-original="resources/jpg/page2.jpg" src="resources/jpg/page2.jpg" alt="p2"></li>
                        <li hidden><img data-original="resources/jpg/page3.jpg" src="resources/jpg/page3.jpg" alt="p3"></li>
                        <li hidden><img data-original="resources/jpg/page4.jpg" src="resources/jpg/page4.jpg" alt="p4"></li>
                    </ul>
        	    </div>
                <!-- FLIP COMPLET
                <br>
                <div class="row fliphtml5"> -->
                    <!-- BOOK1 : http://online.fliphtml5.com/obqs/yyip/ -->
                    <!-- BOOK2 : http://online.fliphtml5.com/zkoe/irhd/ -->
                    <!--
                    <iframe title="opening-book" frameborder="0" type="text/html" width="700" height="700" src="http://online.fliphtml5.com/obqs/yyip/" allowfullscreen="true" scroll="no" marginwidth="0" marginheight="0"></iframe>
                </div>    -->           	
    		<?php  		} else { ?>
    
    	        <div class="docs-galley">    
                    <ul class="docs-pictures clearfix">
                        <li width='100%'><img data-original="resources/jpg/page_0000.jpg" src="resources/jpg/page_0000.jpg" alt="p1" width='100%'></li>
                        <li hidden><img data-original="resources/jpg/page1.jpg" src="resources/jpg/page1.jpg" alt="La légende de la page 1 qui est très très très très longue"></li>
                        <li hidden><img data-original="resources/jpg/page2.jpg" src="resources/jpg/page2.jpg" alt="p2"></li>
                        <li hidden><img data-original="resources/jpg/page3.jpg" src="resources/jpg/page3.jpg" alt="p3"></li>
                        <li hidden><img data-original="resources/jpg/page4.jpg" src="resources/jpg/page4.jpg" alt="p4"></li>        
                    </ul>
            	</div>
    		<?php		}		
    			} ?> 	
    	    </div>	
    	</div>
        <!-- DEVEVDV mettre une marge en CSS plutot que un br? -->
        <!--
        <div class='wowbook_container'>
            <div id="wowbook"></div>
        </div>
         -->
        <img id="show_wowbook" src="resources/jpg/page_0000.jpg" height="600px" width="auto">
        <div id="wowbook1"></div> <!-- celui avec lightbox et les liens internes -->
        <div class='wowbook_container'>
            <div id="wowbook2"></div>
        </div>
        <div class="row">
            <div class="thumbnail">
                <h3>À propos</h3>
                <p>Du texte</p>
            </div>
        </div>
        <div class="row">
            <div class="thumbnail">
                <h3>L'auteur</h3>
                <a href="">En savoir plus</a>
            </div>
        </div>
        <div class="row">
            <div class="thumbnail">
                <h3>Les autres oeuvres de cet auteur</h3>
                <p>Du texte, ou autre?</p>
            </div>
        </div>
    </div>
	
    <!-- The Modal : boite de dialoge d'info de la liseuse -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">×</span>
        <p>La fenetre d'aide avec du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte</p>
      </div>
    </div>
	
    <br><br><br><br>
	<?php include("include/footer.php"); ?>

    <script src="js/viewer.js"></script>
           
	</body>
</html>