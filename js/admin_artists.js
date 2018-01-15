//création du tableau d'artistes
function createArtistTable(retrieved_artists, parentID, childID) {
    var retrieved_artist_table = document.createElement("table");
    retrieved_artist_table.className = "table table-striped";
    retrieved_artist_table.id = childID;

    //on fabrique la 1ère ligne
    var header = retrieved_artist_table.createTHead();
    var row = header.insertRow(0);
    var cellId = row.insertCell(-1);
    var cellName = row.insertCell(-1);
    //var cellSearchName = row.insertCell(-1);
    var cellUserId = row.insertCell(-1);
    var cellCV = row.insertCell(-1);
    var cellDescriptionFr = row.insertCell(-1);
    var cellDescriptionEn = row.insertCell(-1);
    cellId.innerHTML = 'artist_id';
    cellName.innerHTML = 'nom';
    //cellSearchName.innerHTML = 'nom recherche';
    cellUserId.innerHTML = 'user_id';
    cellCV.innerHTML = 'cv';
    cellDescriptionFr.innerHTML = 'description fr';
    cellDescriptionEn.innerHTML = 'description en';

    var body = document.createElement('tbody');
    retrieved_artist_table.appendChild(body);

    for (var i = 0; i < retrieved_artists.length; i++) {
        artist = retrieved_artists[i];
        var row = body.insertRow(-1);
        row.className = "artist-row";

        var cellId = row.insertCell(-1);
        cellId.className = "cell-id";
        var cellName = row.insertCell(-1);
        //var cellSearchName = row.insertCell(-1);
        var cellUserId = row.insertCell(-1);
        var cellCV = row.insertCell(-1);
        var cellDescriptionFr = row.insertCell(-1);
        var cellDescriptionEn = row.insertCell(-1);

        cellId.innerHTML = artist['id'];
        cellName.innerHTML = artist['name'];
        //cellSearchName.innerHTML = artist['search_name'];
        cellUserId.innerHTML = artist['user'];
        if (artist['cv_filename']) {
        cellCV.innerHTML = '<a href="/assets/cv/' + artist['cv_filename'] + '" target="_blank">cv</a>';
        } else {
            cellCV.innerHTML = "pas de cv";
        }
        cellDescriptionFr.innerHTML = '<a href="/assets/artists_descriptions/fr/' + artist['description_filename'] + '" target="_blank">description fr</a>';
        cellDescriptionEn.innerHTML = '<a href="/assets/artists_descriptions/en/' + artist['description_filename'] + '" target="_blank">description en</a>';
    }
    var parent = document.getElementById(parentID);
    var child = document.getElementById(childID);
    parent.replaceChild(retrieved_artist_table, child);
}

var retrieved_artists = JSON.parse(json_retrieved_artists);

$(function() {
    createArtistTable(retrieved_artists, "search_artist", "retrieved_artist_table");

    var updateArtistModal = document.getElementById('updateArtistModal');

    var artistSelected = null;
    var artistIDSelected = null;
    $(".artist-row").click(function() {
        // aller, on fait un modal avec un formulaire et tout le tralala
        updateArtistModal.style.display = "block";
        updateArtistModal.focus();

        //on recupere l'artiste sur lequel on a cliqué
        $(this).children().each(function() {
            if (this.className === "cell-id") {
                artistIDSelected = this.innerHTML;
                // console.log("artistIDSelected=" + artistIDSelected);
            };
        });
        for (var i = 0; i < retrieved_artists.length; i++) {
            var artist = retrieved_artists[i];
            if (artistIDSelected === artist['id']) {
                artistSelected = artist;
            };
        }
        //on affiche les valeurs actuelles de cet artiste
        createArtistTable([artistSelected], "update-artist-header", "artist-selected-table");
        //on met les valeurs actuelles dans les formulaire
        var updateArtistFormChildNodes = document.getElementById("update-artist-form").childNodes;
        for (var i = updateArtistFormChildNodes.length - 1; i >= 0; i--) {
            node = updateArtistFormChildNodes[i];
            if (node.tagName === "INPUT") {
                var nodeNameAttribute = node.getAttribute("name");
                if (artistSelected[nodeNameAttribute] != null) {
                    node.setAttribute("value", artistSelected[nodeNameAttribute]);
                } else {
                    //si pas de valeur, on supprime une éventuelle valeur
                    if (node.getAttribute("type") !== "submit" && node.hasAttribute("value")) {
                        node.removeAttribute("value");
                    }
                }
            }
        };
        //besoin du user_id dans mon formulaire pour supprimer un artist
        var deleteArtistFormChildNodes = document.getElementById("delete-artist-form").childNodes;
        for (var i = deleteArtistFormChildNodes.length - 1; i >= 0; i--) {
            node = deleteArtistFormChildNodes[i];
            if (node.tagName === "INPUT" && node.getAttribute("name") === "id") {
                node.setAttribute("value", artistSelected['id']);
            }
        }
    });

    $("#delete-artist-button").click(function() {
        // var confirmation = confirm("Etes vous sûr de vouloir supprimer cet artiste? Attention, le compte utilisateur de cet artiste existera toujours, c'est à l'admin de choisir de le supprimer ");
        var confirmation = confirm("Etes vous sûr de vouloir supprimer cet artiste? Attention, le compte utilisateur de cet artiste sera également supprimé.");
        if (!confirmation) {
            return false;
        }
    });

    $(".closeModal").click(function() {
        //reset les valeurs du formulaire avant de le fermer
        document.getElementById("update-artist-form").reset();
        updateArtistModal.style.display = "none";
    });
});