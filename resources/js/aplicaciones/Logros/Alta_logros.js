$(document).ready(function () {

    var form = "#form_logro";
    var controller = "../../../WEB-INF/Controllers/Logros/Controler_logros.php";
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
            titulo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un titulo'
                    },
                    stringLength: {
                        message: 'El titulo sólo acepta máximo 1000 caracteres',
                        max: 1000
                    }
                }
            },
            fechac: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese la fecha optativa'
                    }
                }
            }, eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un eje'
                    }
                }
            }, area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione el área '
                    }
                }
            },
            actividad: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione la actividad'
                    }

                }
            },
            resumen: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un resumen'
                    },
                    stringLength: {
                        message: 'El resumen sólo acepta máximo 1000 caracteres',
                        max: 1000
                    }
                }
            },
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un descripción'
                    },
                    stringLength: {
                        message: 'El descripción sólo acepta máximo 1000 caracteres',
                        max: 1000
                    }
                }
            }
        }
    });
    $("#guardar").click(function (event) {
        event.preventDefault();
           if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
            //console.log("todo validado");
            // cargando();
                    var formData = new FormData();

                    var incisos = $("#cant_incisos").val();
                    var incisos_texto = "";
                    for (var i = 1; i <= incisos; i++) {
                      if($("#descripcion"+i).val() != "")
                        incisos_texto += $("#descripcion"+i).val()+"<br>";
                    }
                    console.log("incisos  : "+incisos_texto);
                    formData.append('form', $(form).serialize());
                    formData.append('descripcion',incisos_texto);
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
                    success: function(data, textStatus, jqXHR)
                   {
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

                                       window.location.href="logros.php?idUsuario="+$("#Id_usuario").val()+'&nombreUsuario='+$("#Id_usuario").val();
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
    $("#regresar").click(function (event) {
        window.location.href="logros.php?nombreUsuario="+$("#usuario").val()+"&idUsuario="+$("#Id_usuario").val();
    });

});
