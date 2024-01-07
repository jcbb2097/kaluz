$(document).ready(
	function()
	{
		$("#frmArchivo").submit(function(event) {
			//alert("Enviando formulario.....");
			var tipoPerfil = $("#tipoPerfil").val();
			var idUsuario = $("#idUsuario").val();
			var nombreUsuario = $("#nombreUsuario").val();
			
			event.preventDefault();
				$('.loading').html("<div class='loader'><div class='info'>Cargando información</div></div>");
				var formData = new FormData(document.getElementById("frmArchivo"));
				formData.append("action","modificarArchivo");
				
				$.ajax({
					url: "../../source/controller/EjeFrontController.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false
					})
                .done(function(data,status,xhr){
						
					//alert("Datos Enviadosn"+ data.trim() +"hxr=" + xhr.status + "xhres="+ xhr.statusText);
					//alert(xhr.status);
					console.log(data);
					
					if(xhr.status === 200)
					{
						var respuesta = xhr.responseText;
						//alert(respuesta.trim());
						var r = respuesta.trim();
						if(r == "existe")
						{
							$(".loading").fadeIn(1000).html('');
								$.confirm({
									title: 'Error',
									content: 'Archivo ya existe, seleccionar otro o cambiar nombre',
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
								return false;
						//alert("'Archivo ya existe, seleccionar otro o cambiar nombre'");
						//return false;
						}else
						{
						
						$(".loading").fadeIn(1000).html('');
								$.confirm({
									title: 'Confirmación',
									content: 'Archivo guardado con éxito',
									type: 'dark',
									typeAnimated: true,
									buttons: 
									{
										aceptar: 
										{
											btnClass: 'btn-dark',
											action: function()
											{	
												window.location.href="controlEjes.php?idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario+"&tipoPerfil="+tipoPerfil; 
												//location.reload();
											}
										}
									}
								}); 
			
					//$("#mensaje").html("<div class='alert alert-success'><strong>Imagen Guardada</strong></div>");
					
					/*setTimeout(function() {
						$("#mensaje").fadeOut(1000);
						/*$.post("frmExposicion.php",{}, function( data )
						{
							$( "#div.1" ).html(data);
						});*/
						
					    /* location.reload();
						},2000);*/
					}
					}
					else{
						
					}
					
                   
                });

			
		});

	}
);


