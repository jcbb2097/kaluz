function invarea() {
    var contadorFila = $("#tamanoAreas").val();
    var area = $('#area').val();
    if ($("#invA").val() != "-" && $("#invA").val() != "<%=idProy%>" && $("#invA" + $("#invA").val()).length == 0 && $("#invA").val() != area) {
        $('#involucrados').append('<span id="areaI' + $("#invA").val() + '" class="badge badge-dark disable-select">' + $("#invA option:selected").text() + ' <i class="glyphicon glyphicon-remove" onclick="eliminarArea(' + $("#invA").val() + ')" style="font-size:13px;"></i></span>');
        $('#involucrados').append('<input id="invA' + $("#invA").val() + '" name="invitados' + contadorFila + '" value="' + $("#invA").val() + '" type="hidden">');
        contadorFila++;
        $("#tamanoAreas").val(contadorFila);
    } else {
        alert('El menu ya fue agregado');
    }
}
function eliminarArea(am) {
    var contadorFila = $("#tamanoAreas").val();
    $("#areaI" + am).remove();
    $("#invA" + am).remove();
    contadorFila--;
    $("#tamanoAreas").val(contadorFila);
}

function menu() {
    var App = $('#App').val();
    $('#Menu').load("../../../WEB-INF/Controllers/Menu/Controler_acciones.php", {"Tipo":"menu","APP": App}, function (data) {
        $(this).select();
    });
}

function submenu() {
    var Menu = $('#Menu').val();
    $('#Sub_Menu').load("../../../WEB-INF/Controllers/Menu/Controler_acciones.php", {"Tipo":"Submenu","Menu": Menu}, function (data) {
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
}