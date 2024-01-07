$(document).ready(function () {

	var form = "#formHX";
	var controller = "../../../WEB-INF/Controllers/HorasExtras/Controler_HorasExtras.php";

	$('#tHoras').DataTable(
		{
			"language":
			{
				"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
			},
			"order": [[0, "asc"]]
			//"ordering": false
        });
        $('table.display').DataTable(
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
			}, Personal: {
				validators: {
					notEmpty: {
						message: 'Por favor, Seleccione a la persona que convoca el acuerdo'
					}
				}
			}, Area: {
				validators: {
					notEmpty: {
						message: 'Por favor, Seleccione el área de la persona'
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
			},
			fecha: {
				validators: {
					notEmpty: {
						message: 'Por favor, ingresa la Fecha '
					}

				}
			},
			time: {
				validators: {

					notEmpty: {
						message: 'Por favor, ingresa el total de minutos  '
					},greaterThan: {
						value: 0.1,
						message: 'El valor debe ser mayor a 0.1'
				}

				}
			},
			Justificacion: {
				validators: {
					notEmpty: {
						message: 'Por favor, ingresa una pequeña Justificación '
					},stringLength: {
						message: 'La justificación tiene un  máximo de 50  caracteres',
						max: 50
					}

				}
			},
			Costos: {
				validators: {
					notEmpty: {
						message: 'Por favor, ingresa el Costo '
					},greaterThan: {
						value: 0.1,
						message: 'El valor debe ser mayor a 0.1'
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
                                       window.location.href="Lista_horasextras.php?nombreUsuario="+$("#usuario").val(); 
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
                        $.post('../../../WEB-INF/Controllers/HorasExtras/Controler_HorasExtras.php',{id:Id, accion:"eliminar"}, function(data)
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
	window.location.href="Alta_horasextras.php?accion=editar&id="+Id+"&usuario="+user;   
}
