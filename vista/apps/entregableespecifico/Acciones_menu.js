
function menu() {
    var nombre_actividad = $('#nombre_actividad').val();
    $('#nombre_entregable').load("Controler_acciones.php", {"Tipo":"menu","APP": nombre_actividad}, function (data) {
        $(this).select();
    });
}

/*function submenu() {
    var Menu = $('#nombre_entregable').val();
    $('#Sub_Menu').load("Controler_acciones.php", {"Tipo":"submenu","nombre_entregable": Menu}, function (data) {
        $(this).select();
    });
}

function acciones() {
    var Sub = $('#Sub_Menu').val();
    var text = $('#Sub_Menu option:selected').html();
    $("#titulo").html(text);
    divC = document.getElementById("SUB");
    if (Sub != "") {
        divC.style.display = "";
    } else {
        divC.style.display = "none";
    }
}*/