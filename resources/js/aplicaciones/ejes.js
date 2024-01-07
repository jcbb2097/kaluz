$(document).ready(function() 
{
	$('#ejes').DataTable(
	{
		"language": 
		{
			"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
		},
		"order": [[ 0, "asc" ]],
		"lengthMenu": [[15, 25, 50, 100], [15, 25, 50, 100]]
		//"ordering": false
	});
});

function eliminarEje(idEje)
{
    var idEje = idEje;
    $.confirm({
		title: 'Confirmación',
		content: 'Desea eliminar eje?',
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
					$.post("../../source/controller/EjeFrontController.php",{idEje:idEje, action:"eliminar"}, function(data)
					{
						location.reload();
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

$(document).ready(function()
{
	$("#formEjes").submit(function(event) 
	{
		event.preventDefault();
		if ($('#txtIdEje').val() == undefined)
		{
			var posting = $.post("../../source/controller/EjeFrontController.php",$("#formEjes").serialize()+"&action=guardar");
				
			posting.done(function(data)
			{
				
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Eje guardado con éxito',
						type: 'dark',
						typeAnimated: true,
						buttons: 
						{
							aceptar: 
							{
								btnClass: 'btn-dark',
								action: function()
								{	
									$("#formEjes")[0].reset();
									location.reload();
								}
							}
						}
					}); 
				}
				else
				{
					$.confirm({
						title: 'Error',
						content: 'No es posible guardar el registro, intente nuevamente',
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
			posting.fail(function(data)
			{
				alert("Error al enviar");
			});
				
		}
		else
		{
			var posting = $.post("../../source/controller/EjeFrontController.php",$("#formEjes").serialize()+"&action=modificar");
		
			posting.done(function(data)
			{
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Eje modificado con éxito',
						type: 'dark',
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
				else
				{
					$.confirm({
						title: 'Error',
						content: 'No es posible modificar el registro, intente nuevamente',
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
			posting.fail(function(data)
			{
				alert("Error al enviar");
			});
		}
	});
});

function modificarEje(idEje,tipoPerfil,idUsuario,nombreUsuario)
{
	var idEje = idEje;
	var tipoPerfil = tipoPerfil;
	var idUsuario = idUsuario;
	var nombreUsuario = nombreUsuario;
	window.location.href="frmEjes.php?idEje="+idEje+"&idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario+"&tipoPerfil="+tipoPerfil;   
}

function cambiarArchivo(idEje,tipoPerfil,idUsuario,nombreUsuario)
{
	var idEje = idEje;
	var tipoPerfil = tipoPerfil;
	var idUsuario = idUsuario;
	var nombreUsuario = nombreUsuario;
	window.location.href="frmArchivoEje.php?idEje="+idEje+"&idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario+"&tipoPerfil="+tipoPerfil;     
}