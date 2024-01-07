$(document).ready(function(){


 });

function mostrarGeneral(){
  $('#General').show();
}

function cambiarContenido(div, page){
  //alert("asd");
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

        }

  });
}

function cambiarColorMenu(page){
	  //console.log(page);
    //alert(page);
	pagina = page.split('?',1);
	//console.log(pagina[0]);
	$("#nuevoLibro").removeClass("sel");
	$("#actualizarLibro").removeClass("sel");
	$("#indicadorGeneral").removeClass("sel");
	$("#coleccionHistorica").removeClass("sel");
  $("#publicaciones_externas").removeClass("sel");
  $("#publicaciones_Internas").removeClass("sel");
  $("#publicaciones_proceso").removeClass("sel");
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
    if(pagina[0] === "publicaciones_externas.php"){
		  //console.log('entra historica');
		  $("#publicaciones_externas").addClass("sel");
		}
    if(pagina[0] === "publicaciones_internas.php"){
		  //console.log('entra historica');
		  $("#publicaciones_Internas").addClass("sel");
		}
    if(pagina[0] === "publicaciones_proceso.php"){
		  //console.log('entra historica');
		  $("#publicaciones_proceso").addClass("sel");
		}

	}
}
function cambiarColorMenuActividades(idDiv,nomClase,IdNivel){

    if($("#"+idDiv).hasClass(nomClase)){
		//console.log("entra Dos");
		if($("#"+IdNivel+ " > .bac").hasClass("bac")){
			$("#"+IdNivel+ " > .bac").addClass(nomClase);
			$("#"+IdNivel+ " > .bac").removeClass("bac")
		};
		$("#"+idDiv).removeClass(nomClase);
		$("#"+idDiv).addClass("bac");
	}

}
function buscarMenu(){
 
  var IdLibro = $("#libro").val();
  var usuario = $('#usuario').val();
  //alert(usuario);
  cambiarContenido('#container','menu_actividadesGlobales2.php?accion=editar&IdLibro='+IdLibro+"&nombreUsuario="+usuario);
}

function submenus(div,eje, nivel, actividad, numeracion){
  ni_act =nivel;
  
  var IdLibro = $("#libro").val();
  //alert(IdLibro);
  var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_complete.php";
  var usuario = $('#usuario').val();
  //alert(usuario);
  $.post(controller, {"IdLibro":IdLibro,"eje": eje, "contenido": "contenido", "nivel": nivel, "actividad": actividad , "numeracion": numeracion}).done(function (data) {
    $("#lvl"+nivel).html(data);

    if(data ===""){
       $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
        });
    }else{
      $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel, "actividad": actividad}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
      });
    }
  });
  niveles = $("#niveles").val();
  while(nivel<niveles){
     $("#lvl"+niveles).html("");
     niveles--;
  }
}
function buscarPublicacion(){

  var form = "#formFiltroP";

        var IdLibro = $("#libro").val();
        var usuario = $('#usuario').val();
	  cambiarContenido('#ContenidosMenu','menu_actividadesGlobales.php?accion=editar&IdLibro='+IdLibro);

}

function obtenerTexto(divContenido,pagina,IdLibro){
	var IdTxt = $("#selTexto").val();
	cambiarContenido(divContenido,pagina+'?accion=editar&IdLibro='+IdLibro+'&IdTexto='+IdTxt);

}

function submenus2(div,eje, nivel, actividad, numeracion){
  ni_act =nivel;
  var IdLibro = $("#libro").val();
  var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_complete.php";
  var usuario = $('#usuario').val();
 //alert(nivel);
  $.post(controller, {"IdLibro":IdLibro,"eje": eje, "contenidos": "contenidos", "nivel": nivel, "actividad": actividad , "numeracion": numeracion}).done(function (data) {
    $("#pp").html(data);
    if(data ===""){
       $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
        });
    }else{
       // alert("hola")
      $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": nivel, "actividad": actividad}).done(function (data) {
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+actividad+"&nivel="+ni_act+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
      });
    }
  });

}
function submenus3(niv,id_actividad_f,eje, nivel, actividad, numeracion, af){
  //alert("qwe");
  ni_act =nivel;
  var IdLibro = $("#libro").val();
  var controller = "../../../WEB-INF/Controllers/Publicaciones/Controller_complete.php";
  var usuario = $('#usuario').val();

  $.post(controller, {"IdLibro":IdLibro,"eje": eje, "contenidos": "contenidos", "nivel": nivel, "actividad": actividad , "numeracion": numeracion, "af":af}).done(function (data) {
    $("#pp").html(data);
   
    if(data ===""){
       $.post(controller, {"eje": eje, "form": "form", "nivel": niv}).done(function (data) {
       
          cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+id_actividad_f+"&nivel="+niv+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
        });
    }else{
      $.post(controller, {"IdLibro":IdLibro,"eje": eje, "form": "form", "nivel": niv, "actividad": actividad}).done(function (data) {
        //alert(af)  
        cambiarContenido('#ContenidosMenu','alta_definirContenidos2.php?accion=editar&actividad='+id_actividad_f+"&nivel="+niv+"&eje="+eje+"&IdLibro="+IdLibro+"&nombreUsuario="+usuario);
      });
    }
  });

}
function indicador(tipo) {
  var div = "#Contenidos";
  var Id_usuario = $("#Id_usuario").val();
  var eje = $("#Eje_publi").val();
  var pagina = 'indicador_general.php?tipo=' + tipo + '&Id_usuario=' + Id_usuario + '&Eje=' + eje;
  $.post(pagina, {}, function(data) {
    $(div).html(data);
  });
}

function ocultar(tipo) {

  dvC2 = document.getElementById("indicadores");
  divC = document.getElementById("ejes");
  if (tipo == 1) {

    divC.style.display = "block";
     // alert("a");
  } else {
    divC.style.display = "none";
    //dvC2.style.diplay = "none";
  }
  document.getElementById("grafica").style.display = "none";
}

function Eje() {
  var div = "#Contenidos";
  var Id_usuario = $("#Id_usuario").val();
  var eje = $("#Eje_publi").val();
  var pagina = 'indicador_general.php?tipo=1&Id_usuario=' + Id_usuario + '&Eje=' + eje;
  if (eje != "") {
    $.post(pagina, {}, function(data) {
      $(div).html(data);
    });
  } else {
    alert('Escoja un eje para filtrar las publicaciones');
  }
}
