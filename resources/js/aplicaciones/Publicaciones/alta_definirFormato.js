
$(document).ready(function(){

	var form = "#formDefinirFormato";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_definirFormato.php";
	
	$('#indicadorDefinirFormato').DataTable(
        {
          "language": {
                  "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún insumo disponible",
          "sInfo":           "Mostrando un total de _TOTAL_ insumo-entregable",
          "sInfoEmpty":      "Te recomendamos dar de alta un insumo y asociarlo a un entregable",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ insumo-entregable)",
          "sInfoPostFix":    "",
          "sSearch":         "Filtrar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     ">>",
              "sPrevious": "<<"
			}
			},
            "order": [[ 0, "asc" ]],
            "ordering": false
    });
	
	$('#gridVersionEntregables').DataTable(
        {
          "language": {
                  "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ninguna versión disponible",
          "sInfo":           "Mostrando un total de _TOTAL_ archivos",
          "sInfoEmpty":      "Te recomendamos dar de alta una versión a un entregable",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ versiones)",
          "sInfoPostFix":    "",
          "sSearch":         "Filtrar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     ">>",
              "sPrevious": "<<"
			}
			},
            "order": [[ 0, "asc" ]],
            "ordering": false
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
			anio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un año'
                    }
                }
            },
			exposicion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una exposición'
                    }
                }
            },
           eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un eje'
                    }
                }
            },
            actividad: {
                   validators: {
                   	notEmpty: {
                        message: 'Por favor, Ingrese una actividad'
                    }

                }
            },titulo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un título'
                    }
                }
            },isbn: {
                validators: {
                        notEmpty: {
                        message: 'Por favor, Ingrese un numero de isbn'
                    },
                    stringLength: {
                        message: 'El numero de isbn sólo acepta máximo 17 caracteres',
                        max: 17
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
									if($("#accion").val() == 'editar'){
										cambiarContenido('#ContenidosMenuPar','alta_definirFormato.php?aDF=1&IdLibro='+$("#id").val());
									}else{
										cambiarContenido('#ContenidosMenuPar','alta_definirFormato.php?aDF=1');
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
	window.location.href="alta_activoFijo.php?accion=editar&id="+Id+"&usuario="+user;
}
function habilitarInstitucion(Id){
	//console.log("entra");
 	if (Id == 2 || Id == 3 ) {
 		$("#instituciones").prop('disabled', false);
 	}else{
 		$("#instituciones").prop('disabled', true);
 	}
}

function mostrarActividades(IdEje,IdActividad){
 	//console.log(IdEje);
 	//console.log(IdActividad);
 	if(IdEje == 0 && IdActividad == 0){
   		$("#actividad").load("../../../WEB-INF/Controllers/Publicaciones/Controller_cargaSelect.php",{IdEje:$("#eje").val()});
    }else{
     	//$("#actividad").load("WEB-INF/Controllers/Ajax/CargaSelect.php",{eje:eje,select:"alex3",actividad:actividad});
    }
}