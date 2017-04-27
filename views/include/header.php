<div class="container-fluid">
  <div class="page-header">
    <div class="navbar-wrapper">     
      <!-- Le "nom" de la navbar, et l'allure du bouton sur mobile-->
      <nav class="navbar navbar-default">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Le logo -->  		  
	 	      <a class="navbar-left" href="index.php"><img class="img-fluid" id="logo" alt="logo" src="assets/logo.png"></a>        
        </div>

        <!-- Les éléments de la navbar à gauche-->
        <div class="collapse navbar-collapse" id="nav-collapse">
          <ul class="nav navbar-nav">            			
            <!-- Les premiers éléments -->
            <li><a href="catalogue.php"><?php echo TXT_NAVBAR_CATALOGUE; ?></a></li>            
            <li><a href="news.php"><?php echo TXT_NAVBAR_NEWS; ?></a></li>
            <li><a href="about.php"><?php echo TXT_NAVBAR_A_PROPOS; ?></a></li>
            <li><a href="join.php"><?php echo TXT_NAVBAR_ADHERER; ?></a></li>
            <li><a href="contact.php"><?php echo TXT_NAVBAR_CONTACT; ?></a></li>
            <!-- Le dernier élément est dynamique -->
            <?php if ($user_logged) { ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo TXT_MENU ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!-- les actions possibles en fonction du status si on est connecté -->              
                  <?php switch($_SESSION['user_logged']->getUserStatus()) {
                    case 2: ?>
                        <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>
                        <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>
                        <li><a href="index.php?logout=true"><?php echo TXT_NAVBAR_DISCONNECT; ?></a></li>
                        <?php break;
                
                    case 3: ?>
                        <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>
                        <li><a href="index.php?logout=true"><?php echo TXT_NAVBAR_DISCONNECT; ?></a></li>
                        <?php break; 
                
                    case 4: ?>
                        <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>
                        <li><a href="book_management.php"><?php echo TXT_MENU_OEUVRES; ?></a></li>
                        <li><a href="index.php?logout=true"><?php echo TXT_NAVBAR_DISCONNECT; ?></a></li>
                        <?php break; 
                        
                    case 5: ?>
                        <li><a href="user_settings.php"><?php echo TXT_MENU_COMPTE; ?></a></li>                          
                        <li><a href="book_management.php"><?php echo TXT_MENU_OEUVRES_ADMIN; ?></a></li>
                        <li><a href="admin.php"><?php echo TXT_MENU_ADMIN_PAGE; ?></a></li>
                        <li><a href="index.php?logout=true"><?php echo TXT_NAVBAR_DISCONNECT; ?></a></li>
                        <?php break; 
                  } ?>
                </ul>
              </li>     
            <?php } else { 
              //se connecter si on l'est pas ?> 
              <li><a href="index.php#logging-form"><?php echo TXT_BOUTON_SE_CONNECTER; ?></a></li>         
              <?php } ?>  
          </ul>

          <!-- Les éléments de droite de la navbar -->
          <ul class="nav navbar-nav navbar-right">
            <li><a class="social" href="https://www.facebook.com/opening-book-872866662728445/" target="_blank">
              <img  src="assets/facebook.jpg" width="25" height="25">
            </a></li>
		        <li><a class="social" href="https://twitter.com/opening_asso" target="_blank">
              <img src="assets/twitter.png" width="25" height="25">
            </a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo TXT_NAVBAR_LANGUE; ?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?lang=fr">Fr</a></li>
                <li><a href="?lang=en">En</a></li>
                <!-- Remove comment of available languages
                Remove also comments of corresponding language in function setLanguage in file classes/useful_functions.php and comment -->
                <!-- <li><a href="?lang=de">De</a></li> -->
                <!-- <li><a href="?lang=es">Es</a></li> -->
                <!-- <li><a href="?lang=it">It</a></li> -->
              </ul>
            </li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </nav>
    </div>
  </div>
</div>