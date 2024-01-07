
var form = "#formlogro";
var controller = "../../../WEB-INF/Controllers/Planeacion/Controler_planeacion.php";

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
        resumen: {
            validators: {
                notEmpty: {
                    message: 'Por favor, Ingrese una descripción de la planeación'
                },
                stringLength: {
                    message: 'La descripción sólo acepta máximo 500 caracteres',
                    max: 500
                }
            }
        }, actividad_general: {
            validators: {
                notEmpty: {
                    message: 'Por favor, Seleccione una actividad general'
                }
            }
        },
        titulo: {
            validators: {
                notEmpty: {
                    message: 'Por favor, Ingrese el titulo de la planeación'
                },
                stringLength: {
                    message: 'La descripción sólo acepta máximo 250 caracteres',
                    max: 250
                }
            }
        }, fecha: {
            validators: {
                notEmpty: {
                    message: 'Por favor, Seleccione una fecha objetiva'
                }
            }
        }
    }
});

$("#guardar").click(function (event) {

    //limpiarMensaje();
    event.preventDefault();
    if ($(form).bootstrapValidator('validate').has('.has-error').length === 0) {
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
                                    var IdEje = $('#eje').val();
                                    var Periodo = $('#Periodo').val();
                                    var tipo = $('#tipo').val();
                                    $.post("Lista_act.php", {
                                        IdEje: IdEje,
                                        tipo: tipo,
                                        Periodo: Periodo,
                                    }, function (data) {
                                        $(".detalle").html('');
                                        $(".detalle").html(data);
                                    });
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
            content: 'No es posible guardar el registro, revise los campos obligatorios',
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
