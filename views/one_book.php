<!DOCTYPE html>
<html>
    <head>
        <?php include("include/html_header.php"); ?>
        <title>Opening</title>
        <!-- Import des fichiers spécifiques à cette page -->
        <!-- Wowbook -->
        <script type="text/javascript" src="./wow_book/pdf.combined.min.js"></script>
        <script type="text/javascript" src="./wow_book/wow_book.min.js"></script>
        <link rel="stylesheet" href="./wow_book/wow_book.css" type="text/css" />        
        <script>
        $(function(){
            // creates the book
            var bookOptions = {
                height   : 1000,
                width    : 1200,
                pageNumbers: false,                
                centeredWhenClosed : true,
                container: window,
                gutterShadow: false,
                toolbar : "lastLeft, left, right, lastRight, zoomin, zoomout, slideshow, fullscreen, thumbnails",              
                pdf: "resources/books/OPENINGBOOK_002.pdf"
            };
            $('#wowbook').wowBook(bookOptions);
        })
        </script>
    </head>
    <body>
        <?php include("include/header.php"); ?> 
        <div class='wowbook_container'>
            <div id="wowbook"></div>
        </div>
        <?php include("include/footer.php"); ?> 
    </body>
</html>