
$(document).ready(function () {

    var form = "#formEntregablecheck";
    var controller = "Controller_entregablecheck.php";
    var cont = 0;

    $('#tEntregablecheck thead tr').clone(true).appendTo( '#tEntregablecheck thead' );
   $('#tEntregablecheck thead tr:eq(1) th').each( function (i) {
       cont++;
       if(cont != 1 ){
         var title = $(this).text();
         $(this).html( '<input type="text" style="width : 90px;" placeholder="'+title+'" />' );

         $( 'input', this ).on( 'keyup change', function () {
             if ($('#tEntregablecheck').DataTable().column(i).search() !== this.value ) {
                 $('#tEntregablecheck').DataTable()
                     .column(i)
                     .search( this.value )
                     .draw();
             }
         } );
       }
   } );

    $('#tEntregablecheck').DataTable(
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
            entregable: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un entregable'
                    }
                }
            },
            checklist: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un checklist'
                    }
                }
            },
            responsable: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un responsable'
                    }
                }
            },
        }
    });


    $("#guardar").click(function(event) {

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
                                        window.location.href ="Lista_entregablecheck.php?nombreUsuario="+$("#usuario").val();
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
                    $.post('Controller_entregablecheck.php', { id: Id, accion: "eliminar" }, function (data) {
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
    window.location.href = "Alta_entregablecheck.php?accion=editar&id=" + Id + "&usuario=" + user;
}
