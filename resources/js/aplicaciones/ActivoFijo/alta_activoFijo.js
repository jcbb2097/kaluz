
$(document).ready(function(){

	var form = "#formActivoFijo";
	var controller = "../../../WEB-INF/Controllers/ActivoFijo/Controller_activoFijo.php";
	
    $('#tActivoFijo').DataTable(
	{
		"language": 
		{
			"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
		},
		"order": [[ 0, "asc" ]]
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
            noInventarioAnt: {
                   validators: {
                    stringLength: {
                        message: 'El inventario sólo acepta máximo 80 caracteres',
                        max: 80
                    }
                }
            },noInventarioAct: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un número de inventario actual '
                    },
                    stringLength: {
                        message: 'El inventario actual sólo acepta máximo 80 caracteres',
                        max: 80
                    }
                }
            },noSerie: {
                validators: {
                        notEmpty: {
                        message: 'Por favor, Ingrese un numero de serie'
                    },
                    stringLength: {
                        message: 'El numero de serie sólo acepta máximo 15 caracteres',
                        max: 15
                    }
                }
            },
            valor: {
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
            situacionA: {
                validators: {

                    notEmpty: {
                        message: 'Por favor, seleccione una situación activo'
                    }

                }
            },
            area:{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione una Area '
                    }
                 }
			},
			empRes:{
					 validators: {
						stringLength: {
							message: 'El empleado no puede contener máximo 80  caracteres',
							max: 80
						}
					 }


			},
			 empUsa:{
					 validators: {
						   notEmpty: {
							message: 'Por favor, ingresa el empleado '
						},
					   stringLength: {
							message: 'El empleado no puede contener máximo 80  caracteres',
							max: 80
						}
					 }


			},
			observaciones:{
					 validators: {
						  stringLength: {
							message: 'la observación sólo acepta máximo 250 caracteres',
							max: 250
						}
					 }
			
			
			},
			eje:{
					validators:{
						  notEmpty: {
							message: 'Por favor, seleccione un eje'
						} 
				   }
			},
			puesto: {
				validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese el puesto'
                    },
					stringLength: {
                        message: 'el puesto sólo acepta máximo 250 caracteres',
                        max: 250
                    }
                }
			},
			fecha: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese una fecha'
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
									window.location.href="lista_activoFijo.php?nombreUsuario="+$("#usuario").val(); 
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

	/* swal({
	title: '¿Desea eliminar el activo fijo?',
	text: "No podrás revertir los cambios",
	type: 'question',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Eliminar',
	cancelButtonText: 'Cancelar',
	confirmButtonClass: 'btn btn-success',
	cancelButtonClass: 'btn btn-danger',
	buttonsStyling: false,
	reverseButtons: true
	}).then((result) => {
	if (result.value) {
		 $.post('WEB-INF/Controllers/Activofijo/Controler_activofijo.php',{accion:'eliminar',id:Id_Activo},function(data){
			 if (data.toString().indexOf("Error:") === -1) {
			 swal(data,"","success");
		 }else{
			 swal(data,"","warning");
		 }
		 //cambiarContenidosConMensaje('HorasExtras/Alta_horasextras.php',data);
		 //cambiarContenidosConMensaje('#contenidoPublicaciones','HorasExtras/Alta_horasextras.php',data);
		 cambiarContenidosConMensaje('#contenidos','activofijo/lista_activofijo.php?accion=regresar', data);

		 });
	}
	});*/


}

function modificar(Id,user)
{
	//console.log("entra");
	window.location.href="alta_activoFijo.php?accion=editar&id="+Id+"&usuario="+user;   
}
