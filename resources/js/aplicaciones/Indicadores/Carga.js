var presentacion = $('#presentacion').val();
var accion = $('#accion').val();
if(accion=="editar" && presentacion == 10){
    divC = document.getElementById("nCuenta");
    divC.style.display = "";
}
$(document).ready(function () {


    $('#tpie').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    $('#tbarras').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    $('#tbarras2').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

});

function cargarActiviadad() {
    //var idEje = $('#Eje').val();
    alert(idEje);
    $('#Actividad').load("../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php", {"tipoSelect": "cargarActividad", "idEje": idEje}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select();
    });
}
function cargarIndicadorPorEje() {
    var idEjeI = $('#Eje').val();
    $('#IndicadorEje').load("../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php", {"tipoSelect": "cargarIndicadorPorEje", "idEjeI": idEjeI}, function (data) {
        $(this).select();
    });
}

function cargarIndicadorPorArea() {


    var idAreaI = $('#Area').val();

    $('#IndicadorArea').load("../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php", {"tipoSelect": "cargarIndicadorPorArea", "idAreaI": idAreaI}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select();
    });


}


function Filtroindicador() {
    //alert('En el filtro');
    $("#recargarvista").load("VistaIndicador.php?C=&Indicador=" + $("#Indicador").val() + "&IndicadorArea=" + $("#IndicadorArea").val() + "&Reporte=" + $("#Reporte").val(), {'Indicador': $("#Indicador").val(), 'IndicadorArea': $("#IndicadorArea").val(), 'Reporte': $("#Reporte").val()});
}
function Filtroindicador3() {
    $("#recargarvista").load("VistaindicadoresV2.php?C=&IndicadorEje=" + $("#indicadoresp").val(), {'IndicadorEje': $("#indicadoresp").val()});
}

function Reporte() {

    $("#reporte").load("vistaReporte.php?C=&Reporte=" + $("#Reporte").val() + "&time=" + $("#time").val() + "&fechaf=" + $("#fechaf").val() + "&fechai=" + $("#fechai").val(), {'Reporte': $("#Reporte").val(), 'time': $("#time").val(), 'fechaf': $("#fechaf").val(), 'fechai': $("#fechai").val});
}
function Filtroindicador2() {
    $("#recargar").load("menuIndicadores.php?C=" + $("#Periodo").val() + "&idPeriodo=" + $("#Periodo").val() + "&personal=" + $("#vista").val(), {'idPeriodo': $("#Periodo").val(), 'Personal': $("#vista").val()});
}

function cargarindicadores() {
    $("#indicadoresp").load("../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php", {eje: $("#Eje").val(), select: "josecarlos1"}, function (data) {
        $('#indicadoresp').html(data);
        $('#indicadoresp').multiselect('rebuild');

    });
}
function Filtroactividades() {
    $("#recargar2").load("indiadoresfijos/actividades.php?C=&idPeriodo=" + $("#Periodo2").val() + "&Clasificación=" + $("#Clasificación").val(), {'idPeriodo': $("#Periodo").val(), 'Clasificación': $("#Clasificación").val()});
}
function agruparindicadores() {
    var presentacion = $('#presentacion').val();
   
    
    
    divC = document.getElementById("nCuenta");


    if (presentacion == 10) {
        divC.style.display = "";
        $("#indicadores").load("../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php?aplicacion=" + $("#Aplicación").val(), {'aplicacion': $("#Aplicación").val(), select: "cargarindicador"}, function (data) {
            $('#indicadores').html(data);
            $('#indicadores').multiselect('rebuild');
        });
         $("#consulta").prop('readonly', true);
    } else {
        divC.style.display = "none";
         $("#consulta").prop('readonly', false);
    }
}
function cargarquerrys() {
    var indicador = $('#indicadores').val();
    $.post("../../../WEB-INF/Controllers/Indicadores/Controler_acciones.php", {idIndicador: indicador}).done(function (data) {
        
        $('#consulta').html(data);    
    });
}
function cargarperiodo() {
    var periodo = $('#Periodo').val();
    $.post("../../../WEB-INF/Controllers/Indicadores/Controler_acciones.php", {periodo: periodo}).done(function (data) {
     $('#Eje').html(data);
     $(this).select("refresh");
    });
   $.post("../../../WEB-INF/Controllers/Indicadores/Controler_acciones.php", {periodo2: periodo}).done(function (data2) {
     $('#area').html(data2);
     $(this).select("refresh");
    });
   $.post("../../../WEB-INF/Controllers/Indicadores/Controler_acciones.php", {periodo3: periodo}).done(function (data3) {
        $('#Aplicación').html(data3);
        $(this).select("refresh");
    });
}
function ocualtar(div, page) {
    $("#miModal").modal('hide');//ocultamos el modal
    $("#miModal").on('hidden.bs.modal', function () {
        $(div).load(page, function (data, status, xhr) {
            if (status == "error") {
                $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
            } else {
                //$(div).html(data);
                finalizar();
            }
        });
    });
}


function app(div,page){
    $("#miModal").modal('hide');//ocultamos el modal
    $("#miModal").on('hidden.bs.modal', function () {
        $(div).load(page, function (data, status, xhr) {
            if (status == "error") {
                $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
            } else {
                //$(div).html(data);
                finalizar();
            }
        });
    });
}