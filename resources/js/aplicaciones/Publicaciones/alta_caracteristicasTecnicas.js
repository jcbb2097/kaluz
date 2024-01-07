
$(document).ready(function(){

	var form = "#formCaracteristicasTecnicas";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_CaracteristicasTecnicas.php";
	$('#indicadorCaracTecnicas').DataTable(
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
									//cambiarContenido('#ContenidosMenuPar','alta_definirCaracteristicasTecnicas.php?aDC=1');
									if($("#accion").val() == 'editar'){
										cambiarContenido('#ContenidosMenuPar','alta_definirCaracteristicasTecnicas.php?accion=editar&aDC=1&IdLibro='+$("#id").val());
									}
									if($("#accion").val() == 'guardar'){
										cambiarContenido('#ContenidosMenuPar','alta_definirCaracteristicasTecnicas.php?accion=editar&aDC=1');
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
	console.log("entra");
	//window.location.href="alta_definirCaracteristicasTecnicas.php?accion=editar&id="+Id+"&usuario="+user;
}

function agregarPapel(){
	//console.log('entra agregar');
	var contador = parseInt($("#totalPapelR").val());

	 var html ='<div id="papelRecubrimiento'+contador+'" class="panel panel-default col-md-6 col-sm-6 col-xs-6" >'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-6 col-sm-6 col-xs-6">'+
                            '<div class="select-input-2"><select id="tipoPapelR'+contador+'" name="tipoPapelR'+contador+'" class="select-2" >'+

                            '</select></select><span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span>'+
                            '</div></div>'+
                            '<div class="form-group form-group-sm col-md-6 col-sm-6 col-xs-6">'+
                            	'<input type="text" id="paginasPapelR'+contador+'" name="paginasPapelR'+contador+'" class=""/>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-12 col-sm-12 col-xs-12">'+
                                '<input type="text" id="descPapelR'+contador+'" name="descPapelR'+contador+'" class=""/>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row" >'+
                           '<div style="float:right;    margin-right: 17px;">'+
                            '<button id="agregarPapelR'+contador+'" name="agregarPapelR'+contador+'" type="button" class="btn btn-default btn-xs" onclick="agregarPapel();"><span class="glyphicon glyphicon-plus"></span> agregar</button>'+
                            '&nbsp;&nbsp;'+
                            '<button id="eliminarPapel'+contador+'" name="eliminarPapel'+contador+'" type="button" class="btn btn-xs" onclick="eliminarPapel('+contador+');">'+
                            '<span class="glyphicon glyphicon-trash"></span> Borrar'+
                            '</button>'+
                        '</div>'+
                    '</div>';
                '</div>';
                     $("#principalPR").append(html);
                     $('#tipoPapelR'+contador).append($("#tipoPapelR0 > option").clone());
                    contador = contador+1;
                	$("#totalPapelR").val(contador);
}

function eliminarPapel(indice){

	 $("#papelRecubrimiento"+indice).remove();

    var auxContador=parseInt($("#totalPapelR").val());
    auxContador=auxContador-1;
    $("#totalPapelR").val(auxContador);
}

function agregarImp(){
	//console.log('entra agregar');
	var contador = parseInt($("#totalImpresion").val());

	var html ='<div id="Impresion'+contador+'" class="panel panel-default col-md-4 col-sm-4 col-xs-4" >'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-12 col-sm-12 col-xs-12">'+
                            '<div class="select-input-2"><select id="tipoImpresion'+contador+'" name="tipoImpresion'+contador+'" class="select-2" >'+

                            '</select></select><span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span>'+
                            '</div>'+
                        '</div></div>'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-12 col-sm-12 col-xs-12">'+
                                '<input type="text" id="descImpresion'+contador+'" name="descImpresion'+contador+'" class=""/>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                           '<div style="float:right;    margin-right: 17px;">'+
	                            '<button id="agregarImpresion'+contador+'" name="agregarImpresion'+contador+'" type="button" class="btn btn-default btn-xs" onclick="agregarImp();"><span class="glyphicon glyphicon-plus"></span> agregar</button>'+
	                            ''+
	                            '&nbsp;&nbsp;'+
	                            '<button id="eliminarImpresion'+contador+'" name="eliminarImpresion'+contador+'" type="button" class="btn btn-xs" onclick="eliminarImpresion('+contador+');">'+
	                            '<span class="glyphicon glyphicon-trash"></span> Borrar'+
	                            '</button></div>'+
                        	'</div>'+
                        '</div>'+
                    '';
                     $("#principalImpresion").append(html);
                     $('#tipoImpresion'+contador).append($("#tipoImpresion0 > option").clone());
                    contador = contador+1;
                	$("#totalImpresion").val(contador);
}

function eliminarImpresion(indice){

	 $("#Impresion"+indice).remove();

    var auxContador=parseInt($("#totalImpresion").val());
    auxContador=auxContador-1;
    $("#totalImpresion").val(auxContador);
}
function agregarAcabados(){
	//console.log('entra agregar');
	var contador = parseInt($("#totalAcabado").val());
	var html ='<div id="Acabados'+contador+'" class="panel panel-default col-md-4 col-sm-4 col-xs-4">'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-12 col-sm-12 col-xs-12">'+
                            '<div class="select-input-2"><select id="tipoAcabado'+contador+'" name="tipoAcabado'+contador+'" class="select-2" >'+

                            '</select></select><span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span>'+
                            '</div>'+
                        '</div></div>'+
                        '<div class="row">'+
                            '<div class="form-group form-group-sm col-md-12 col-sm-12 col-xs-12">'+
                                '<input type="text" id="descAcabado'+contador+'" name="descAcabado'+contador+'" class=""/>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                           '<div style="float:right;    margin-right: 17px;">'+
	                            '<button id="agregarAcabado'+contador+'" name="agregarAcabado'+contador+'" type="button" class="btn btn-default btn-xs" onclick="agregarAcabados();"><span class="glyphicon glyphicon-plus"></span> agregar</button>'+
	                            ''+
	                            '&nbsp;&nbsp;'+
	                            '<button id="eliminarImpresion'+contador+'" name="eliminarImpresion'+contador+'" type="button" class="btn btn-xs" onclick="eliminarAcabados('+contador+');">'+
	                            '<span class="glyphicon glyphicon-trash"></span> Borrar'+
	                            '</button></div>'+
                        	'</div>'+
                        '</div>'+
                    ''+
                '';
                     $("#principalAcabados").append(html);
                     $('#tipoAcabado'+contador).append($("#tipoAcabado0 > option").clone());
                    contador = contador+1;
                	$("#totalAcabado").val(contador);

}

function eliminarAcabados(indice){

	 $("#Acabados"+indice).remove();

    var auxContador=parseInt($("#totalAcabado").val());
    auxContador=auxContador-1;
    $("#totalAcabado").val(auxContador);
}
