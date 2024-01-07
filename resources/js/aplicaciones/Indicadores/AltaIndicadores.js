$(document).ready(function () {
    var form = "#formIndicador";
    var paginaExito = "Lista_indicadores.php";

    /*$('#tindicadores').DataTable(
    {
        "language": 
        {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [[ 0, "asc" ]]
        //"ordering": false
    });*/
  
    $(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor de una breve descripción del indicador'
                    }

                }
            },
        Eje: {
            validators: {
                notEmpty: {
                    message: 'Por favor, selecciona un Eje'
                }
            }
        },
        Actividad: {
            validators: {
                notEmpty: {
                    message: 'Por favor, selecciona una Actividad'
                }

            }
        },
        Aplicación: {
            validators: {
                notEmpty: {
                     message: 'Por favor, seleciona una Aplicación '
                }

            }
        },
        Tiempo: {
            validators: {
                notEmpty: {
                    message: 'Por favor, Elija la Periodicidad de la consulta  '
                }
            }
        },
        presentacion: {
            validators: {
                notEmpty: {
                    message: 'Por favor, seleccione una presentación para el indicador '
                }
            }
        },
        area: {
            validators: {
                notEmpty: {
                    message: 'Por favor, seleccione el Área asignada a esa actividad '
                }
            }
        },
        consulta: {
            validators: {
                notEmpty: {
                    message: 'Por favor, llena este campo '
                }
            }
        },
        time: {
            validators: {
                notEmpty: {
                    message: 'indique el numero esperado '
                }
            }
        },
        Periodo: {
            validators: {
                notEmpty: {
                    message: 'seleccione un periodo '
                }
            }
        }
    }
    });
     $("#guardar").click(function() { 
        limpiarMensaje();
     if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
            cargando();
            var formData = new FormData();
            formData.append('form', $(form).serialize());
            formData.append('accion',$("#accion").val());
            //salert(accion);
            //alert($("#accion").val());
            formData.append('id',$("#id").val());  
                  $.ajax({
                url: '../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR)
                { 
                
                    if (data.toString().indexOf("Error:") === -1) {/*En caso de que no hay error*/
                            swal(data,"","success");
                            
                            cambiarContenidosConMensaje('#contenidos2','Lista_indicadores.php?accion=guardar', data);
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
   

function eliminarIndicador(IdIndicador){
    //var con = "'"+controller+"'";
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea eliminar el registro?',
        content: 'No podrás revertir los cambios',
        autoClose: 'cancelar|8000',
        type: 'dark',
        typeAnimated: true,
        buttons: 
        {
            aceptar: 
            {
                btnClass: 'btn-dark',
                action: function()
                {
                    $.post('../../../WEB-INF/Controllers/Indicadores/Controler_Indicadores2.php',{accion:'eliminar',id:IdIndicador},function(data)
                    {
                        if (data.toString().indexOf("Error:") === -1) {
                            //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: 
                                    {
                                        aceptar: 
                                        {
                                            action: function(){
                                                window.location.href="Lista_indicadores.php";
                                                //location.reload();
                                            }
                
                                        }
                                    }   
                                });
                            //location.reload();
                        }else{
                            $.confirm({
                                    icon: 'glyphicon glyphicon-remove-sign',
                                    title: data,
                                    content: '',
                                    type: 'red',
                                    buttons: 
                                    {
                                        aceptar: 
                                        {
                                            action: function(){
                                                window.location.href="Lista_indicadores.php";
                                                //location.reload();
                                            }
                
                                        }
                                    }   
                                });
                            //$.dialog(data);
                        }
                        //location.reload();
                    });
                }
            },
            cancelar: function()
            {
                //$.alert('Cancelado!');
            }
        }
    });
}

function modificar(div, page, id, user)
{ 
    

/*
  pagina = page.split('?',4);
  if (page === "") {
        alert("Funcionalidad no implementada aún");
        //alert("Pantalla no definida aún");
        return;
  }

   var accion="editar";
  var usuario = $('#usuario').val();

  $(div).load(pagina[0],{id:id, user:user, accion:accion }, function (data, status, xhr) {
  
        if (status == "error") { 
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
          
        }

  });
   */
    window.location.href="Alta_indicadores.php?accion=editar&id="+id+"&usuario="+user;   
}