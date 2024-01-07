
$(document).ready(function(){

	var form = "#formPVP";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_PVP.php";

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
            montoPresupuesto: {
                validators: {
                    stringLength: {
                        message: 'El monto del presupuesto sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El monto del presupuesto acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			presupuestoOrigenes: {
                validators: {
                    stringLength: {
                        message: 'El presupuesto por origenes sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El presupuesto por origenes acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			presupuestoEjercido: {
                validators: {
                    stringLength: {
                        message: 'El presupuesto ejercido sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El presupuesto ejercido acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			costoTiraje: {
                validators: {
                    stringLength: {
                        message: 'El costo del tiraje sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El costo del tiraje acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			pvp: {
                validators: {
					notEmpty:{
						message: 'Por favor, ingrese el PVP'
					},
                    stringLength: {
                        message: 'El pvp sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El pvp acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
					
                }
            },
			coedicion: {
                validators: {
                   
                    numeric: {
                        message: 'El porcentaje de coedicion acepta sólo numeros decimales',
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			produccionUnitario: {
                validators: {
                    stringLength: {
                        message: 'El costo unitario sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El costo unitario acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			produccion: {
                validators: {
                    stringLength: {
                        message: 'El costo de producción general sólo acepta máximo cifras de 11 digitos',
                        max: 11
                    },
                    numeric: {
                        message: 'El costo de producción general acepta sólo numeros decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
					
                }
            },
			patrocinador: {
					validators: {
					notEmpty:{
						message: 'Por favor, ingrese el patrocinador'
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
									cambiarContenido('#ContenidosMenuGeneral','alta_costosPresupuestos.php?aDF=1&IdLibro='+$("#id").val());
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
	window.location.href="alta_impresion.php?accion=editar&id="+Id+"&usuario="+user;
}

function calcularUno (valor) {
    var total = 0;	
  
	var tiraje = document.getElementById('TirajeInformativo').value;
   
    total = (tiraje / valor);
	
   
    document.getElementById("produccionUnitario").value= total;
   
}

function calcularDos (valor) {
    var total = 0;	
    
    var tiraje = document.getElementById('TirajeInformativo').value;
    
    total = (tiraje * valor);
    
  
    document.getElementById("produccion").value=total;
}