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
                            <?php for ($i=1; $i < count($carousel_imgs) + 1; $i++) { ?>
                            <li data-target="#carousel" data-slide-to="<?php echo $i; ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="assets/img/000_cover.jpg" alt="Artistes" width="1170" height="445">
                            </div>
                            <?php foreach ($carousel_imgs as $file) { ?>
                            <div class="item">
                                <img src="<?php echo $file; ?>" width="1170" height="445">
                            </div>
                            <?php } ?>
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
