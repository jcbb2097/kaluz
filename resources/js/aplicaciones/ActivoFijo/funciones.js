function cargaractA() {
	var eje = $('#eje').val();
	//alert('Eje: ' + eje);
    
    $('#actividad').load("../../../WEB-INF/Controllers/ActivoFijo/Controller_activoFijo.php", {"tipoSelect": "cargar", "eje": eje}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}