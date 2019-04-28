function collectionSelecChange($this) {
    var current_elem = $this;
    var selected_value = current_elem[current_elem.selectedIndex].value;
    if (selected_value === "other") {
        var newSpanText = document.createElement("span");
        newSpanText.id = "add-collection-span";
        newSpanText.innerHTML = "<br>Attention, cette action va créer une nouvelle collection sur la page catalogue<br>";

        var newInputBox = document.createElement("input");
        newInputBox.required = true;
        newInputBox.id = "add-collection-input";
        newInputBox.setAttribute("type", "text");
        newInputBox.setAttribute("name", "new_collection");

        var selectBlock = current_elem;
        selectBlock.parentNode.insertBefore(newInputBox , selectBlock.nextSibling);
        newInputBox.parentNode.insertBefore(newSpanText , newInputBox.nextSibling);
    } else {
        var uselessInputBox = document.getElementById("add-collection-input");
        var uselessSpanText = document.getElementById("add-collection-span");

        if (uselessInputBox !== null) {
            uselessInputBox.parentNode.removeChild(uselessInputBox);
        }
        if (uselessSpanText !== null) {
            uselessSpanText.parentNode.removeChild(uselessSpanText);
        }
    }
}