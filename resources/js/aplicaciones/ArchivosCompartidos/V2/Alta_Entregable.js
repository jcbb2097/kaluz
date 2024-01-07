$(document).ready(function () {

    var form = "#formArchivo";
    var controller = "../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php";


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
                        message: 'Por favor, Ingrese una descripción del entregable'
                    },
                    stringLength: {
                        message: 'La descripción sólo acepta máximo 250 caracteres',
                        max: 250
                    }
                }
            }, ano: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el periodo del entregable'
                    }
                }
            }, fechac: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija la fecha'
                    }
                }
            }, persona: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija la persona que sube el entregable'
                    }
                }
            }, area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el Área que sube el entregable'
                    }
                }
            }, cate: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el tipo de entregable'
                    }
                }
            }, Eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            ActvGlobal: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad o Meta global '
                    }
                }
            },
            cate: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una categoría '
                    }
                }
            }
        }
    });

    $("#guardar").click(function (event) {
        var num_sub = $('#subCheck option').length;
        var sub = $('#subCheck').val();
        var bandera = true;
        var mensaje='No es posible guardar el registro, revise los campos obligatorios';
        if (num_sub > 0 && sub < 0) {
            bandera = false;
            mensaje='Debe elejir un subchecklist para continuar';
        }
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 && bandera == true) {
            //console.log("todo validado");
            // cargando();
            var inputs = $("input[type=file]"),
                files = [];
            for (var i = 0; i < inputs.length; i++) {
                files.push(inputs.eq(i).prop("files")[0]);
            }

            var formData = new FormData();
            $.each(files, function (key, value) {
                formData.append(key, value);
            });
            formData.append('form', $(form).serialize());
            formData.append('accion', $("#accion").val());
            formData.append('id', $("#id").val());
            formData.append('usuario', $("#usuario").val());
            $.ajax({
                url: controller,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
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
                                    action: function () {
                                        //$("#formEjes")[0].reset();
                                        window.location.href = "Lista_entregable.php?nombreUsuario=" + $("#nombreUsuario").val() + "&tipoPerfil=" + $("#tipoPerfil").val() + "&idUsuario=" + $("#idUsuario").val();
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
                                    action: function () {

                                    }
                                }
                            }
                        });
                    }
                    //finalizar();
                },
                error: function (data) {
                    console.log("Error al enviar");
                },
                complete: function () {
                }
            });

        } else {
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: mensaje,
                type: 'red',
                typeAnimated: true,
                buttons:
                {
                    aceptar:
                    {
                        btnClass: 'btn-dark',
                        action: function () {

                        }
                    }
                }
            });
        }
    });

});

