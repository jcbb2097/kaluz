function expo() {
        var Periodo = $('#ano').val();
        $('#Expotem' ).load("../../../WEB-INF/Controllers/Juridico/Acciones_juridico.php", {"expo": "expo", "Periodo": Periodo}, function (data) {
                $(this).select();
            });
    }

function cargaractE() {
	var eje = $('#Eje').val();
    var area = $('#Eje').val();
    var act = $('#Eje').val();
//alert('EJE: ' + eje);

    //$('#expo').load("../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php", {"tipoSelect": "cargarexpo", "expo": expo}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        //$(this).select("refresh");
    //});

    $('#actividad').load("../../../WEB-INF/Controllers/Juridico/Controller_juridico.php", {"tipoSelect": "cargar", "act": act}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        //$(this).select("refresh");
    });
}
