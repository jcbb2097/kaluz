
function cambiarContenidos(div, page) {
    if (page === "") {
        alert("Funcionalidad no implementada aún");
        return;
    }
    limpiarMensaje();
    cargando();
    $(div).load(page, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            finalizar();
        }
    });
    }

function cambiarContenidosConMensaje(div, page, mensaje) {
  
    if (page === "") {
        alert("Funcionalidad no implementada aún");
        return;
    }
    limpiarMensaje();
    cargando();
    $(div).load(page, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            $(div).html(data);
            setMensaje(mensaje);
            finalizar();
        }
    });
}

function setMensaje(mensaje){
    $("#mensajes").html(mensaje);
}

function limpiarMensaje(){
    $("#mensajes").html("");
}

function cambiarContenidosExternos(div, url) {
    //Hay que obtener el id de la sesión para mandarlo como parámetro en la url y darlo de alta en la aplicación
    var action_ajax = "../../../WEB-INF/Controllers/Ajax/obtenerIdUsuarioSesion.php";
    var idUsuario = "";
   
    if (url.toString().indexOf("usuario=") === -1) {//No tiene el idUsuario
       
       
        $(div).html("<div class=\"embed-responsive\" style='height: 100%;'>" +
                "<iframe class=\"embed-responsive-item\" style='height: 100%;' src='" + url + "'></iframe>" +
                "</div>");
    }
}

function cambiarContenidosExternos2(div, url) {
    alert("Funcion no implementada");
    return;
    cargando();
    //Hay que obtener el id de la sesión para mandarlo como parámetro en la url y darlo de alta en la aplicación
    var action_ajax = "../../../WEB-INF/Controllers/Ajax/obtenerIdUsuarioSesion.php";
    var idUsuario = "";

    $.post(action_ajax).done(function (data)
    {
        finalizar();
        if (data.toString().indexOf("Error:") === -1) {/*En caso de que no hay error*/
            $('#contenidos_invisibles').html(data);
            idUsuario = data.toString();
            if (url.toString().indexOf("?") !== -1) {
                url = url + "&usuario=" + idUsuario;
            } else {
                url = url + "?usuario=" + idUsuario;
            }
            $(div).html("<div class=\"embed-responsive embed-responsive-16by9\" style='height: 100%;'>" +
                    "<iframe class=\"embed-responsive-item\" style='height: 100%;' src='" + url + "'></iframe>" +
                    "</div>");
        } else {
            errorCargando();
            $('#contenidos_invisibles').html(data);
        }
    });
}

function cargando() {
    $("#cargando").show();
    $("#errorPrincipal").hide();
}

function finalizar() {
    $("#cargando").hide();
}

function errorCargando() {
    $("#cargando").hide();
    $("#errorPrincipal").show();
}


function lanzarPopUpAjustable(titulo, page, width, height) {
    var $dialog = $('<div></div>').css({height: "650px", overflow: "auto", position: "relative", top: "20px", background: "#FFFFFF"})
            .html('<iframe style="border: 0px;background: #FFFFFF; " src="' + page + '" width="100%" height="99%" scrolling="yes"></iframe>')
            .dialog({
                autoOpen: false,
                modal: true,
                height: height,
                width: width,
                title: titulo,
                position: 'bottom'
            });
    $dialog.dialog('open');
}

function menuss(valor){
    //alert('Hola '+valor);
    switch(valor){
        case "1":
            cambiarContenidos('#contenidos','Menu_por_eje.php');
            return;
            break;
        case "2":
            cambiarContenidos('#contenidos','Menu_por_area.php');
            return;
            break;
        case "3":
            cambiarContenidos('#contenidos','Menu_mis_indicadores.php');
            return;
            break;
        case "4":
            cambiarContenidos('#contenidos','Menu_reporte.php');
            return;
            break;
    }
}