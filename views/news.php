<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <title>Opening</title>
        <!-- Import des fichiers spécifiques à cette page -->
        <!-- <link href="css/news.css" rel="stylesheet"> -->
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class="container">
            <div class="row">
                <h1 class="Section">
                    <?php echo TXT_SECTION_ACTUALITES; ?>
                </h1>
            </div>
            
        <?php   $g = file_get_contents('./actualite/actualite-'.$lang.'-g.txt');
                $d = file_get_contents('./actualite/actualite-'.$lang.'-d.txt');
            if (empty($g) && empty($d)) {echo TXT_ACTUALITES_VIDE ;}
            elseif (empty($g) || empty($d)) {
                if(!empty($g)) {echo '<div class="col-sm-12 col-md-12">'.'<PRE>' .$g. '</PRE>'.'</div>';}
                if(!empty($d)) {echo '<div class="col-sm-12 col-md-12">'.'<PRE>' .$d. '</PRE>'.'</div>';}
                                            }
            else {echo '<div class="col-sm-6 col-md-6">'.
                '<PRE>' .$g. '</PRE>'.'</div>'.
                
                '<div class="col-sm-6 col-md-6">'.
                '<PRE>' .$d. '</PRE>'.'</div>'
                
                ;} ?>             
        </div>

        <?php include("include/footer.php"); ?> 
    </body>
</html>