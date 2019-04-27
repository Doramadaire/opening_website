var retrieved_books = JSON.parse(json_retrieved_books);

//création du tableau d'book
function createBookTable(retrieved_books, parentID, childID) {
    var retrieved_book_table = document.createElement("table");
    retrieved_book_table.className = "table table-striped";
    retrieved_book_table.id = childID;

    //on fabrique la 1ère ligne
    var header = retrieved_book_table.createTHead();
    var row = header.insertRow(0);
    var cellId = row.insertCell(-1);
    var cellTitle = row.insertCell(-1);
    var cellFilename = row.insertCell(-1);
    var cellArtistName = row.insertCell(-1);
    var cellCollection = row.insertCell(-1);
    var cellPublishDate = row.insertCell(-1);
    cellId.innerHTML = 'book_id';
    cellTitle.innerHTML = 'titre';
    cellFilename.innerHTML = 'filename';
    cellArtistName.innerHTML = 'artiste';
    cellCollection.innerHTML = 'collection';
    cellPublishDate.innerHTML = 'date de publication';

    var body = document.createElement('tbody');
    retrieved_book_table.appendChild(body);

    var nbRetrievedBook = retrieved_books.length;
    for (var i = 0; i < nbRetrievedBook; i++) {
        var book = retrieved_books[i];
        var row = body.insertRow(-1);
        row.className = "book-row";

        var cellId = row.insertCell(-1);
        cellId.className = "cell-book-id";
        var cellTitle = row.insertCell(-1);
        var cellFilename = row.insertCell(-1);
        var cellArtistName = row.insertCell(-1);
        var cellCollection = row.insertCell(-1);
        var cellPublishDate = row.insertCell(-1);

        cellId.innerHTML = book['id'];
        cellTitle.innerHTML = book['title'];
        cellFilename.innerHTML = book['filename'];
        cellArtistName.innerHTML = book['artist_name'];
        cellCollection.innerHTML = book['collection'];
        cellPublishDate.innerHTML = book['publish_date'];
    }

    var parent = document.getElementById(parentID);
    var child = document.getElementById(childID);
    parent.replaceChild(retrieved_book_table, child);
}

$(function() {
    //console.log("ready!");
    createBookTable(retrieved_books, "search_book", "retrieved_book_table");

    var updateBookModal = document.getElementById('updateBookModal');

    var bookSelected = null;
    var bookIDSelected = null;
    $(".book-row").click(function() {
        // aller, on fait un modal avec un formulaire et tout le tralala
        updateBookModal.style.display = "block";
        updateBookModal.focus();

        //on recupere l'Book sur lequel on a cliqué
        $(this).children().each(function() {
            if (this.className === "cell-book-id") {
                bookIDSelected = this.innerHTML;
            };
        });
        for (var i = 0; i < retrieved_books.length; i++) {
            var book = retrieved_books[i];
            if (bookIDSelected === book['id']) {
                bookSelected = book;
            };
        }
        //on affiche les valeurs actuelles de cet Book
        createBookTable([bookSelected], "update-book-header", "book-selected-table");
        //on met les valeurs actuelles dans les formulaire
        var updateBookFormChildNodes = document.getElementById("update-book-form").childNodes;
        for (var i = updateBookFormChildNodes.length - 1; i >= 0; i--) {
            node = updateBookFormChildNodes[i];
            if (node.tagName === "INPUT") {
                var nodeNameAttribute = node.getAttribute("name");
                if (bookSelected[nodeNameAttribute] != null) {
                    node.setAttribute("value", bookSelected[nodeNameAttribute]);
                } else {
                    //si pas de valeur, on supprime une éventuelle valeur
                    if (node.getAttribute("type") !== "submit" && node.hasAttribute("value")) {
                        node.removeAttribute("value");
                    }
                }
            } else if (node.tagName === "SELECT") {
                //donc le select index dépend du nombre d'option
                //le -2 est une valeur hardcoded pour que ça marche sans se prendre la tête
                //sinon il faut itérer sur les options pour trouver la bonne... la flemme
                node.selectedIndex = bookSelected['status']-2;
            };
        };
        //besoin du book_id dans mon formulaire pour supprimer un book
        var deleteBookFormChildNodes = document.getElementById("delete-book-form").childNodes;
        for (var i = deleteBookFormChildNodes.length - 1; i >= 0; i--) {
            node = deleteBookFormChildNodes[i];
            if (node.tagName === "INPUT" && node.getAttribute("name") === "id") {
                node.setAttribute("value", bookSelected['id']);
            }
        }
    });

    $("#delete-book-button").click(function() {
        var confirmation = confirm("Etes vous sûr de vouloir supprimer ce book?");
        if (!confirmation) {
            return false;
        }
    });

    $(".closeModal").click(function() {
        //reset les valeurs du formulaire avant de le fermer
        document.getElementById("update-book-form").reset();
        updateBookModal.style.display = "none";
    });
});
