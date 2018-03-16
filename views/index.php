<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_INDEX; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_INDEX; ?>">
        <title><?php echo TXT_TAB_INDEX; ?></title>
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <?php include("include/header.php"); ?>
        <div class="container-fluid row">
            <div class="page-content">
                <div class="margin-wrapper">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                            <li data-target="#carousel" data-slide-to="3"></li>
                            <li data-target="#carousel" data-slide-to="4"></li>
                            <li data-target="#carousel" data-slide-to="5"></li>
                            <li data-target="#carousel" data-slide-to="6"></li>
                            <li data-target="#carousel" data-slide-to="7"></li>
                            <li data-target="#carousel" data-slide-to="8"></li>
                            <li data-target="#carousel" data-slide-to="9"></li>
                            <li data-target="#carousel" data-slide-to="10"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="assets/diapo/001-titre.jpg" alt="Artistes" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/002-annonce.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/002-AM.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/002-annonce.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/005-SD.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/006JDSS.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/007-BB.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/002-annonce.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/008-YT.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/009-OR.jpg" width="1170" height="445">
                            </div>
                            <div class="item">
                                <img src="assets/diapo/0010-DP1.jpg" width="1170" height="445">
                            </div>
                        </div>
                        <?php // <!-- Left and right controls --> ?>
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="row blocks-parent">
                    <div class="col-sm-4 thumbnail">
                        <h3><?php echo TXT_INDEX_BLOC1_TITLE; ?></h3>
                        <p><?php echo TXT_INDEX_BLOC1_PARAGRAPH; ?></p>
                        <a href="news.php" class="btn btn-primary"><?php echo TXT_INDEX_BLOC1_BUTTON; ?></a>
                    </div>
                    <div class="col-sm-4 thumbnail">
                        <h3><?php echo TXT_H3_SECTION_RECHERCHE; ?></h3>
                        <p><?php echo TXT_P_RECHERCHE; ?></p>
                        <?php if ($user_logged) { ?>
                        <a href="catalogue.php" class="btn btn-primary"><?php echo TXT_BOUTON_LOGGED_COLLECTION; ?></a>
                        <?php } else { ?>
                        <a href="catalogue.php" class="btn btn-primary"><?php echo TXT_BOUTON_VISITOR_COLLECTION; ?></a>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4 thumbnail">
                        <h3><?php echo TXT_H3_SECTION_ADHERER; ?></h3>
                        <p><?php echo TXT_P_ADHERER; ?></p>
                        <a href="join.php" class="btn btn-primary"><?php echo TXT_BOUTON_ADHERER; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
