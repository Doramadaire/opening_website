<html>
	<head>
	<meta charset="UTF-8">
		<title>
			Opening 
		</title>
		<!-- CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">		
		<link rel="stylesheet" href="css/viewer.css">
		<link rel="stylesheet" href="css/main.css">
        <!-- Fichiers maison -->
        <link rel="stylesheet" href="css/book_viewer.css" type="text/css">
		<link href="css/global.css" rel="stylesheet">
		
        <!-- JS -->
        <!-- Fichiers maison -->
        <script src="js/global.js"></script>
		
	</head>
	<body oncontextmenu="return false">
	<?php include("header.php"); ?>

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
    		    <?php } else {
    				if ($user_logged->getUserStatus() >= 3) { ?>
    					
    		    <div class="docs-galley">          
                    <ul class="docs-pictures clearfix">
                        <li width='100%'><img data-original="resources/jpg/page_0000.jpg" src="resources/jpg/page_0000.jpg" alt="p1" width='100%'></li>
                        <li hidden><img data-original="resources/jpg/page1.jpg" src="resources/jpg/page1.jpg" alt="La légende de la page 1 qui est très très très très longue"></li>
                        <li hidden><img data-original="resources/jpg/page2.jpg" src="resources/jpg/page2.jpg" alt="p2"></li>
                        <li hidden><img data-original="resources/jpg/page3.jpg" src="resources/jpg/page3.jpg" alt="p3"></li>
                        <li hidden><img data-original="resources/jpg/page4.jpg" src="resources/jpg/page4.jpg" alt="p4"></li>
                    </ul>
        	    </div>				
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
        <br>
        <div class="row">
            <div class="thumbnail">
                <h3>À propos de l'auteur</h3>
                <p>Du texte</p>
            </div>
        </div>
        <div class="row">
            <div class="thumbnail">
                <h3>Les actualités de l'auteur</h3>
                <p>Du texte</p>

            </div>
        </div>
        <div class="row">
            <div class="thumbnail">
                <h3>Les autres oeuvres de cet auteur</h3>
                <p>Du texte, ou autre?</p>
            </div>
        </div>
    </div>

	
<!-- DEVDEVDEV : c'est quoi ce truc modal qui apparait pas? -->
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">×</span>
    <p>La fenetre d'aide avec du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte,du texte</p>
  </div>
</div>
	
<br><br><br><br>
	<?php include("footer.php"); ?> 	

    <!-- Scripts liseuse -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/viewer.js"></script>
    <script src="js/main.js"></script>
	</body>
</html>