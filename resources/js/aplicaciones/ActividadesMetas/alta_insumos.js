
$(document).ready(function(){

	var form = "#formInsumo";
	var controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_insumos.php";
    $('#tInsumos').DataTable(
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
			eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un eje'
                    }
                }
            },
            nivel: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un nivel'
                    }
                }
            },
			amGlobal: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }
                }
            },
			amGeneral: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }
                }
            },
			amParticular: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }
                }
            },
            amSub: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }
                }
            },
            insumo: {
                validators: {
                   	notEmpty: {
                        message: 'Por favor, seleccione una opción'
                    }

                }
            }
		}
    });
    $("#guardar").click(function(event) {

     //limpiarMensaje();
	var bootstrapValidator = $(form).data('bootstrapValidator');
	var NivelAM = $("#nivel").val();
	//var IdEntregable = $("#IdEntregable").val();
	var IdEje = $("#eje").val();
	var IdPeriodo = $("#IdPeriodo").val();
	var IdActividad = $("#IdActividad").val();
	var user = $("#usuario").val();
	var IdTipo = $("#IdTipo").val();
	if(NivelAM == 1 ){
		//console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		bootstrapValidator.enableFieldValidators("amSub", false);

	}

	if(NivelAM == 2 ){
		//console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		bootstrapValidator.enableFieldValidators("amSub", false);

	}

	if(NivelAM == 3 ){
		//console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		bootstrapValidator.enableFieldValidators("amSub", false);
	}

	if(NivelAM == 5 ){
		//console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		bootstrapValidator.enableFieldValidators("amSub", true);

	}
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
									//window.location.href="lista_actividadesMetas.php?nombreUsuario="+$("#usuario").val()+"&IdEje="+$("#IdEje").val()+"&IdTipo="+$("#IdTipo").val()+"&IdPeriodo="+$("#IdPeriodo").val();
									window.location.href="alta_actividadesMetas.php?accion=editar"+"&id="+IdActividad+"&usuario="+user+"&IdEje="+IdEje+"&IdTipo="+IdTipo+"&IdPeriodo="+IdPeriodo;
									//console.log("alta_actividadesMetas.php?accion=editar"+"&id="+IdActividad+"&usuario="+user+"&IdEje="+IdEje+"&IdTipo="+IdTipo+"&IdPeriodo="+IdPeriodo);
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
	var IdEje = $("#eje").val();
	var IdPeriodo = $("#IdPeriodo").val();
	var IdActividad = $("#IdActividad").val();
	var user = $("#usuario").val();
	var IdTipo = $("#IdTipo").val();
	
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
					$.post('../../../WEB-INF/Controllers/ActividadesMetas/Controller_insumos.php',{id:Id, accion:"eliminar"}, function(data)
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
	var IdEje = $("#IdEje").val();
	var IdTipo = $("#IdTipo").val();
	var IdPeriodo = $("#IdPeriodo").val();

	window.location.href="alta_insumos.php?accion=editar&id="+Id+"&usuario="+user+"&IdEje="+IdEje+"&IdTipo="+IdTipo+"&IdPeriodo="+IdPeriodo;
}


function mostrarAM(IdNivel){
	//alert(IdNivel);
	var form = "#formInsumo";
	var bootstrapValidator = $(form).data('bootstrapValidator');

	if(IdNivel == 1 ){

		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		$('#damGlob').show();
		$('#damGen').hide();
		$('#damPar').hide();
		$('#damSub').hide();
	}

	if(IdNivel == 2 ){

		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		bootstrapValidator.enableFieldValidators("amSub", false);
		$('#damGlob').show();
		$('#damGen').show();
		$('#damPar').hide();
		$('#damSub').hide();
	}

	if(IdNivel == 3 ){

		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		bootstrapValidator.enableFieldValidators("amSub", false);
		$('#damGlob').show();
		$('#damGen').show();
		$('#damPar').show();
		$('#damSub').hide();
	}

	if(IdNivel == 5 ){

		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		bootstrapValidator.enableFieldValidators("amSub", true);
		$('#damGlob').show();
		$('#damGen').show();
		$('#damPar').show();
		$('#damSub').show();
	}
}

function obtenerActividadGlobal(IdEje) {
		//console.log("entra:"+IdEje);
		//{dato1: valor1, dato2: valor2}
		var IdTipo= $('#IdTipo').val();
		var IdPeriodo= $('#IdPeriodo').val();
                $.ajax({

                    data: {IdEje:IdEje,IdTipo:IdTipo,IdPeriodo:IdPeriodo},
                    type: "POST",
                    url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
                    success: function (data)
                    {
                        //console.log("Succes!!");
                        $('#amGlobal').html(data);
                        //console.log("Despues de enviar Succes!!");
                        //console.log(data);
                    }
                });

}

function obtenerActividadGeneral(val) {
		//console.log(entra);
                $.ajax({

                    data: "IdGlobal=" + val,
                    type: "POST",
                    url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
                    success: function (data)
                    {
                        //console.log("Succes!!");
                        $('#amGeneral').html(data);
                        //console.log("Despues de enviar Succes!!");
                        //console.log(data);
                    }
                });

            }{

}

function obtenerActividadParticular(val) {
	$.ajax({

		data: "IdGeneral=" + val,
		type: "POST",
		url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
		success: function (data)
		{
			//console.log("Succes!!");
			$('#amParticular').html(data);
			//console.log("Despues de enviar Succes!!");
			//console.log(data);
		}
	});
}

function obtenerSubActividad(val) {
	$.ajax({

		data: "IdPar=" + val,
		type: "POST",
		url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
		success: function (data)
		{
			console.log("Succes!!");
			$('#amSub').html(data);
			//console.log("Despues de enviar Succes!!");
			console.log(data);
		}
	});
}

function obtenerEntregable(val) {
	tipo = 'Insumo';
	$.ajax({

		data: {IdActividad:val,Insumo:tipo},
		type: "POST",
		url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
		success: function (data)
		{
			//console.log("Succes!!");
			$('#insumo').html(data);
			//console.log("Despues de enviar Succes!!");
			console.log(data);
		}
	});
}


