<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("include/html_header.php"); ?>
        <meta name="description" content="<?php echo META_DESCRIPTION_LOGIN; ?>">
        <meta name="keywords" content="<?php echo META_KEYWORDS_LOGIN; ?>">
        <title><?php echo TXT_TAB_LOGIN; ?></title>
        <style type="text/css">
            #logging-form input {
                margin: 2px 0px;
            }
        </style>
    </head>
    <body>
        <?php include("include/header.php"); ?>
        <div class="container-fluid row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <h1><?php echo TXT_SECTION_LOGIN; ?></h1>
                <div id="logging-form">
                    <h4><?php echo TXT_TITLE_LOGIN; ?></h4>
                    <?php  if (isset($logging_error)) {echo '<p class="error_message">'.$logging_error.'<p>';}?>
                    <form class="logging-form" action="login.php" method="POST">
                        <input name="mail" placeholder="e-mail" type="text"><br>
                        <input name="password" placeholder="password" type="password"><br>
                        <input class="btn btn-primary" role="button" name="logging_form" value="se connecter" type="submit">
                    </form>
                    <a onclick="hideThis('oubli')"><?php echo TXT_SHOW_FORGOTTEN_PASSWORD; ?></a>
                    <?php if (isset($reset_pswd_error)) {echo '<p class="error_message">'.$reset_pswd_error.'<p>';}?>
                    <form id="oubli" class="hide_first" action="" method="POST">
                        <p><input name="mail_pswd_forgotten" placeholder="e-mail" type="text"></p>
                        <p><?php echo TXT_FORGOTTEN_PASSWORD_WARNING; ?></p>
                        <input class="btn btn-primary" role="button" name="pswd_forgotten_form" value="<?php echo TXT_CONFIRM_FORGOTTEN_PASSWORD; ?>" type="submit">
                    </form>
                    <?php if (isset($_POST['pswd_forgotten_form'])) {if ($reset_pswd_success) echo TXT_RESET_PSWD_SUCCESS;} ?>
                </div>
            </div>
            <div class="col-xs-1"></div>
        </div>
    </body>
</html>
