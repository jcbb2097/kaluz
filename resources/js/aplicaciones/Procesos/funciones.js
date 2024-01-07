function cambiarContenidos(div, page) {
    if (page === "") {
        alert("Funcionalidad no implementada aún");
        return;
    }
    //limpiarMensaje();
    //cargando();
    $(div).load(page, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data); //finalizar();
        }
    });
}

function menuss(valor){
    //alert('Hola '+valor);
    switch(valor){
        case "1":
            cambiarContenidos('#home','indexp.php');
            return;
            break;
        case "2":
            cambiarContenidos('#contenidos','listaMisEntregables.php');
            return;
            break;
        case "3":
            cambiarContenidos('#contenidos','listaMisAcciones.php');
            return;
            break;
        case "4":
            cambiarContenidos('#contenidos','listaCaracteristicas.php');
            return;
            break;
        case "5":
            cambiarContenidos('#contenidos','listaAcciones.php');
            return;
            break;
        case "6":
            cambiarContenidos('#contenidos','reporteIndicadorCumplimiento.php');
            return;
            break;
        case "7":
            cambiarContenidos('#contenidos','reportePresupuesto.php');
            return;
            break;
    }
}