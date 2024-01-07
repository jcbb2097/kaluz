$(document).ready(function () {

    var form = "#formArchivo";
    var controller = "../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php";
    var form2 = "#Formcategorias";
    var controller2 = "../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_categorias.php";
  
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
            cate: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, selecione una categoría'
                    }
                }
            }, area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Seleccione el área del entregable'
                    }
                }
            },
            categoria: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Seleccione el tipo de entregable'
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
                          formData.append(key, value,quitaracentos(files[0].name));
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
                                        window.location.href = "Lista_entregable.php?nombreUsuario=" + $("#usuario").val()+"&idUsuario="+ $("#idUsuario").val()+"&tipoPerfil=1";
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
    window.location.href = "Alta_entregable.php?accion=editar&id=" + Id + "&nombreUsuario=" + user+"&idUsuario="+ $("#idUsuario").val()+"&tipoPerfil=1";
}
function quitaracentos(texto) {
  return texto
         .normalize('NFD')
         .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
         .normalize();
}
