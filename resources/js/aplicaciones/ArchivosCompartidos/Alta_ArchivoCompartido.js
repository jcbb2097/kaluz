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
                        message: 'Por favor, Ingrese una descripción del archivo'
                    },
                    stringLength: {
                        message: 'La descripción sólo acepta máximo 250 caracteres',
                        max: 250
                    }
                }
            }, ano: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el periodo del archivo'
                    }
                }
            },categoria: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija un tipo de archivo'
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
                        message: 'Por favor, Elija la persona que sube el archivo'
                    }
                }
            }, area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el Área que sube el archivo'
                    }
                }
            }, cate: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el tipo de archivo'
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
      let bandera = 1;
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0) {
            //console.log("todo validado");
            // cargando();
            var inputs = $("input[type=file]"),
                files = [];

            for (var i = 0; i < inputs.length; i++) {




                  files.push(inputs.eq(i).prop("files")[0]);


            }

            //if(bandera == 1){
            var origenasunto = $('#origenasunto').val();
            var origen = $('#origen').val();


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
                                        if(origenasunto > 0){//si se abre desde asuntos
                                          console.log("ocultando ");
                                          //$('#cerrar_archivos').click();



                                          padre = $(window.parent.document);

                                          $(padre).find('#cerrar_archivos').click();

                                          //$("#Modal_altaarchivo").modal({backdrop: false});;//ocultamos el modal

                                        }else{
                                          window.location.href = "lista_archivo.php?nombreUsuario=" + $("#nombreUsuario").val() + "&tipoPerfil=" + $("#tipoPerfil").val() + "&idUsuario=" + $("#idUsuario").val();
                                        }

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

          //}

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

    $(document).on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo


	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

	if(fileSize > 4000000){
		alert("El archivo no debe superar los 4MB, si es mayor, adjuntar un link ");
		this.value = '';
		this.files[0].name = '';
	}
  // else{
	// 	// recuperamos la extensión del archivo
	// 	var ext = fileName.split('.').pop();
  //
	// 	// Convertimos en minúscula porque
	// 	// la extensión del archivo puede estar en mayúscula
	// 	ext = ext.toLowerCase();
  //
	// 	// console.log(ext);
	// 	switch (ext) {
	// 		case 'jpg':
	// 		case 'jpeg':
	// 		case 'png':
	// 		case 'pdf': break;
	// 		default:
	// 			alert('El archivo no tiene la extensión adecuada');
	// 			this.value = ''; // reset del valor
	// 			this.files[0].name = '';
	// 	}
	// }
})

});
