function cargarexpo() {
	var eje = $('#eje').val();
    var expo = $('#eje').val();
    var act = $('#eje').val();

    //$('#expo').load("../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php", {"tipoSelect": "cargarexpo", "expo": expo}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        //$(this).select("refresh");
    //});

    $('#actividad').load("../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php", {"tipoSelect": "cargar", "act": act}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}

$(document).ready(function(){
	var act = $('#eje').val();
	//alert('Nuevo ' + act);
	if (act != '') {
		$("#actividad").prop('disabled', false);
		$("#expo").prop('disabled', false);
	}else{
		$("#actividad").prop('disabled', true);
		$("#expo").prop('disabled', true);
	}

	/*if(act == 7){
		$("#expo").prop('disabled', false);
	}else{
		$("#expo").prop('disabled', true);
	}*/
	
	//$("#expo").prop('disabled', true);
	//$("#actividad").prop('disabled', true);

	$( "#eje").change(function(){
		var selector = $("#eje  option:selected").val();
		/*switch(selector){
			case "6":
				$("#expo").prop('disabled', false);
				break;
			case "7":
				$("#expo").prop('disabled', false);
				break;
		}*/

	var ejes = $("#eje  option:selected").val();

	//alert(ejes);
	if ( ejes != 0) {
		$("#actividad").prop('disabled', false);
		$("#expo").prop('disabled', false);
	}

	});

});

function cambiarTabla(div, page){

  //alert(div+" "+page);
  pagina = page.split('?',4);


  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
   // alert(div+" "+pagina[0]);
  $(div).load(pagina[0],{nombreUsuario:pagina[1],idUsuario:pagina[2], id_t:pagina[3] }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}