<?php
// CHANGER LE ERROR DANS LE GET. ON TRANSMET DES INFOS SANS QUE L'UTILISATEUR PENSE QUE CA MARCHE PAS 
session_start();
$logout=isset($_GET['logout']) ? $_GET['logout'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';
$login = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : '';
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Opening-book">
  <meta name="keywords" content="art, paintings, art book, book, gallery">
  <title>Opening-book - Accueil</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/viewer.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!-- Header -->
  <header class="navbar navbar-static-top docs-header" id="top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-target="#navbar-collapse" data-toggle="collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="accueil.html">Accueil</a>
      </div>
      <nav class="collapse navbar-collapse" id="navbar-collapse" role="navigation">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://opening-book.com/">Site</a></li>
          <li><a href="https://www.facebook.com/pages/Opening-Book/872866662728445?ref=hl">Facebook</a></li>
          <li><a href="./">Autres liens</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Jumbotron -->
  <div class="jumbotron docs-jumbotron">
    <div class="container">
      <img src="../img/opening-book-logo-web001.jpg"></li>
      <p class="lead">Une approche directe des oeuvres</p>
    </div>
  </div>

  <!-- Content -->

 <?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {  
  echo  'Vous n\'êtes pas connecté <br />
        Le site n\'est pas encore relié a une base de données <br />
        Se connecter
        <form action="index.php" method="POST">
          <input type="text" name="login" placeholder="votre login"> <br />
          <input type="password" name="password" placeholder="votre mot de passe">  
          <input type="submit" value="Se connecter">    
        </form>';
  } else {
  echo "Vous êtes connecté en tant que $login";
  echo '<form action="index.php" method="POST">
          <input type="submit" value="Se deconnecter">
        </form>';
    }

  // QUAND ON EST LOGGED, LES ERRORS DU GET NE DECLENCHENT RIEN
  switch($error) {
      case 1:
      echo "pas de login";
      break;
       
      case 2:
      echo " $password est un mauvais mot de passe";
      break;
      
      case 3:
      echo "vous n'avez pas entré de mot de passe";
      break;
      
      case 4:
      echo "vous n'êtes pas connecté";
      break;  
  }
?>
   
  <!-- loggin -->  
  
  <div class="container">
    <h1 class="page-header">Liste des books</h1>
    <div class="row">
      <div class="col-sm-4 col-md-3">
        <h3 class="page-header">Un auteur</h3>
		<ul>		
		<?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
		echo '<li><a href="images2.html">Un extrait</a></li> ';
		}
		else { echo '<li><a href="images.html">Un book</a></li> '; 
		}
		?>		
		</ul>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="docs-footer">
    <div class="container">
      <p class="heart"></p>
    </div>
  </footer>

</body>
</html>
