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
    oTable = $('#TMisAcciones').DataTable({
         "oLanguage": espanol,
         "bLengthChange" : false,
         "info":     false,
         "pageLength": 10
     });
     
        var form = "#formMisAcciones";
        var paginaExito = "listaMisAcciones.php";
        //alert(paginaExito);*/
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
           nombreEntregable:{
               validators:{
                    notEmpty: {
                        message: 'Selecciona un entregable'
                    }
                }
           },
            nombreAccion:{
                validators:{
                    notEmpty: {
                        message: 'Selecciona una acción'
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
            fechaFin: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa una fecha fin'
                    }
                   
                }
            },
            estatus:{
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
                   formData.append('IdEntregableAcciones',$("#IdEntregableAcciones").val());
                   

                     $.ajax({
                       url: 'WEB-INF/Controllers/Aplicaciones/Controler_MisAcciones.php',
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
    
function eliminarRegistro(idEntregableAcciones){
swal({
  title: '¿Desea eliminar la acción?',
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
        $.post('WEB-INF/Controllers/Aplicaciones/Controler_AccionesEntregable.php',{accion:'eliminar',IdEntregableAcciones:idEntregableAcciones},function(data){
           if (data.toString().indexOf("Error:") === -1) {
            swal(data,"","success");
        }else{
            swal(data,"","warning");
        }
        cambiarContenidosConMensaje('#contenidoEntregable','Procesos/listaMisAcciones.php?',data);
        });
  }
});
}