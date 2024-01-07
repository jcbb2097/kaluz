
$(document).ready(function(){

	var form = "#formFiltroAM";
	var pagina = "lista_actividadesMetas.php";

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
            tipo: {
                   validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo'
                    }
                }
            },periodo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un periodo'
                    }
                }
            }
		}
    });
    $("#enviar").click(function(event) {

     //limpiarMensaje();
		event.preventDefault();
		if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
		 //console.log("todo validado");
         // cargando();
         var eje = $('#eje').val();
         var tipo = $('#tipo').val();
         var periodo = $('#periodo').val();
		 var usuario = $('#usuario').val();
			window.location.href = pagina+"?IdEje="+eje+"&IdTipo="+tipo+"&IdPeriodo="+periodo+"&nombreUsuario="+usuario;
		}else{
			$.confirm({
				icon: 'glyphicon glyphicon-info-sign',
				title: 'Importante',
				content: 'No es posible filtrar, revise los campos obligatorios',
				type: 'purple',
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

/*function modificar(Id,user)
{
	//console.log("entra");
	window.location.href="lista_actividadesMetas.php?accion=editar&id="+Id+"&usuario="+user;
}*/
