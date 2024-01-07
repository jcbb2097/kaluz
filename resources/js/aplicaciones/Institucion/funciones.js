function cargarsubgiro() {
    var idgiro = $('#Giro').val();

    $('#SubGiro').load("../../../WEB-INF/Controllers/Institucion/Controler_institucion.php", {"tipoSelect": "cargarsubgiro", "idgiro": idgiro}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}
function cargargiro() {
    var idsector = $('#Sector').val();

    $('#Giro').load("../../../WEB-INF/Controllers/Institucion/Controler_institucion.php", {"tipoSelect": "cargarsector", "idsector": idsector}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).multiselect("refresh");
    });
}
function cargarDF() {
    var id = $('#Pais').val();
    var idCiudad = $('#Pais').val();
    var idEstado = $('#Pais').val();

    $('#DF').load("../../../WEB-INF/Controllers/Institucion/Controler_institucion.php", {"tipoSelect": "cargarDF", "id": id}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).multiselect("refresh");
    });
    
    $('#Estado').load("../../../WEB-INF/Controllers/Institucion/Controler_institucion.php", {"tipoSelect": "CargarEstado", "idEstado": idEstado}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).multiselect("refresh");
    });

}
function cargaralcaldia(){
 
      var idalcaldia = $('#Estado').val();
       
      $('#alcaldia').load("../../../WEB-INF/Controllers/Institucion/Controler_institucion.php", {"tipoSelect": "cargaralcaldia", "idalcaldia": idalcaldia}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).multiselect("refresh");
    });
}
$(document).ready(function() 
{
$("#pdf").prop('disabled', false);
$("#RFC").prop('disabled', false);

$( "#DF").change(function() {
  var selector = $("#DF  option:selected").val();
  switch(selector){
    case "1":
      $("#pdf").prop('disabled', false);
      $("#RFC").prop('disabled', false);
      break;
    case "2":
      $("#pdf").prop('disabled', true);
      $("#RFC").prop('disabled', true);
      break;
    case "3":
      $("#pdf").prop('disabled', true);
      $("#RFC").prop('disabled', true);
      break;
  }
});

$("#Dependencia").prop('disabled', false);
$( "#Sector").change(function() {
  var selector = $("#Sector  option:selected").val();
  switch(selector){
    case "1":
      $("#Dependencia").prop('disabled', false);
      break;
    case "2":
      $("#Dependencia").prop('disabled', true);
      break;
    case "3":
      $("#Dependencia").prop('disabled', true);
      break;
  }
});
});