
$(document).ready(function(){

	var form = "#formGestionarImagenes";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_gestionarImagenes.php";

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
            catalograficas: {
                validators: {
                    stringLength: {
                        message: 'El número de imágenes catalográficas sólo acepta máximo cifras de 9 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El número de imágenes catalográficas no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
			complementarias: {
                validators: {
                    stringLength: {
                        message: 'El número de imágenes complementarias sólo acepta máximo cifras de 9 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El imágenes complementarias no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
			totalImagenes: {
                validators: {
                    stringLength: {
                        message: 'El total de imágenes sólo acepta máximo cifras de 9 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El total de imágenes no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
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
									//window.location.href="lista_publicaciones.php?nombreUsuario="+$("#usuario").val();
									/*if ($("#accion").val() == 'guardar'){
										cambiarContenido('#ContenidosMenuGeneral','alta_imagenes.php?aDF=1');
									}else if($("#accion").val() == 'editar'){
										cambiarContenido('#ContenidosMenuGeneral','alta_imagenes.php?aDF=1&IdCatalogo='+$("#id").val());
									}*/
								cambiarContenido('#ContenidosMenuGeneral','alta_imagenes.php?aDF=1&IdLibro='+$("#id").val());	
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
					$.post('../../../WEB-INF/Controllers/ActivoFijo/Controller_activoFijo.php',{id:Id, accion:"eliminar"}, function(data)
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
	//console.log("entra");
	window.location.href="alta_GestionarImagenes.php?accion=editar&id="+Id+"&usuario="+user;
}
