$(document).ready(function(){
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
    oTable = $('#TEntregables').DataTable({
         "oLanguage": espanol,
         "bLengthChange" : false,
         "info":     false,
         "pageLength": 10
     });
    // $(".dataTables_filter").hide();
        var form = "#formEntregable";
        var paginaExito = "indexp.php";
      
         $(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa un nombre'
                    },
                    stringLength: {
                        message: 'El nombre contener máximo 50 caracteres',
                        max: 50
                    }
                }
            },
            periodo:{
                validators:{
                    notEmpty: {
                        message: 'Selecciona un periodo'
                    }
                }    
            },
            eje:{
                validators:{
                    notEmpty: {
                        message: 'Selecciona clasificacion de un eje'
                    }
                }    
            },
            actividad:{
                validators:{
                    notEmpty: {
                        message: 'Selecciona clasificacion de una actividad'
                    }
                }    
            },
            fechaInicio: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa una feha de inicio'
                    }
                   
                }
            },
            fechaEntregaEstimada: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa una feha de entrega estimada'
                    }
                   
                }
            },
            estatus: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa un estatus'
                    }
                   
                }
            }
            
        }
    });
    
  
    
     $("#guardar").click(function() { 
        limpiarMensaje();   
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
                   cargando();
                   var inputs = $("input[type=file]"),
                    files = [];
                    for (var i = 0; i < inputs.length; i++) {
                        files.push(inputs.eq(i).prop("files")[0]);
                    }

                    var formData = new FormData();
                    $.each(files, function(key, value)
                    {
                        formData.append(key, value);
                    });
                   
                   formData.append('form', $(form).serialize());
                   formData.append('accion',$("#accion").val());
                   formData.append('IdEntregable',$("#IdEntregable").val());
                   //formData.append('idEquipoTrabajo',$("#idEquipoTrabajo").val());

                         $.ajax({
                       url: 'WEB-INF/Controllers/Aplicaciones/Controler_Entregable.php',
                       type: 'POST',
                       data: formData,
                       cache: false,
                       contentType: false,
                       processData: false,
                       success: function(data, textStatus, jqXHR)
                       {
                           if (data.toString().indexOf("Error:") === -1) {/*En caso de que no hay error*/
                                   swal(data,"","success");
                                   cambiarContenidosConMensaje('#contenidos',paginaExito,data);
                               } else {
                                   swal(data,'','error');
                                   $("#mensajes").html(data);
                               }
                               finalizar();
                       },
                       error: function(jqXHR, textStatus, errorThrown)
                       {
                       },
                       complete: function()
                       {
                       }
                   });

               }else{
                   swal('Error: completar el formulario','','error');
               }
            
    });  
    
    
    
    
});
    
function cargaActividades(eje,actividad){
    if(eje == 0 && actividad == 0){
   $("#actividad").load("../../../WEB-INF/Controllers/Ajax/CargaSelect.php",{eje:$("#eje").val(),select:"alex1"});
    }else{
     $("#actividad").load("../../../WEB-INF/Controllers/Ajax/CargaSelect.php",{eje:eje,select:"alex3",actividad:actividad});
    }
}

function cargaEjes(periodo,eje){
    if(periodo == 0 && eje == 0){
   $("#eje").load("WEB-INF/Controllers/Ajax/CargaSelect.php",{periodo:$("#periodo").val(),select:"jordan3"});
    }else{
     $("#eje").load("WEB-INF/Controllers/Ajax/CargaSelect.php",{periodo:periodo,select:"jordan4",eje:eje});
    }
    
   //alert($("#periodo").val());
    
   /* if (typeof IdPeriodo !== 'undefined' && IdPeriodo !== null) {
        // Ahora sabemos que foo está definido, ahora podemos continuar.
          //var IdPeriodo = $("#periodo").val();
          var form = "IdPeriodo=" + IdPeriodo;
          //var pagina = "Procesos/listaCronograma.php";
          var pagina = "Procesos/altaEntregable.php";
          pagina += "?" + form;

          //alert(pagina);

          $.post(pagina, function (data) {

              //alert(data);

              $('#contenidos').html(data);
          });

    }*/
}

function eliminarRegistro(id){
swal({
  title: '¿Desea eliminar el entregable?',
  text: "No podrás revertir los cambios",
  type: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Eliminar',
  cancelButtonText: 'Cancelar',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
  reverseButtons: true
}).then((result) => {
  if (result.value) { 
        $.post('WEB-INF/Controllers/Aplicaciones/Controler_Entregable.php',{accion:'eliminar',IdEntregable:id},function(data){
           if (data.toString().indexOf("Error:") === -1) {
            swal(data,"","success");
        }else{
            swal(data,"","warning");
        }
        cambiarContenidosConMensaje('#contenidoEntregable','Procesos/listaEntregables.php?E=General',data);
        });
  }
});
}

function eliminarRegistroMispendientes(id){
swal({
  title: '¿Desea eliminar el entregable?',
  text: "No podrás revertir los cambios",
  type: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Eliminar',
  cancelButtonText: 'Cancelar',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
  reverseButtons: true
}).then((result) => {
  if (result.value) { 
        $.post('WEB-INF/Controllers/Aplicaciones/Controler_Entregable.php',{accion:'eliminar',IdEntregable:id},function(data){
           if (data.toString().indexOf("Error:") === -1) {
            swal(data,"","success");
        }else{
            swal(data,"","warning");
        }
        cambiarContenidosConMensaje('#contenidoEntregable','Procesos/listaEntregables.php?E=General',data);
        });
  }
});
}
