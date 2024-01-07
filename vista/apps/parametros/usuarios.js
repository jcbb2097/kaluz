$(document).ready(function() 
{
	$('#usuarios').DataTable(
	{
		"language": 
		{
			"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
		},
		"order": [[ 0, "asc" ]],
		"scrollY":        "480px",
        "scrollCollapse": true,
        "paging": true
		//"ordering": false
	});
});

function eliminarUsuario(idUsuario)
{
    var idUsuario = idUsuario;
    $.confirm({
		title: 'Confirmación',
		content: 'Desea eliminar usuario?',
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
					$.post("../../source/controller/UsuarioFrontController.php",{idUsuario:idUsuario, action:"eliminar"}, function(data)
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
	$("#formUsuario").submit(function(event) 
	{
		event.preventDefault();
		if ($('#txtIdUsuario').val() == undefined)
		{
			var posting = $.post("../../source/controller/UsuarioFrontController.php",$("#formUsuario").serialize()+"&action=guardar");
				
			posting.done(function(data)
			{
				
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Usuario guardado con éxito',
						type: 'dark',
						typeAnimated: true,
						buttons: 
						{
							aceptar: 
							{
								btnClass: 'btn-dark',
								action: function()
								{	
									$("#formUsuario")[0].reset();
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
			var posting = $.post("../../source/controller/UsuarioFrontController.php",$("#formUsuario").serialize()+"&action=modificar");
		
			posting.done(function(data)
			{
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Usuario modificado con éxito',
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

function modificarUsuario(idUsuario)
{
	var idUser = idUsuario;
	window.location.href="frmUsuarios.php?idUsuario="+idUser;   
}