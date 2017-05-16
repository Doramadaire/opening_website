<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <title><?php echo TXT_TAB_NEWS; ?></title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link href="css/news.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container-fluid row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <div class="row">
                    <h1 class="title"><?php echo TXT_SECTION_ACTUALITES; ?></h1>
                </div>
            
            <?php   
                    /*$g = file_get_contents('./actualite/actualite-'.$lang.'-g.txt');
                    $d = file_get_contents('./actualite/actualite-'.$lang.'-d.txt');
                if (empty($g) && empty($d)) {
                    echo TXT_ACTUALITES_VIDE ;
                } elseif (empty($g) || empty($d)) {
                    if(!empty($g)) {echo '<div class="col-sm-12 col-md-12">'.'<PRE>' .$g. '</PRE>'.'</div>';}
                    if(!empty($d)) {echo '<div class="col-sm-12 col-md-12">'.'<PRE>' .$d. '</PRE>'.'</div>';}
                } else {
                    echo '<div class="col-sm-6 col-md-6">'.
                    '<PRE>' .$g. '</PRE>'.'</div>'.                    
                    '<div class="col-sm-6 col-md-6">'.
                    '<PRE>' .$d. '</PRE>'.'</div>';
                    
                } */?>
                <div class="row thumbnail">
                    <h3>A paraître prochainement</h3>
                    <p>
                    Opening book photo 006 / Brigitte Bauer<br>
                    Opening book photo 007 / Emmanuelle Germain<br>
                    <br>
                    Opening book 006 / Aldric Mathieu<br>
                    Opening book 007 / Joséphine de Saint Seine
                    </p>
                </div>
                <div class="row thumbnail">
                    <h3>Actualités des artistes</h3>
                    <i>Mai</i>
                    <p>
                    <b>Emmanuelle Sarrouy</b> présente <i>PERSIKOV</i>(… le chemin des fleurs)
                    30 avril 2017 de 11h à 19h dans le cadre des Dimanche de la Canebière, Espace POC
                    <br>cours Joseph Thierry, Marseille
                    </p>
                    <p>
                    <b>Aldric Mathieu</b>, exposition collective <i>« Sur fond blanc »</i> 
                    du 7 avril au 28 mai 2017, Centre d'Art Langage Plus, Alma, Québec
                    </p>
                    <p>
                    Exposition <b>Isabelle Schneider</b> du 18 mai au 3 juin Casa Consolat Marseille
                    <br>vernissage 18mai 18h30</p>

                    <p>
                    Exposition <b>Emmanuelle Germain</b> du 30 mai au 10 juin à la Galerie Charivari 7 rue Fontange, Marseille
                    <br>vernissage jeudi 1 juin
                    </p>

                    <i>Juin</i>
                    <p>
                    Exposition <b>Joséphine de Saint-Seine</b> à L’autoportrait, 66 rue des Trois Frères Barthélémy, Marseille
                    <br>vernissage vendredi 2 juin 2017
                    </p>
                </div>
                <div class="row thumbnail">
                    <h3>A noter</h3>
                    <p>
                    Opening book participera à Paréidolie, salon international du dessin contemporain, espace édition 27-29 Août, bd Boisson, Marseille<br>
                    Parution d’un book hors-série avec <b>Anne-Valérie Gasc</b>, artiste invitée de cette 4e édition. 
                    </p>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>
    </body>
</html>