
$(document).ready(function(){

	var form = "#formDisenioyFormacion";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_CoordinarDisenioFormacion.php";

   /*$(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	medidaFinal: {
                validators: {
                    stringLength: {
                        message: 'La medida Final sólo acepta máximo 20 caracteres',
                        max: 20
                    }
                }
            },
           	numeroPaginas: {
                validators: {
                    stringLength: {
                        message: 'El número de páginas sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El número de páginas no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            anioEdicion: {
                validators: {
                    stringLength: {
                        message: 'El año de edición sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El año de edición no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            tirajeTotal: {
                validators: {
                    stringLength: {
                        message: 'El tiraje total sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El tiraje total no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            tirajeEspanol: {
                validators: {
                    stringLength: {
                        message: 'El tiraje español sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El tiraje español no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            tirajeIngles: {
                validators: {
                    stringLength: {
                        message: 'El tiraje inglés sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El tiraje inglés no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            tirajeBilingue: {
                validators: {
                    stringLength: {
                        message: 'El tiraje bilingüe sólo acepta máximo cifras de 4 digitos',
                        max: 4
                    },
                    integer: {
                        message: 'El tiraje bilingüe no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            }
		}
    });*/
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
									cambiarContenido('#ContenidosMenuGeneral','alta_disenioFormacion.php?aDF=1&IdLibro='+$("#id").val());
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
	window.location.href="alta_disenioFormacion.php?accion=editar&id="+Id+"&usuario="+user;
}

function agregarColaborador(){

    var contador = parseInt($("#totalDetallesC").val());

    var html = '<div id="DColaborador'+contador+'" name="DColaborador'+contador+'" class="panel panel-default">'+
					'<div class="row">'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="pdfMaquetas'+contador+'">Maqueta (PDF):</label>'+
														'<div class="medios">'+
					                    '<div class="input-file">'+
					                      '<input type="file" id="pdfMaquetas'+contador+'" name="pdfMaquetas'+contador+'" onchange="cambiarMaquetas('+contador+')" accept=".pdf" value=""/>'+
					                      '<label for="pdfMaquetas'+contador+'">'+
					                        '<span id="file_maquetas'+contador+'"></span>'+
					                        '<span style="float:right;">Seleccionar</span>'+
					                      '</label>'+
					                    '</div>'+
					                  '</div>'+
                            '<input type="hidden" id="pdfMaqueta'+contador+'" name="pdfMaqueta'+contador+'"/>'+
                        '</div>'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="pdfPropuestaGraficas'+contador+'">Propuesta Gráfica (PDF):</label>'+
														'<div class="medios">'+
					                    '<div class="input-file">'+
					                      '<input type="file" id="pdfPropuestaGraficas'+contador+'" name="pdfPropuestaGraficas'+contador+'" onchange="cambiarPropuestas('+contador+')" accept=".pdf" value=""/>'+
					                      '<label for="pdfPropuestaGraficas'+contador+'">'+
					                        '<span id="file_propuestas'+contador+'"></span>'+
					                        '<span style="float:right;">Seleccionar</span>'+
					                      '</label>'+
					                    '</div>'+
					                  '</div>'+
                            // '<input type="file" id="pdfPropuestaGraficas'+contador+'" name="pdfPropuestaGraficas'+contador+'" class="form-control" accept=".pdf"/>'+
                            '<input type="hidden" id="pdfPropuestaGrafica'+contador+'" name="pdfPropuestaGrafica'+contador+'" />'+
                        '</div>'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="indice'+contador+'">Indice (PDF):</label>'+
														'<div class="medios">'+
					                    '<div class="input-file">'+
					                      '<input type="file" id="indice'+contador+'" name="indice'+contador+'" onchange="cambiarIndices('+contador+')" accept=".pdf" value=""/>'+
					                      '<label for="indice'+contador+'">'+
					                        '<span id="file_indices'+contador+'"></span>'+
					                        '<span style="float:right;">Seleccionar</span>'+
					                      '</label>'+
					                    '</div>'+
					                  '</div>'+
                            // '<input type="file" id="indice'+contador+'" name="indice'+contador+'" class="form-control" accept=".pdf"/>'+
                        '</div>'+

                    '</div>'+
                    '<div class="row">'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="ilustrador'+contador+'">Ilustrador:</label>'+
														'<div class="select-input-2">'+
                            '<select id="ilustrador'+contador+'" name="ilustrador'+contador+'" class="select-2">'+
                            '</select>'+
														'<span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span></div>'+
                        '</div>'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="disenador'+contador+'">Diseñador:</label>'+
														'<div class="select-input-2">'+
                            '<select id="disenador'+contador+'" name="disenador'+contador+'" class="select-2">'+
                            '</select>'+
														'<span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span></div>'+
                        '</div>'+
                        '<div class="form-group form-group-sm col-md-4 col-sm-4 col-xs-4">'+
                            '<label for="fechaEntregaIndice'+contador+'">Fecha entrega índice:</label>'+
                            '<input type="date" id="fechaEntregaIndice'+contador+'" name="fechaEntregaIndice'+contador+'" class=""/>'+
                        '</div>'+
                    '</div>'+
                        '<div class="row">'+
                            '<div style="text-align: right;" class="form-group col-md-12">'+
                                '<button id="agregarC'+contador+'" name="agregarC'+contador+'" type="button" class="btn btn-xs" onclick="agregarColaborador();">'+
                            '<span class="glyphicon glyphicon-plus"></span> Agregar diseño y formaci&oacute;n'+
                             '</button>&nbsp;&nbsp;'+
                             '<button id="eliminarC'+contador+'" name="eliminarC'+contador+'" type="button" class="btn btn-xs" onclick="eliminarColaborador('+contador+');">'+
                            '<span class="glyphicon glyphicon-trash"></span> Eliminar diseño y formaci&oacute;n'+
                             '</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                  $("#todosColaboradores").append(html);
                //$('#traductor'+contador).append($("#traductor0 > option").clone());
                //$('#corrector'+contador).append($("#corrector0 > option").clone());
                $('#disenador'+contador).append($("#disenador0 > option").clone());
                $('#ilustrador'+contador).append($("#ilustrador0 > option").clone());
                //$('#imprenta'+contador).append($("#imprenta0 > option").clone());
                contador = contador+1;
                $("#totalDetallesC").val(contador);

              /*  var form = "#formCatalogos";
                    $(form).bootstrapValidator('addField', "imprenta"+contador, {
                    validators: {
                        notEmpty: {
                            message: 'Selecciona una imprenta'
                        }
                    }
                        });

                              var bootstrapValidator = $(form).data('bootstrapValidator');
                    bootstrapValidator.enableFieldValidators("imprenta"+contador, true);*/
}
function eliminarColaborador(indice){
    $("#DColaborador"+indice).remove();
    var auxContador=parseInt($("#totalDetallesC").val());
    auxContador=auxContador-1;
    $("#totalDetallesC").val(auxContador);
    /*var form = "#formCatalogos";
    var bootstrapValidator = $(form).data('bootstrapValidator');
                    bootstrapValidator.enableFieldValidators("imprenta"+indice, false);*/
}
