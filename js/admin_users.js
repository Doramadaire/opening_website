var retrieved_users = JSON.parse(json_retrieved_users);

//création du tableau d'users           
function createUserTable(retrieved_users, parentID, childID) {
    var retrieved_users_table = document.createElement("table");
    retrieved_users_table.className = "table table-striped";
    retrieved_users_table.id = childID;

    //on fabrique la 1ère ligne
    var header = retrieved_users_table.createTHead();
    var row = header.insertRow(0);
    var cellId = row.insertCell(-1);
    var cellMail = row.insertCell(-1);
    var cellFirstname = row.insertCell(-1);
    var cellLastname = row.insertCell(-1);
    var cellStatus = row.insertCell(-1);
    var cellSubscriptionDate = row.insertCell(-1);
    cellId.innerHTML = 'user_id';
    cellMail.innerHTML = 'mail';
    cellFirstname.innerHTML = 'prenom';
    cellLastname.innerHTML = 'nom';
    cellStatus.innerHTML = 'statut';
    cellSubscriptionDate.innerHTML = 'date fin adhesion';

    var body = document.createElement('tbody');
    retrieved_users_table.appendChild(body);

    var nbRetrievedUsers = retrieved_users.length;
    for (var i = 0; i < nbRetrievedUsers; i++) {
        user = retrieved_users[i];
        var user = retrieved_users[i];
        var row = body.insertRow(-1);
        row.className = "user-row";

        var cellId = row.insertCell(-1);
        // cellId.className = "cell-id-" + user['id'];
        cellId.className = "cell-user-id";
        var cellMail = row.insertCell(-1);
        var cellFirstname = row.insertCell(-1);
        var cellLastname = row.insertCell(-1);
        var cellStatus = row.insertCell(-1);
        var cellSubscriptionDate = row.insertCell(-1);

        cellId.innerHTML = user['id'];
        cellMail.innerHTML = user['mail'];
        cellFirstname.innerHTML = user['firstname'];
        cellLastname.innerHTML = user['name'];
        cellStatus.innerHTML = user['status'];
        cellSubscriptionDate.innerHTML = user['subscription_date'];
    }

    var parent = document.getElementById(parentID);
    var child = document.getElementById(childID);
    parent.replaceChild(retrieved_users_table, child);
}

$(function() {
    //console.log("ready!");
    createUserTable(retrieved_users, "search_user", "retrieved_users_table");

    var updateUserModal = document.getElementById('updateUserModal');

    var userSelected = null;
    var userIDSelected = null;
    $(".user-row").click(function() {
        // aller, on fait un modal avec un formulaire et tout le tralala
        updateUserModal.style.display = "block";
        updateUserModal.focus();

        //on recupere l'user sur lequel on a cliqué
        $(this).children().each(function() {
            if (this.className === "cell-user-id") {
                userIDSelected = this.innerHTML;
            };
        });
        for (var i = 0; i < retrieved_users.length; i++) {
            var user = retrieved_users[i];
            if (userIDSelected === user['id']) {
                userSelected = user;
            };
        }
        //on affiche les valeurs actuelles de cet user
        createUserTable([userSelected], "update-user-header", "user-selected-table");
        //on met les valeurs actuelles dans les formulaire
        var updateUserFormChildNodes = document.getElementById("update-user-form").childNodes;
        for (var i = updateUserFormChildNodes.length - 1; i >= 0; i--) {
            node = updateUserFormChildNodes[i];
            if (node.tagName === "INPUT") {
                var nodeNameAttribute = node.getAttribute("name");
                if (userSelected[nodeNameAttribute] != null) {
                    node.setAttribute("value", userSelected[nodeNameAttribute]);
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
                node.selectedIndex = userSelected['status']-2;
            };
        };
        //besoin du user_id dans mon formulaire pour supprimer un user
        var deleteUserFormChildNodes = document.getElementById("delete-user-form").childNodes;
        for (var i = deleteUserFormChildNodes.length - 1; i >= 0; i--) {
            node = deleteUserFormChildNodes[i];
            if (node.tagName === "INPUT" && node.getAttribute("name") === "id") {
                node.setAttribute("value", userSelected['id']);
            }
        }
    });

    $("#delete-user-button").click(function() {
        var confirmation = confirm("Etes vous sûr de vouloir supprimer cet utilisateur?");
        if (!confirmation) {
            return false;
        }
    });

    $(".closeModal").click(function() {
        //reset les valeurs du formulaire avant de le fermer
        document.getElementById("update-user-form").reset();
        updateUserModal.style.display = "none";
    });

    // When the user clicks anywhere outside of the modal, close it
    //deactivated : we don't want to lose data
    // window.onclick = function(event) {
                //  if (event.target == updateUserModal) {
                //      updateUserModal.style.display = "none";
                //  }
                // }
});