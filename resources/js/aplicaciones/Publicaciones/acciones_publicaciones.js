$(document).ready(function(){ 
  var IdUsuario = $('#Id_usuario').val();
  var eje = $('#Eje_publi').val();
  var libro = $('#libro_id').val();
	cambiarColorMenu('indicador_general.php');
	cambiarContenido('#Contenidos','indicador_general.php?tipo=1&Id_usuario='+IdUsuario+'&Eje='+eje+'&libro='+libro);
  
});
function mostrarGeneral(){
  $('#General').show();
}

function cambiarContenido(div, page){
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
  
  $(div).load(page,{usuario:usuario}, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}

function cambiarColorMenu(page){
	  //console.log(page);
	pagina = page.split('?',1);
	//console.log(pagina[0]);
	$("#nuevoLibro").removeClass("sel");
	$("#actualizarLibro").removeClass("sel");
	$("#indicadorGeneral").removeClass("sel");
	$("#coleccionHistorica").removeClass("sel");
	
	if(page.indexOf("accion=guardar") > -1){
		
		if(pagina[0] === "menu_actividadesGlobales.php"){
			
			$("#nuevoLibro").addClass("sel");
		}
	}else if(page.indexOf("accion=editar") > -1){
	    //console.log('entra editar');
		if(pagina[0] === "menu_actividadesGlobales.php"){
			$("#actualizarLibro").addClass("sel");
		}
	}else{
		
		if(pagina[0] === "indicador_general.php"){
		//console.log('entra general');	
		  $("#indicadorGeneral").addClass("sel");
		}
	  
		if(pagina[0] === "lista_coleccionHistorica.php"){
		  //console.log('entra historica');	
		  $("#coleccionHistorica").addClass("sel");
		}

	}	
}



function buscarPublicacion(){
  //console.log("entra");
  var form = "#formFiltroP";
  //var pagina = "lista_publicaciones.php";

   /* $(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           libro: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un libro'
                    }

                }
            }
        }
    });
	 
	if ($(form).bootstrapValidator('validate').has('.has-error').length === 0 ) {*/
    //alert(":V");
        var IdLibro = $("#libro").val();
        var usuario = $('#usuario').val();
      //window.location.href = pagina+"?IdLibro="+IdLibro+"&nombreUsuario="+usuario;
	  cambiarContenido('#ContenidosMenu','menu_actividadesGlobales.php?accion=editar&IdLibro='+IdLibro);
   /* }else{
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
    }*/
   
}

function buscarMenu(){
  
  var IdLibro = $("#libro").val();
  let usuario = $("#usuario").val();
  //alert("pruebas");
  cambiarContenido('#container','menu_actividadesGlobales2.php?accion=editar&IdLibro='+IdLibro+"&nombreUsuario="+usuario);
}

function obtenerTexto(divContenido,pagina,IdLibro){
	var IdTxt = $("#selTexto").val();
	cambiarContenido(divContenido,pagina+'?accion=editar&IdLibro='+IdLibro+'&IdTexto='+IdTxt);
	
}

function submenus2(div,eje, nivel, actividad, numeracion){
   let usuario = $("#usuario").val();
  ni_act =nivel;

  var IdLibro = $("#libro").val();

  var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_complete.php";
 // alert(div+eje);
  $.post(controller, {"IdLibro":IdLibro, "eje": eje, "contenidos": "contenidos", "nivel": nivel, "actividad": actividad , "numeracion": numeracion, "usuario": usuario}).done(function (data) {
  // alert(div+" "+eje + data);"<br>"
  //alert(nivel)

    $("#pp").html(data);
    if(data ===""){
        
       $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro);
        });
    }else{
       // alert("hola")
      $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel, "actividad": actividad}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro);
      });
    }
  });
  /*
  niveles = $("#niveles").val();
  while(nivel<niveles){
     $("#lvl"+niveles).html("");
     niveles--;
  }*/
}
function submenus(div,eje, nivel, actividad, numeracion){
 let usuario = $("#usuario").val();
  ni_act =nivel;
  var IdLibro = $("#libro").val();
  alert(IdLibro)
  var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_complete.php";
 // alert(div+eje);
  $.post(controller, {"IdLibro":IdLibro,"eje": eje, "contenido": "contenido", "nivel": nivel, "actividad": actividad , "numeracion": numeracion, "usuario": usuario}).done(function (data) {
  // alert(div+" "+eje + data);"<br>"
  //alert(nivel)
    $("#lvl"+nivel).html(data);
    //alert(nivel)
   // alert(data)
    if(data ===""){
       $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro);
        });
    }else{
      $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel, "actividad": actividad}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro);
      });
    }
  });
  niveles = $("#niveles").val();
  while(nivel<niveles){
     $("#lvl"+niveles).html("");
     niveles--;
  }
}