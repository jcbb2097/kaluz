
$(document).ready(function(){
	
	var form = "#formDefinirContenidos";

	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_definirContenidos2.php";
	var form = "#formDefinirContenidos";
	var inputs = $("input[type=file]"),
	files = [];

	  $("#guardar").click(function(event) {	
		event.preventDefault();
		if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
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
							title: 'Registro Exitoso',
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
										//$("#lvl_mensaje").html(data);
									}
								}
							}
						});
					} else {
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
										$("#lvl_mensaje").html("vlv");
									}
								}
							}
						});
					}	
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
						}
					});
				}
			},
			cancelar: function()
			{
			}
		}
    });
}
function modificar(Id,user)
{
	window.location.href="alta_definirContenidos.php?accion=editar&id="+Id+"&usuario="+user;
}
function cargaractE() {
	var eje = $('#Eje').val();
    var area = $('#Eje').val();
    var act = $('#Eje').val();
    $('#Actividad').load("../../../WEB-INF/Controllers/Noticias/Controler_noticias.php", {"tipoSelect": "cargar", "act": act}, function (data) {/*Refrescamos el select y volvemos a poner filtros*/
        $(this).select("refresh");
    });
}
function textos(valor){
	let IdActividad=  $('#IdActividad').val();
	let Ideje =  $('#Ideje').val();
	let IdLibro=  $('#IdLibro').val();
	let usuario= $('#usuario').val();	
	cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+IdActividad+"&nivel="+ni_act+"&eje="+Ideje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario+"&id_texto="+valor);
}
function cambiarColorMenuActividades(idDiv,id,IdNivel){
	//alert(id)
	$( ".menuact"+id ).css( "background", "#4d4d57" );
	var div = document.getElementById(idDiv);
	div.style.background = "#337ab7";

}
function agregar_texto(){
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Texto.php";
	var form = "#formautextos";
	$(form).bootstrapValidator({
        fields: {
			autor: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un autor'
                    }
                }
            },  
            titulo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un titulo'
                    }
                }
            },  
            cuartillas: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese las cuartillas'
                    }
                }
            },  
            Tipo_texto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un tipo de texto'
                    }
                }
            },  
            idioma_original: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese el idioma original'
                    }
                }
            }
			,  
            idioma_traducir: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese el idioma a traducir'
                    }
                }
            }
        }
    });
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
		 let IdTexto2=  $('#IdTexto').val();
          var inputs = $("#imagen"),
                 files = [];
                 for (var i = 0; i < inputs.length; i++) {
                     files.push(inputs.eq(i).prop("files")[0]);
					 //alert(inputs.length);
                 }

                 var formData = new FormData();
                 $.each(files, function(key, value)
                 {
                     formData.append(key, value);
                 });
                 formData.append('form', $(form).serialize());
                 formData.append('accion',$("#accion").val());
                 formData.append('id',$("#id").val());
				 formData.append('IdTexto',IdTexto2);
                 formData.append('usuario',$("#usuario").val());    
                $.ajax({
                 url: controller,
                 type: 'POST',
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data, textStatus, jqXHR){
                    if (data.toString().indexOf("Error:") === -1) {
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

                                   // window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=catalogos&id_t=lista_agentes";
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
}
function editar_texto(){
	let IdTexto=  $('#IdTexto').val();
	let IdTexto2=  $('#IdTexto').val();
	let pagina="";

	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Texto.php";
	if(IdTexto=!""){
		$.post(controller, {"Buscar":"Buscar","IdTexto":IdTexto2}).done(function (data) {
			pagina = data.split('/*',7);
			$("#autores").val(pagina[0]);
			$('#titulo').val(pagina[1]);
			$('#cuartillas').val(pagina[2]);
			$("#Tipo_texto").val(pagina[3]);
			$("#idioma_original").val(pagina[4]);
			$("#idioma_traducir").val(pagina[5]);
			//alert(pagina[6]);
			if(pagina[6]!=""){
			document.getElementById("imagen_texto").href ="ImagenTexto/"+pagina[6];
			}
			//$("#imagen").val(pagina[6]);
			
			$("#accion").val("Editar");
			$("#agregarAu").html("Editar");
			var div = document.getElementById("eliminarAu");
			div.style.display = "inline";
		});
	}
}
function nuevo_texto(){
	$("#accion").val("nuevo");
	$("#agregarAu").html("Registrar");
	var div = document.getElementById("eliminarAu");
	div.style.display = "none";
	$('#titulo').val("");
	$('#cuartillas').val("");
	$("#autor").val("");
	$("#Tipo_texto").val("");
	$("#idioma_original").val("");
	$("#idioma_traducir").val("");
}
function borrar_texto(){
	let IdTexto=  $('#IdTexto').val();
	let IdTexto2=  $('#IdTexto').val();
	let pagina="";
	$("#accion").val("Eliminar");
	$("#agregarAu").html("Registrar");
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Texto.php";
	if(IdTexto=!""){
		$.post(controller, {"accion":"Eliminar","IdTexto":IdTexto2}).done(function (data) {
			//pagina = data.split('/*',7);
			alert(data)
			$('#titulo').val("");
			$('#cuartillas').val("");
			$("#autor").val("");
			$("#Tipo_texto").val("");
			$("#idioma_original").val("");
			$("#idioma_traducir").val("");
			$("#agregarAu").html("Editar");
			var div = document.getElementById("eliminarAu");
			div.style.display = "inline";
		});
	}
}

function agregar_autor(){
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
	var form = "#formautores";
	$(form).bootstrapValidator({
        fields: {
			Nombre: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un nombre'
                    }
                }
            },  
            Apellido: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese apellido paterno'
                    }
                }
            }, 
            Pais: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese el país'
                    }
                }
            },  
            Regimen: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese un Regimen'
                    }
                }
            }
        }
    });
        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
         //console.log("todo validado");
         // cargando();
		 let id_Personas=  $('#id_Personas').val();
		 let IdTexto2=  $('#IdTexto').val();
		 //alert(id_Personas)
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
                 formData.append('acciones',$("#acciones").val());
                 formData.append('id',$("#id").val());
				 formData.append('id_Personas',id_Personas);
				 formData.append('IdTexto2',IdTexto2);
                 formData.append('usuario',$("#usuario").val());    
                $.ajax({
                 url: controller,
                 type: 'POST',
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data, textStatus, jqXHR){
                    if (data.toString().indexOf("Error:") === -1) {
                         //swal(data,"","success");
						 //alert(data);
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
									//$("#id_Personas").selectmenu("refresh");
                                   
                                    //window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val();
                                    
                                   // window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=catalogos&id_t=lista_agentes";
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
}

function editar_autor(){
	let id_Personas=  $('#id_Personas').val();
	let id_Personas2= $('#id_Personas').val();
	let pagina="";
	
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
	if(id_Personas=!""){
		//alert(id_Personas2)
		$.post(controller, {"Buscar":"Buscar","id_Personas":id_Personas2}).done(function (data) {
			
			pagina = data.split('/*',11);
			
			//alert(data+" "+id_Personas)
			$('#Nombre').val(pagina[0]);
			$('#Apellido').val(pagina[1]);
			$('#ApellidoM').val(pagina[2]);
			//alert(pagina[3])
			$('#Correo_autor').val(pagina[3]);
			$('#CURP').val(pagina[4]);
			$('#Institucion').val(pagina[5]);
			$('#RFC').val(pagina[6]);
			$('#Pais').val(pagina[7]);
			$('#Resena').val(pagina[8]);
			$('#Regimen').val(pagina[9]);
			$('#Telefono').val(pagina[10]);
			$("#acciones").val("Editar");
			$("#agregarAutores").html("Editar");
			var div = document.getElementById("eliminarAu2");
			div.style.display = "inline";
		});
	}
}
var valor="";
function personas(valores){
	valor=valores;
	
}
function personas2(valores){
	valor=valores;
	
}
function nuevo_autor(){
	$("#acciones").val("nuevo");
	$("#agregarAutores").html("Registrar");
	var div = document.getElementById("eliminarAu2");
	div.style.display = "none";
	$('#Nombre').val("");
	$('#Apellido').val("");
	$("#ApellidoM").val("");
	$("#Correo_autor").val("");
	$("#CURP").val("");
	$("#Institucion").val("");
	$("#Pais").val("");
	$("#RFC").val("");
	$("#Resena").val("");
}
function borrar_autor(){
	let id_Personas=  $('#id_Personas').val();
	let id_Personas2=  $('#id_Personas').val();
	let IdTexto=  $('#IdTexto').val();

	let pagina="";
	$("#acciones").val("Eliminar");
	$("#agregarAutores").html("Registrar");
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
	if(id_Personas=!""){
		$.post(controller, {"acciones":"Eliminar","id_Personas":id_Personas2, "IdTexto2":IdTexto }).done(function (data) {
			pagina = data.split('/*',7);
			alert(data+" "+id_Personas)
			$('#Nombre').val("");
			$('#Apellido').val("");
			$("#ApellidoM").val("");
			$("#Correo_autor").val("");
			$("#CURP").val("");
			$("#Institucion").val("");
			$("#Pais").val("");
			$("#RFC").val("");
			$("#Resena").val("");
			$("#agregarAu").html("Editar");
			var div = document.getElementById("eliminarAu2");
			div.style.display = "inline";
		});
	}
}
function r_indicadores(){
	let IdActividad=  $('#IdActividad').val();
	let IdLibro=  $('#IdLibro').val();
	//alert(IdActividad+" "+IdLibro);
	cambiarContenido('#Contenidos','indicador_general.php?id_actividad='+IdActividad+'&IdLibro='+IdLibro);
}

function editar_datos(editar_datos){
	
		let id_Personas= valor;
		let id_Personas2= valor;
		let pagina="";
		
	if(editar_datos!="undefined"){
		 id_Personas= editar_datos;
		 id_Personas2= editar_datos;
         valor=editar_datos;

	}
	if(valor!=""){
		 id_Personas= valor;
		 id_Personas2= valor;
	}
	//alert(id_Personas2);
	//alert(id_Personas)
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
	if(id_Personas=!""){
		//alert(id_Personas2)
		$.post(controller, {"Buscar_datos":"Buscar_datos","id_Personas":id_Personas2}).done(function (data) {
			pagina = data.split('/*',11);
			//alert(data+" "+id_Personas)
			$('#c_c').val(pagina[3]);
			$('#r_r').val(pagina[9]);
			$('#t_t').val(pagina[10]);
			$("#acciones").val("nuevo_datos");
		});
	}
}
function editar_datos2(editar_datos){
	//alert(editar_datos)
	let id_Personas= valor;
	let id_Personas2= valor;
	let pagina="";
	
if(editar_datos!="undefined"){
	 id_Personas= editar_datos;
	 id_Personas2= editar_datos;
     valor=editar_datos;
}
if(valor!=""){
	 id_Personas= valor;
	 id_Personas2= valor;
}

//alert(id_Personas2);
//alert(id_Personas)
let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
if(id_Personas=!""){
	//alert(id_Personas2)
	$.post(controller, {"Buscar_datos2":"Buscar_datos2","id_Personas":id_Personas2}).done(function (data) {
		pagina = data.split('/*',11);
		//alert(data+" "+id_Personas)
		$('#c_c').val(pagina[0]);
		$('#r_r').val(pagina[1]);
		$('#t_t').val(pagina[2]);
		$("#acciones").val("nuevo_datos2");
	});
}
}
function agregar_datos(){
    //alert(valor)
	let controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_Autores.php";
	var form = "#formdatos";

        event.preventDefault();
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {
         //console.log("todo validado");
         // cargando();
		 let id_Personas=  valor;
		 let IdTexto2=  $('#IdTexto').val();
		 //alert(id_Personas)
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
				 //alert($("#acciones").val());
				// alert(id_Personas)
                 formData.append('form', $(form).serialize());
                 formData.append('acciones',$("#acciones").val());
                 formData.append('id',$("#id").val());
				 formData.append('id_Personas',id_Personas);
				 formData.append('IdTexto2',IdTexto2);
                 formData.append('usuario',$("#usuario").val());    
                $.ajax({
                 url: controller,
                 type: 'POST',
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data, textStatus, jqXHR){
                    if (data.toString().indexOf("Error:") === -1) {
                         //swal(data,"","success");
						 //alert(data);
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
									//$("#id_Personas").selectmenu("refresh");
                                   
                                    //window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val();
                                    
                                   // window.location.href="seguridad.php?nombreUsuario="+$("#usuario").val()+"&menu_seguridad=catalogos&id_t=lista_agentes";
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
}