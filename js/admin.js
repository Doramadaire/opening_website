function collectionSelecChange(value) {
    if (value === "other") {
        var newSpanText = document.createElement("span");
        newSpanText.id = "add-collection-span";
        newSpanText.innerHTML = "Attention, cette action va créer une nouvelle collection sur la page catalogue<br>";

        var newInputBox = document.createElement("input");
        newInputBox.required = true;
        newInputBox.id = "add-collection-input";
        newInputBox.setAttribute("type", "text");
        newInputBox.setAttribute("name", "new_collection");

        var selectBlock = document.getElementById("select-collection");
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