function Area_persona() {
    var persona = $('#Personal').val();
    $('#Area').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", { "tipoSelect": "Area", "persona": persona }, function (data) {
        $(this).select();
    });
}
function limpia_eje(){

  $('#Eje').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", { "tipoSelect": "Actividades",  "ejes": "todos" }, function (data) {
      $(this).select();
  });

}


function actividades1() {
    //alert('entra al if'+contador);
    var Eje = $('#Eje').val();
    var Periodo = $('#ano').val();
    $('#ActvGlobal').html("");
    $('#ActvGeneral').html("");
    $('#ActvParticular').html("");
    $('#SubActividad').html("");
    $('#ActvGlobal').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", { "tipoSelect": "Actividades", "Eje": Eje, "Periodo": Periodo }, function (data) {
        $(this).select();
    });



}
function actividades2() {
        var ActvG = $('#ActvGlobal').val();
        $('#ActvGeneral').html("");
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
        var text = $('#ActvGlobal option:selected').html();
        $('#ActvGeneral').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", {"General": "General", "actividad2": ActvG, "text": text}, function (data) {
            $(this).select();
        });


}
function actividades3() {

        var ActvG = $('#ActvGeneral').val();
        $('#ActvParticular').html("");
        $('#SubActividad').html("");
        var text = $('#ActvGeneral option:selected').html();
        $('#ActvParticular').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", {"Particular": "Particular", "actividad3": ActvG, "text": text}, function (data) {
            $(this).select();
        });

}
function actividades4() {

        var ActvG = $('#ActvParticular').val();
        $('#SubActividad').html("");
        var text = $('#ActvParticular option:selected').html();
        $('#SubActividad').load("../../../WEB-INF/Controllers/HorasExtras/Acciones_HorasExtras.php", {"SubActividad": "SubActividad", "actividad5": ActvG, "text": text}, function (data) {
            $(this).select();
        });

}
