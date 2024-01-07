//Para Dirección
 
function cargarestado() {
    var id_estado = $('#id_pais').val();
    //alert(id_estado);
    $('#id_estado').load("../../../WEB-INF/Controllers/Personas/Controler_persona.php", {"tipoSelect": "cargarestado", "id_estado": id_estado}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}

function cargarmunicipio() {
    var municipio = $('#id_estado').val();
    //alert(municipio);
    $('#municipio').load("../../../WEB-INF/Controllers/Personas/Controler_persona.php", {"tipoSelect": "cargarmunicipio", "municipio": municipio}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
       $(this).select("refresh");
    });
}

function cargarcolonia() {
    var colonia = $('#municipio').val();
    //alert(colonia);
    $('#colonia').load("../../../WEB-INF/Controllers/Personas/Controler_persona.php", {"tipoSelect": "cargarcolonia", "colonia": colonia}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
       $(this).select("refresh");
    });
} 

$(document).ready(function(){
  
    /*$("#id_estado").prop('disabled', true);
    $("#municipio").prop('disabled', true);
    $("#colonia").prop('disabled', true);*/

    $( "#id_pais").change(function() {
      
      var selector = $("#id_pais  option:selected").val();
      
      if (selector == '117') {
        $("#id_estado").prop('disabled', false);
        $("#municipio").prop('disabled', false);
        $("#colonia").prop('disabled', false);
      }/*else{
        $("#colonia").prop('disabled', true);
      }*/
    });

});