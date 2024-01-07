function cargaractE() {
	var eje = $('#eje').val();
    var area = $('#eje').val();
    var act = $('#eje').val();
//alert('EJE: ' + eje);

    //$('#expo').load("../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php", {"tipoSelect": "cargarexpo", "expo": expo}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        //$(this).select("refresh");
    //});

    $('#actividad').load("../../../WEB-INF/Controllers/Noticias/Controler_noticias.php", {"tipoSelect": "cargar", "act": act}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}
function cargaractA() {
	var eje = $('#area').val();
    var area = $('#area').val();
    var act = $('#area').val();
//alert('AREA: ' + area);
    //$('#expo').load("../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php", {"tipoSelect": "cargarexpo", "expo": expo}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        //$(this).select("refresh");
    //});

    $('#actividad').load("../../../WEB-INF/Controllers/Noticias/Controler_noticias.php", {"tipoSelect": "cargar", "area": area}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}

function cambiarContenido(div, page){
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
  
  $(div).load(page,{usuario:usuario}, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}

function  nuevaURL() {
    var contadorFila = $("#tamanoUrl").val();
    var html =
    '<div class="form-group form-group-sm" id="urls' + contadorFila + '">'+
    '<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="url" id="urls' + contadorFila + '">URL ' + contadorFila + '</label>'+
    '<div class="col-md-4 col-sm-4 col-xs-4">'+
    '<input  id="url' + contadorFila + '" name="url' + contadorFila + '" class="form-control" type="text" placeholder="http://www.ejemplo.com" value=""/>'+
    '</div>'+
    '<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="eliminarURL(' + contadorFila + ');"><i class="glyphicon glyphicon-trash"></i></button></label>'+
    '</div>'+
    '</div>';
    //alert(contadorFila);
    $("#nuevaUrl").append(html);

    contadorFila++;
    //alert(contadorFila+"mas");

    $("#tamanoUrl").val(contadorFila);
}

function eliminarURL(id) {
    var contadorFila = $("#tamanoUrl").val();
    $("#urls" + id).remove();
    contadorFila--;
    $("#tamanoUrl").val(contadorFila);
}

function catalogo(valor){
    if(valor == 1){
      cambiarContenido('#contenidoProcesos','Lista_lugarNoticia.php');
    }
    if(valor == 2){
      cambiarContenido('#contenidoProcesos','Lista_tipoNoticia.php');
    }
    if(valor == 3){
      cambiarContenido('#contenidoProcesos','Lista_soporteNoticia.php');
    }
    if(valor == 4){
      cambiarContenido('#contenidoProcesos','Lista_tipoMedio.php');
    }
    if(valor == 5){
      cambiarContenido('#contenidoProcesos','Lista_generoNoticia.php');
    }
    if(valor == 6){
      cambiarContenido('#contenidoProcesos','Lista_medio.php');
    }
}