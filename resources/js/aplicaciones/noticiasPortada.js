$(document).ready(function() 
{
	$('#noticiasPortada').DataTable(
	{
		"language": 
		{
			"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
		},
		"order": [[ 0, "asc" ]],
		"scrollY":        "440px",
        "scrollCollapse": true,
        "paging": true
		//"ordering": false
	});
});

function eliminarNoticia(idNoticia)
{
    var idNoticia = idNoticia;
    $.confirm({
		title: 'Confirmación',
		content: 'Desea quitar noticia?',
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
					$.post("../../../source/controller/NoticiaFrontController.php",{idNoticia:idNoticia, action:"eliminar"}, function(data)
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
	$("#formNoticias").submit(function(event) 
	{
		event.preventDefault();
		if ($('#txtIdNoticia').val() == undefined)
		{
			var posting = $.post("../../../source/controller/NoticiaFrontController.php",$("#formNoticias").serialize()+"&action=guardar");
				
			posting.done(function(data)
			{
				
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Noticia registrada con éxito',
						type: 'dark',
						typeAnimated: true,
						buttons: 
						{
							aceptar: 
							{
								btnClass: 'btn-dark',
								action: function()
								{	
									$("#formNoticias")[0].reset();
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
			var posting = $.post("../../../source/controller/NoticiaFrontController.php",$("#formNoticias").serialize()+"&action=modificar");
		
			posting.done(function(data)
			{ 
				if(data == 1)
				{
					$.confirm({
						title: 'Confirmación',
						content: 'Noticia actualizada con éxito',
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

function modificarNoticia(idNoticia,tipoPerfil,idUsuario,nombreUsuario)
{
	var idEje = idEje;
	var tipoPerfil = tipoPerfil;
	var idUsuario = idUsuario;
	var nombreUsuario = nombreUsuario;
	window.location.href="frmNoticia.php?idNoticia="+idNoticia+"&tipoPerfil="+tipoPerfil+"&idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario;   
}