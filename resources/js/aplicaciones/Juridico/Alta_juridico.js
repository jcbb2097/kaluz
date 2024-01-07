
function loadDynamicContentModal(modal) {
    var options = {
        modal: true,
        height: 300,
        width: 800
    };
    // Realiza la consulta al fichero php para obtener información de la BD.
    $('#conte-modal').load('Mas_info.php?my_modal=' + modal, function () {
        $('#bootstrap-modal').modal({
            show: true
        });
    });
}
$(document).ready(function () {

    var form = "#formJuridico";
    var controller = "../../../WEB-INF/Controllers/Juridico/Controller_juridico.php";

    $('#tJuridico').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "order": [[0, "asc"]]
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
            ano: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }
                }
            }, Instrumento: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un instrumento '
                    }
                }
            }, Sub_tipo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor,  seleccione un subtipo '
                    }
                }
            },
            Tipo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione una opción'

                    }
                }
            },
            Objeto: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, llene este campo'
                    }

                }
            },
            Pago_derechos: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, llene este campo'
                    }
                }
            },
            Pago_seguro: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, llene este campo'
                    }
                }
            },
            transporte: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, llene este campo'
                    }
                }
            },
            Fecha_pagos: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una fecha '
                    }

                }
            },
            num_obras: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un valor'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            Borrador: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'

                    }
                }
            },
            Avance: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un avance'
                    }
                }
            },
            Estatus: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, de un estatus'
                    }
                }
            },
            Contraparte_gestor: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, llene este campo'
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
                                        window.location.href = "Lista_juridico.php?nombreUsuario=" + $("#usuario").val();
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

});
function eliminar(Id) {
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
                action: function () {
                    $.post('../../../WEB-INF/Controllers/Juridico/Controller_juridico.php', { id: Id, accion: "eliminar" }, function (data) {
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
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //location.reload();
                        } else {
                            $.confirm({
                                icon: 'glyphicon glyphicon-remove-sign',
                                title: data,
                                content: '',
                                type: 'red',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
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
            cancelar: function () {
                //$.alert('Cancelado!');
            }
        }
    });

}

function modificar(Id, user) {
    window.location.href = "Alta_juridico.php?accion=editar&id=" + Id + "&usuario=" + user;
}
