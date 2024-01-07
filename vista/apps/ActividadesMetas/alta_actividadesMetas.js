
$(document).ready(function(){

	var form = "#formAM";
	var controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";
    var cont = 0;

   $('#tAM thead tr').clone(true).appendTo( '#tAM thead' );
   $('#tAM thead tr:eq(1) th').each( function (i) {
       cont++;
       if(cont != 1 ){
         var title = $(this).text();
         $(this).html( '<input type="text" style="width : 90px;" placeholder="'+title+'" />' );

         $( 'input', this ).on( 'keyup change', function () {
             if ($('#tAM').DataTable().column(i).search() !== this.value ) {
                 $('#tAM').DataTable()
                     .column(i)
                     .search( this.value )
                     .draw();
             }
         } );
       }
   } );
	
	$('#tAM').DataTable(
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
			IdPeriodo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Periodo'
                    }
                }
            },
            IdEje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
			IdTipo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de actividad'
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
			area: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un área'
                    }
                }
            },
            orden: {
                   validators: {
					notEmpty: {
                        message: 'Por favor, ingrese un orden'
                    },   
                    stringLength: {
                        message: 'El orden sólo acepta máximo 3 numeros',
                        max: 3
                    },
                    integer: {
                        message: 'El orden no acepta decimales'
                    },
					greaterThan: {
                            value: 0,
                            message: 'El valor debe ser mayor o igual a 0'
                    }
                }
            },
            nombreAM: {
                   validators: {
                   	notEmpty: {
                        message: 'Por favor, Ingrese un nombre'
                    },
                    stringLength: {
                        message: 'El nombre sólo acepta máximo 300 caracteres',
                        max: 300
                    }
					
			
                }
            },
            numeracion: {
                   validators: {
                   	notEmpty: {
                        message: 'Por favor, Ingrese la numeración'
                    },
                    stringLength: {
                        message: 'El campo sólo acepta máximo 300 caracteres',
                        max: 300
                    }
					
			
                }
            },
            categoría: {
                   validators: {
                   	notEmpty: {
                        message: 'Por favor, Ingrese la numeración'
                    },
                    stringLength: {
                        message: 'El campo sólo acepta máximo 300 caracteres',
                        max: 300
                    }
					
			
                }
            }
		}
    });
    $("#guardar").click(function(event) {

     //limpiarMensaje();
	var bootstrapValidator = $(form).data('bootstrapValidator'); 
	var NivelAM = $("#nivel").val();
	//$('#damGlob').show();
	//$('#damGen').show();
	//$('#damPar').show();
	if(NivelAM == 1 ){
		console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", false);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		
	}

	if(NivelAM == 2 ){
		console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		
	}

	if(NivelAM == 3 ){
		console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		
	}

	if(NivelAM == 5 ){
		console.log(NivelAM);
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		
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
									window.location.href="lista_actividadesMetas.php?nombreUsuario="+$("#usuario").val()+"&IdEje="+$("#IdEje").val()+"&IdTipo="+$("#IdTipo").val()+"&IdPeriodo="+$("#IdPeriodo").val();
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

function eliminar(Id,IdEntregable){
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
					$.post('../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php',{id:Id,IdEntregable:IdEntregable ,accion:"eliminar"}, function(data)
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
function Periodo(periodo){
	//let controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";   
    let controller = "lista_actividadesMetas.php";
	let eje = $("#eje").val();
	let cat = $("#categoria").val();
	let scat = $("#scategoria").val();
	let Tipo = $("#tipo").val();
	$.post(controller, {"Periodo":"Periodo","IdPeriodo":periodo,"IdEje":eje,"cat":cat,"scat":scat,"Tipo":Tipo}).done(function (data) {
		//alert(data);
		$("#bod").html(data);
        //$( "#datos" ).load( "lista_actividadesMetas.php" );
    }); 
}
function Seje(eje){
	//let controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";   
    let controller = "lista_actividadesMetas.php";
	let cat = $("#categoria").val();
	let periodo = $("#periodo").val();
	let scat = $("#scategoria").val();
	let Tipo = $("#tipo").val();
	$.post(controller, {"Eje":"Eje","IdPeriodo":periodo,"IdEje":eje,"cat":cat,"scat":scat,"Tipo":Tipo}).done(function (data) {
		//alert(data);
		$("#bod").html(data);
        //$( "#datos" ).load( "lista_actividadesMetas.php" );
    }); 
}
function Cate(cat){
	let eje = $("#eje").val();
	let scat = $("#scategoria").val();
	let Tipo = $("#tipo").val();
	let periodo = $("#periodo").val();

	//let controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";   
    let controller = "lista_actividadesMetas.php";
	$.post(controller, {"Categoria":"Categoria","IdPeriodo":periodo,"IdEje":eje,"cat":cat,"scat":scat,"Tipo":Tipo}).done(function (data) {
		//alert(data);
		$("#bod").html(data);
        //$( "#datos" ).load( "lista_actividadesMetas.php" );
    }); 
}
function Scate(scat){
	let eje = $("#eje").val();
	let cat = $("#categoria").val();
	let Tipo = $("#tipo").val();
	let periodo = $("#periodo").val();

	//let controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";   
    let controller = "lista_actividadesMetas.php";
	$.post(controller, {"Scategoria":"Scategoria","IdPeriodo":periodo,"IdEje":eje,"cat":cat,"scat":scat,"Tipo":Tipo}).done(function (data) {
		//alert(data);
		$("#bod").html(data);
        //$( "#datos" ).load( "lista_actividadesMetas.php" );
    }); 
}
function Tipo(Tipo){
	let eje = $("#eje").val();
	let cat = $("#categoria").val();
	let scat = $("#scategoria").val();
	let periodo = $("#periodo").val();

	//let controller = "../../../WEB-INF/Controllers/ActividadesMetas/Controller_actividadesMetas.php";   
    let controller = "lista_actividadesMetas.php";
	$.post(controller, {"sTipo":"sTipo","IdPeriodo":periodo,"IdEje":eje,"cat":cat,"scat":scat,"Tipo":Tipo}).done(function (data) {
		//alert(data);
		$("#bod").html(data);
        //$( "#datos" ).load( "lista_actividadesMetas.php" );
    }); 
}
function eliminarInsumo(Id){
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
	var categoria = $("#categoria").val();
	var scategoria = $("#scategoria").val();
	
	window.location.href="alta_actividadesMetas.php?accion=editar&id="+Id+"&usuario="+user+"&IdEje="+IdEje+"&IdTipo="+IdTipo+"&IdPeriodo="+IdPeriodo+"&categoria="+categoria+"&scategoria="+scategoria;
}

function agregarInsumos(IdEntregable,IdEje,IdPeriodo,IdActividad,user,IdTipo)
{
	
	window.location.href="alta_insumos.php?accion=guardar&IdEntregable="+IdEntregable+"&IdActividad="+IdActividad+"&usuario="+user+"&IdEje="+IdEje+"&IdTipo="+IdTipo+"&IdPeriodo="+IdPeriodo;
}

function mostrarAM(IdNivel){
	//alert(IdNivel);
	var form = "#formAM";
	var bootstrapValidator = $(form).data('bootstrapValidator');
        
	if(IdNivel == 1 ){
		
		bootstrapValidator.enableFieldValidators("amGlobal", false);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		$('#damGlob').hide();
		$('#damGen').hide();
		$('#damPar').hide();
	}

	if(IdNivel == 2 ){
		
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", false);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		$('#damGlob').show();
		$('#damGen').hide();
		$('#damPar').hide();
	}

	if(IdNivel == 3 ){
		
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", false);
		$('#damGlob').show();
		$('#damGen').show();
		$('#damPar').hide();
	}

	if(IdNivel == 5 ){
		
		bootstrapValidator.enableFieldValidators("amGlobal", true);
		bootstrapValidator.enableFieldValidators("amGeneral", true);
		bootstrapValidator.enableFieldValidators("amParticular", true);
		$('#damGlob').show();
		$('#damGen').show();
		$('#damPar').show();
	}
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
                        console.log(data);
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
function ScategoriaE(val) {

    $.ajax({
        data: "ScategoriaE=" + val,
        type: "POST",
        url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
        success: function (data)
        {
			//alert(data)
            //console.log("Succes!!");
            $('#categoria').html(data);
            //console.log("Despues de enviar Succes!!");
            console.log(data);
        }
    });
}
function Scategoria(val) {
    $.ajax({
        data: "Scategoria=" + val,
        type: "POST",
        url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
        success: function (data)
        {
            //console.log("Succes!!");
            $('#scategoría').html(data);
            //console.log("Despues de enviar Succes!!");
            //console.log(data);
        }
    });
}
function Ecategoria(val) {
    $.ajax({
        data: "Ecategoria=" + val,
        type: "POST",
        url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
        success: function (data)
        {
            //console.log("Succes!!");
            $('#categoría').html(data);
            //console.log("Despues de enviar Succes!!");
            //console.log(data);
        }
    });
}
function obtenerActividadG(val) {
	let Periodo= $("#IdPeriodo").val();
	let IdEje= $("#IdEje").val();
	
    $.ajax({
        data: {"ActividadG":val,"Periodo": Periodo,"IdEje":IdEje},
        type: "POST",
        url: "../../../WEB-INF/Controllers/ActividadesMetas/Controller_cargaSelect.php",
        success: function (data)
        {
			//alert(val)
            //console.log("Succes!!");
            $('#amGlobal').html(data);
            //console.log("Despues de enviar Succes!!");
            console.log(data);
        }
    });
}
