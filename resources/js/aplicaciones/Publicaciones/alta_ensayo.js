$(document).ready(function(){
	var form = "#formEnsayos";
	var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_gestionarEnsayo.php";
	
	$('#indicadorEnsayo').DataTable(
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
			
            tituloTexto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingrese un título al texto'
                    }
                }
            },numCuartillas: {
                validators: {
                    stringLength: {
                        message: 'El número de cuartilla sólo acepta máximo cifras de 4 digitos',
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
				 formData.append('id',$("#selTexto").val());
				 formData.append('IdLibro',$("#IdLibro").val());
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
										cambiarContenido('#ContenidosSubMenu','alta_Ensayos.php?aDF=1&IdLibro='+$("#IdLibro").val()+"&IdTexto="+$("#selTexto").val());
									}else{
										cambiarContenido('#ContenidosSubMenu','alta_Ensayos.php?aDF=1&IdLibro='+$("#IdLibro").val());
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

function obtenerDatosPersona(IdPersona,semblanza,fechaNacimiento,correo,regFiscal,rfcAutor,celular,casa,oficina){
	//$("#"+elem).load("../../../WEB-INF/Controllers/Ajax/cargaSelectObtenerPersonas.php",{IdPersona:IdPersona,tipo:tipo});
	$.ajax({
     type: "POST",
     url: "../../../WEB-INF/Controllers/Ajax/cargaSelectObtenerPersonas.php",
     data: {IdPersona:IdPersona},
     dataType: "json",

     error: function(){
        console.log("Error en la petición de AJAX");
     },
     success: function(data){
		if(semblanza != ''){
			$("#"+semblanza).val(data.semblanza);
		}	
        if(fechaNacimiento != ''){
			$("#"+fechaNacimiento).val(data.fechaNacimiento);
		}	
		if(correo != ''){
			$("#"+correo).val(data.correo);
		}
		if(rfcAutor != ''){
			$("#"+rfcAutor).val(data.rfc);
		}
		if (regFiscal != ''){
			$("#"+regFiscal).val(data.regFiscal);
		}
		if (celular != ''){
			$("#"+celular).val(data.telcelular);
		}
        //$("#"+regFiscal+"option[value='"+data.regFiscal+"']").attr("selected",true);
		if (casa != ''){
			$("#"+casa).val(data.telcasa);
		}
		if(oficina != ''){
			$("#"+oficina).val(data.teloficina);
		}
		
		
     }
  });
}

function cargaInstitucion(indice,elem){
    
    //alert("spoiler");
    
    $("#"+elem).load("../../../WEB-INF/Controllers/Ajax/cargaSelectObtenerPersonas.php",{IdPersona:indice,select:"institucion"});
   
}