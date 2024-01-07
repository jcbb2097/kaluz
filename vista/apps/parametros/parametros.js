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

function eliminarParametro(parametro){
    var id_param = parametro;
    $.confirm({
		title: 'Confirmación',
		content: 'Desea eliminar el parámetro?',
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
					$.post("acciones_parametros.php",{idparam:id_param, action:"eliminar"}, function(data)
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

$(document).ready(function(){
	$("#formUsuario").submit(function(event){
		event.preventDefault();
		if ($('#id_par').val() == 0){
			var posting = $.post("acciones_parametros.php",{form : $("#formUsuario").serialize(),action : "guardar"});

			posting.done(function(data){

				if(data == 1){
					$.confirm({
						title: 'Confirmación',
						content: 'Parámetro guardado con éxito',
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
									window.location.href="lista_parametros.php";
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
			var posting = $.post("acciones_parametros.php",{form : $("#formUsuario").serialize(),action : "modificar"});

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
									window.location.href="lista_parametros.php";
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

function modificarParam(id)
{
	var idUser = id;
	window.location.href="parametros.php?idparam="+id;
}
