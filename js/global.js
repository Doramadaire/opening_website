function hideThis(_div){
    var obj = document.getElementById(_div);
    if(obj.style.display == "block")
        obj.style.display = "none";
    else
        obj.style.display = "block";
}

function hideRow(_div){
    var obj = document.getElementById(_div);
    if(obj.style.display == "table-row")
        obj.style.display = "none";
    else
        obj.style.display = "table-row";
}