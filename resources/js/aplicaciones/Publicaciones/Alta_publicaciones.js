$(document).ready(function(){
	//console.log('Entra data table');

	/*$('#tPublicacionesDos').DataTable({

	});
	$('#tPublicaciones').DataTable({

	});*/
    $('#tPublicacionesDos').DataTable(
        {
          "language": {
                  "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ libros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún libro disponible",
          "sInfo":           "",
          "sInfoEmpty":      "Te recomendamos dar de alta tu primer libro",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ libros)",
          "sInfoPostFix":    "",
          "sSearch":         "Filtrar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     ">>",
              "sPrevious": "<<"
			}
			},
            "order": [[ 0, "asc" ]],
            "ordering": false
    });
});
