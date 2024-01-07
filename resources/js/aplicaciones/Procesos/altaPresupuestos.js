$(document).ready(function(){
    //alert('Hey');
     var espanol = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "<div class='alert alert-info'><strong>Lo sentimos</strong> No hay usuarios relacionados con tu búsqueda.</div>",
        "sEmptyTable": "Ning\u00fan dato disponible en esta tabla",
        "sInfo": "Mostrando de _START_ a _END_ de  _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 registros",
        "sInfoFiltered": "(filtrado de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "\u00daltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
    oTable = $('#TablePresupuestos').DataTable({
         "oLanguage": espanol,
         "bLengthChange" : false,
         "info":     false,
         "pageLength": 10
     });
        
});

 function mostrarPorEje() {
     //alert('algo');
    //limpiarMensaje();
    var filtroEje = $("#selectEje").val();
    var form = "filtroEje=" + filtroEje;
    var pagina = "Procesos/reporteIndicadorCumplimiento.php";
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });

}

function mostrarPorEntregable() {
    // alert('algo');
    //limpiarMensaje();
    var filtroEntregable = $("#selectEntregable").val();
    var form = "filtroEntregable=" + filtroEntregable;
    var pagina = "Procesos/reporteIndicadorCumplimiento.php";
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });

}

function mostrarPorArea() {
    // alert('algo');
    //limpiarMensaje();
    var filtroArea = $("#selectArea").val();
    var form = "filtroArea=" + filtroArea;
    var pagina = "Procesos/reporteIndicadorCumplimiento.php";
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });

}

function mostrarPorResponsable() {
    // alert('algo');
    //limpiarMensaje();
    var filtroResponsable = $("#selectResponsable").val();
    var form = "filtroResponsable=" + filtroResponsable;
    var pagina = "Procesos/reporteIndicadorCumplimiento.php";
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });

}