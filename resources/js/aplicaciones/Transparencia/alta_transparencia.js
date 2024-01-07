$(document).ready(function(){

    var form = "#formTransparencia";
    var controller = "../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php";

    $('#tTransparencia').DataTable(
    {
        "language": 
        {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [[ 0, "asc" ]]
        //"ordering": false
    });

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
           mes: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un mes'
                    }
                }
            },
            anio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un año'
                    }
                }
            },
            eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un eje'
                    }
                }
            },
            folio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese la parte inicial del folio'
                    },
                    stringLength: {
                        max: 20,
                        message: 'El Folio acepta máximo 20 caracteres'
                    }
                }
            },
            folio_c: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese el complemento del folio'
                    },
                    stringLength: {
                        max: 20,
                        message: 'El Folio complementario acepta máximo 20 caracteres'
                    }
                }
            },
            conv: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un convenio'
                    },
                    stringLength: {
                        max: 900,
                        message: 'Este campo acepta máximo 900 caracteres'
                    }
                }
            },
            envio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una fecha'
                    }
                }
            },
            info: {
                validators: {
                    stringLength: {
                        max: 3000,
                        message: 'Este campo acepta máximo 3000 caracteres'
                    }
                }
            }
        }
    });

    $("#guardar").click(function(event) {
        
     //limpiarMensaje();
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
         //console.log("todo validado");
         // cargando();
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
                 formData.append('id',$("#id").val());
                 formData.append('usuario',$("#usuario").val());    
                $.ajax({
                 url: controller,
                 type: 'POST',
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data, textStatus, jqXHR){
                    if (data.toString().indexOf("Error:") === -1) {
                         //swal(data,"","success");
                        $.confirm({
                        icon: 'glyphicon glyphicon-ok-sign',    
                        title: 'Confirmación',
                        content: data,
                        type: 'dark',
                        typeAnimated: true,
                        buttons: 
                        {
                            aceptar: 
                            {
                                btnClass: 'btn-dark',
                                action: function()
                                {   
                                    //$("#formEjes")[0].reset();
                                    window.location.href="index.php?nombreUsuario="+$("#usuario").val(); 
                                }
                            }
                        }
                    });  
                        
                     } else {
                        // swal(data,'','error');
                        // $("#mensajes").html(data);
                        $.confirm({
                            icon: 'glyphicon glyphicon-remove-sign',
                            title: 'Error',
                            content: data,
                            type: 'red',
                            typeAnimated: true,
                            buttons: 
                            {
                                aceptar: 
                                {
                                    btnClass: 'btn-dark',
                                    action: function()
                                    {
                                        
                                    }
                                }
                            }
                        }); 
                     }
                     //finalizar();
                },
                error: function(data)
                {
                    console.log("Error al enviar");
                },
                complete: function()
                {
                }
            });

        }else{
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: 'No es posible guardar el registro, revise los campos obligatorios',
                type: 'red',
                typeAnimated: true,
                buttons: 
                {
                    aceptar: 
                    {
                        btnClass: 'btn-dark',
                        action: function()
                        {
                            
                        }
                    }
                }
            }); 
        }
    });
});

function eliminar(Id){
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
                    $.post('../../../WEB-INF/Controllers/Transparencia/Controler_transparencia.php',{id:Id, accion:"eliminar"}, function(data)
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
                                                location.reload();
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
                                                location.reload();
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

function modificar(Id,user)
{
    //console.log("entra E ");
    window.location.href="alta_transparencia.php?accion=editar&id="+Id+"&usuario="+user;   
}