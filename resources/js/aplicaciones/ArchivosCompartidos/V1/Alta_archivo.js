$(document).ready(function () {

    var form = "#formArchivo";
    var controller = "../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php";
    var form2 = "#Formcategorias";
    var controller2 = "../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_categorias.php";
    var cont = 0;

   $('#tArchivo thead tr').clone(true).appendTo( '#tArchivo thead' );
   $('#tArchivo thead tr:eq(1) th').each( function (i) {
       cont++;
       if(cont != 1 && cont != 3){
         var title = $(this).text();
         $(this).html( '<input type="text" style="width : 85px;" placeholder="'+title+'" />' );

         $( 'input', this ).on( 'keyup change', function () {
             if ( table.column(i).search() !== this.value ) {
                 table
                     .column(i)
                     .search( this.value )
                     .draw();
             }
         } );
       }
   } );

    var table = $('#tArchivo').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "order": [[6, "desc"]]
            //"ordering": false
        });
    $(form2).bootstrapValidator({
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
                        message: 'Por favor, Ingrese una descripción'
                    }
                }
            }
        }
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
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una descripción'
                    },
                    stringLength: {
                        message: 'La descripción sólo acepta máximo 250 caracteres',
                        max: 250
                    }
                }
            },
            fechac: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese la fecha del acuerdo'
                    }
                }
            }, persona: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Seleccione a la persona que convoca el acuerdo'
                    }
                }
            }, area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Seleccione el área que convoca el acuerdo'
                    }
                }
            },
            categoria: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Seleccione el tipo de acuerdo'
                    }

                }
            },
            Eje: {
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
            }
        }
    });

    $("#guardar").click(function (event) {

        let tamanio = 0;

        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0) {
          var formData = new FormData();
          if($("#checkbox_pdf").prop('checked') == false){//se añade el archivo si no se agrega un link
              var inputs = $("input[type=file]"),
                  files = [];

              for (var i = 0; i < inputs.length; i++) {
                  files.push(inputs.eq(i).prop("files")[0]);
              }
              if(files[0] != null)tamanio = files[0].size;else tamanio = 0;
              //if(files[0] != null)files[0].name = quitaracentos(files[0].name);
          }

          if(tamanio > 0 || $("#link_pdf").val() != "" || $("#archivo_registrado").val() == "1"){


                if(tamanio < 4200000 || $("#archivo_registrado").val() == "1"){//4 mb aprox

                  if($("#checkbox_pdf").prop('checked') == false){//se añade el archivo si no se agrega un link
                      $.each(files, function (key, value) {
                          console.log("KEY : "+key);
                          //,quitaracentos(files[0].name)
                          formData.append(key, value);
                      });
                  }


            $("#guardar").prop('disabled', true);
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
                    if (data.toString().indexOf("Error") === -1) {
                        //swal(data,"","success");
                        $.confirm({
                            icon: 'glyphicon glyphicon-ok-sign',
                            title: 'Confirmación',
                            content: data,
                            type: 'dark',
                            typeAnimated: true,
                            buttons:{
                                aceptar:{
                                    btnClass: 'btn-dark',
                                    action: function () {
                                        //$("#formEjes")[0].reset();
                                        window.location.href = "lista_archivo.php?nombreUsuario=" + $("#usuario").val()+"&idUsuario="+ $("#idUsuario").val();
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
                            buttons:{
                                aceptar:{
                                    btnClass: 'btn-dark',
                                    action: function () {
                                        $("#guardar").prop('disabled', false);
                                    }
                                }
                            }
                        });
                    }
                    //finalizar();
                },
                error: function (data) {
                    console.log("Error al enviar");
                    $("#guardar").prop('disabled', false);
                },
                complete: function () {
                }
            });
          }else{
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: 'El archivo es demasiado grande , ingresa un link hacia el archivo ',
                type: 'red',
                typeAnimated: true,
                buttons:{
                    aceptar:{
                        btnClass: 'btn-dark',
                        action: function () {
                          $("#guardar").prop('disabled', false);
                        }
                    }
                }
            });
          }
        }else{
          $.confirm({
              icon: 'glyphicon glyphicon-remove-sign',
              title: 'Error',
              content: 'Debes ingresar un archivo o un link a archivo',
              type: 'red',
              typeAnimated: true,
              buttons:{
                  aceptar:{
                      btnClass: 'btn-dark',
                      action: function () {
                        $("#guardar").prop('disabled', false);
                      }
                  }
              }
          });
        }
        } else {
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: 'No es posible guardar el registro, revise los campos obligatorios',
                type: 'red',
                typeAnimated: true,
                buttons:{
                    aceptar:{
                        btnClass: 'btn-dark',
                        action: function () {
                            $("#guardar").prop('disabled', false);
                        }
                    }
                }
            });
        }
    });
    $("#guardar2").click(function (event) {

        //limpiarMensaje();
        event.preventDefault();
        if ($(form2).bootstrapValidator('validate').has('.has-error').length === 0  ) {
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
            formData.append('form', $(form2).serialize());
            formData.append('accion', $("#accion").val());
            formData.append('id', $("#id").val());
            formData.append('usuario', $("#usuario").val());
            $.ajax({
                url: controller2,
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
                                        window.location.href = "lista_categorias.php?nombreUsuario=" + $("#usuario").val()+"&idUsuario="+ $("#idUsuario").val();
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
                    $.post('../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php', { id: Id, accion: "eliminar" }, function (data) {
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
    //console.log("entra");
    window.location.href = "Alta_archivo.php?accion=editar&id=" + Id + "&usuario=" + user+"&idUsuario="+ $("#idUsuario").val();
}
function quitaracentos(texto) {
  return texto
         .normalize('NFD')
         .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
         .normalize();
}
