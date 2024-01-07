$(document).ready(function(){
   /* $('#tActividades').DataTable({
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
    oTable = $('#TableCronograma').DataTable({
         "oLanguage": espanol,
         "bLengthChange" : false,
         "info":     false,
         "pageLength": 10,
         //"scrollX": true
         
     });*/
    
    $("#guardar").click(function() { 
        //limpiarMensaje();        
        var IdEje = $("#selectEje").val();
        var IdEntregable = $("#selectEntregable").val();
        var IdArea = $("#selectArea").val();
        var IdResponsable = $("#selectResponsable").val();
            
             
        $.ajax({
                url: 'WEB-INF/Controllers/Procesos/generarCronogramaExcel.php',
                type: 'POST',
                data: ('IdEje='+IdEje+'&IdEntregable'+IdEntregable+'&IdArea'+IdArea+'&IdResponsable'+IdResponsable),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.toString().indexOf("Error:") === -1) {/*En caso de que no hay error*/
                            //swal(data,"","success");
                            cambiarContenidos('#contenidoProcesos','Procesos/Cronograma.php');
                        } else {
                            //swal(data,'','error');
                            $("#mensajes").html(data);
                        }
                        //finalizar();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                },
                complete: function()
                {
                }
        });     
    });  
               
               
 });
 
 function mostrarCronograma() {

    //limpiarMensaje();
    var filtroEje = $("#selectEje").val();
    var form = "filtroEje=" + filtroEje;
    //var pagina = "Procesos/listaCronograma.php";
    var pagina = "Procesos/Cronograma.php";
    /*$.post({form: form, 'pagina':pagina}).done(function(data){        
     $("#altaExposiciones").load(pagina, function(){
     finished();
     });
     });*/
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });

}

function mostrarPorEntregable() {
   //alert('algo');
    //limpiarMensaje();
    var filtroEntregable = $("#selectEntregable").val();
    var form = "filtroEntregable=" + filtroEntregable;
    //var pagina = "Procesos/listaCronograma.php";
    var pagina = "Procesos/Cronograma.php";
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
    //var pagina = "Procesos/listaCronograma.php";
    var pagina = "Procesos/Cronograma.php";
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
    //var pagina = "Procesos/listaCronograma.php";
    var pagina = "Procesos/Cronograma.php";
    pagina += "?" + form;

    //alert(pagina);

    $.post(pagina, function (data) {
        
        //alert(data);
        
        $('#contenidoProcesos').html(data);
    });
    
}

function generarExcel(){
    //alert('algo');
    var IdEje = $("#selectEje").val();
    var IdEntregable = $("#selectEntregable").val();
    var IdArea = $("#selectArea").val();
    var IdResponsable = $("#selectResponsable").val();
    /*$("Table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "ListadoCronograma",    //Nombre del archivo 
    });*/
    alert(IdEje+','+IdEntregable+','+IdArea+','+IdResponsable);
   /* $.post('WEB-INF/Controllers/Procesos/generarCronogramaExcel.php',{IdEje:IdEje,IdEntregable:IdEntregable,IdArea:IdArea,IdResponsable:IdResponsable},function(data){
            //cambiarContenidosConMensaje('#contenidoProcesos','Procesos/Cronograma.php',data);
        });*/
    
   
}