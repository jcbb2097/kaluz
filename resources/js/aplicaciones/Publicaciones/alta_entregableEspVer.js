$(document).ready(function () {
	var form = "#formModalEntregable";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_versionEntregable.php";

	$('#gridVersionEntregables').DataTable(
		{
			destroy: true,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ninguna versión disponible",
				"sInfo": "Mostrando un total de _TOTAL_ archivos",
				"sInfoEmpty": "Te recomendamos dar de alta una versión a un entregable",
				"sInfoFiltered": "(filtrado de un total de _MAX_ versiones)",
				"sInfoPostFix": "",
				"sSearch": "Filtrar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": ">>",
					"sPrevious": "<<"
				}
			},
			"order": [[0, "asc"]],
			"ordering": false,

		});
	//console.log('Entro');
	$("#guardarVersion").click(function (event) {

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
			formData.append('accion', $("#accionModal").val());
			formData.append('id', $("#IdEntregableEspVer").val());
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
										$(form)[0].reset();
										$('#ModalEntVer').modal('hide');
										if ($("#accion").val() == 'editar') {
											cambiarContenido('#ContenidosMenuPar', 'alta_definirFormato.php?aDF=1&IdLibro=' + $("#id").val());
										} else {
											console.log('No deberia entrar aqui');
											//cambiarContenido('#ContenidosMenuPar','alta_definirFormato.php?aDF=1');
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

function eliminarArchivoVerr(IdTextoSC) {
	/* 	//var con = "'"+controller+"'";
		//alert(IdFormulario);
		$.confirm({
			icon: 'glyphicon glyphicon-minus-sign',
			title: '¿Desea eliminar el archivo?',
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
						$.post('../../../WEB-INF/Controllers/Publicaciones/Controller_gestionarInstitucionales.php', { IdTextoSC: IdTextoSC, accion: "eliminar" }, function (data) {
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
											if($("#cambiarPantalla").val() === 'SC'){
											if( $("#accion").val() === 'editar'){
												cambiarContenido('#ContenidosMenuSubSub','alta_textoSecretariaCultura.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
											}else{
													cambiarContenido('#ContenidosMenuSubSub','alta_textoSecretariaCultura.php?aDF=1&IdLibro='+$("#IdLibro").val());
											}
										}else if($("#cambiarPantalla").val() === 'INBAL'){	
											if($("#accion").val() === 'editar'){
												cambiarContenido('#ContenidosMenuSubSub','alta_textoINBAL.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
											}else{
												cambiarContenido('#ContenidosMenuSubSub','alta_textoINBAL.php?aDF=1&IdLibro='+$("#IdLibro").val());
											}
										}else if( $("#cambiarPantalla").val() === 'MPBA'){	
											if($("#accion").val() === 'editar'){
												cambiarContenido('#ContenidosMenuSubSub','alta_textoMPBA.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
											}else{
												cambiarContenido('#ContenidosMenuSubSub','alta_textoMPBA.php?aDF=1&IdLibro='+$("#IdLibro").val());
											}
										}else if($("#cambiarPantalla").val() === 'PATROCINADOR'){	
											if($("#accion").val() === 'editar'){
												cambiarContenido('#ContenidosMenuSubSub','alta_textoPatrocinador.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
											}else{
												cambiarContenido('#ContenidosMenuSubSub','alta_textoPatrocinador.php?aDF=1&IdLibro='+$("#IdLibro").val());
											}
										}else if($("#cambiarPantalla").val() === 'COEDITOR'){	
											if($("#accion").val() === 'editar'){
												cambiarContenido('#ContenidosMenuSubSub','alta_textoCoeditorOtros.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
											}else{
												cambiarContenido('#ContenidosMenuSubSub','alta_textoCoeditorOtros.php?aDF=1&IdLibro='+$("#IdLibro").val());
											}
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
												//location.reload();
												//console.log('Entra aqui');
											}
	
										}
									}
								});
	
							}
	
						});
					}
				},
				cancelar: function () {
					//$.alert('Cancelado!');
				}
			}
		}); */
}
function eliminarArchivoVer(IdEntregableEsp, IdArchivoPreliminar, IdFormulario) {
	//var con = "'"+controller+"'";
	//alert(IdFormulario);
	$.confirm({
		icon: 'glyphicon glyphicon-minus-sign',
		title: '¿Desea eliminar el archivo?',
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
					$.post('../../../WEB-INF/Controllers/Publicaciones/Controller_versionEntregable.php', { IdEntregableEspVer: IdEntregableEsp, IdArchivoPreliminar: IdArchivoPreliminar, accion: "eliminar", formulario: IdFormulario }, function (data) {
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
											//location.reload();

											$('#ModalEntVer').modal('hide');
											if ($("#accion").val() == 'editar') {
												if (IdFormulario == 1) {
													cambiarContenido('#ContenidosMenuPar', 'alta_definirFormato.php?aDF=1&IdLibro=' + $("#id").val());

												} else if (IdFormulario == 2) {
													cambiarContenido('#ContenidosMenuPar', 'alta_definirContenidos.php?aDF=1&IdLibro=' + $("#id").val());

												} else if (IdFormulario == 3) {
													cambiarContenido('#ContenidosMenuPar', 'alta_definirCaracteristicasTecnicas.php?aDF=1&IdLibro=' + $("#id").val());

												} else if (IdFormulario == 24) {
													cambiarContenido('#ContenidosMenuPar', 'alta_definirColaboradores.php?aDF=1&IdLibro=' + $("#id").val());

												}
											} else {
												console.log('No deberia entrar aqui');
												//cambiarContenido('#ContenidosMenuPar','alta_definirFormato.php?aDF=1');
											}
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
											//location.reload();
											//console.log('Entra aqui');
										}

									}
								}
							});

						}

					});
				}
			},
			cancelar: function () {
				//$.alert('Cancelado!');
			}
		}
	});
}