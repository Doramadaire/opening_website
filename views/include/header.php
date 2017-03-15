<div class="container-fluid">
  <div class="page-header">
    <div class="navbar-wrapper">     
      <!-- Le "nom" de la navbar, et l'allure du bouton sur mobile-->
      <nav class="navbar navbar-default">
        <!-- Les contenu de la navbar -->
        <!-- Brand and toggle get grouped for better mobile display -->    
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>  
		  
	 	      <a class="navbar-left" href="index.php"><img class="img-fluid" id="logo" alt="logo" src="resources/logo_cropped.png"></a>        
              
		    </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav-collapse">

          <ul class="nav navbar-nav">
            <li><a href="edito.php"><?php echo TXT_NAVBAR_A_PROPOS; ?> </a></li>
            <li><a href="#"><?php echo TXT_NAVBAR_ARTISTES; ?></a></li>
            <li><a href="contact.php"><?php echo TXT_NAVBAR_CONTACT; ?></a></li>
            <li><a href="join.php"><?php echo TXT_NAVBAR_ADHERER; ?></a></li>
          </ul>

         <ul class="nav navbar-nav navbar-right">
           <li><a href="https://www.facebook.com/opening-book-872866662728445/" target="_blank">Facebook</a></li>
           <li><a href="https://twitter.com/opening_asso" target="_blank" >Twitter</a></li>
           <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo TXT_NAVBAR_LANGUE; ?><span class="caret"></span></a>
             <ul class="dropdown-menu">
               <li><a href="?lang=fr">Fr</a></li>
               <li><a href="?lang=en">En</a></li>
             </ul>
           </li>
         </ul>
          
       </div><!-- /.navbar-collapse -->

      </nav>
    </div>
  </div>
</div>