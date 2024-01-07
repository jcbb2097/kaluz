function aplicaciones(perfil,nombreUsuario,idUsuario)
{
	var tipoPerfil = perfil;
	var nombreUsuario = nombreUsuario;
	var idUsuario = idUsuario;
	$('iframe#scorm_object').attr('src','aplicaciones.php?tipoPerfil='+tipoPerfil+'&nombreUsuario='+nombreUsuario+'&idUsuario='+idUsuario);
	//$('iframe#scorm_object').attr('src','../template/pages/dashboard.html?tipoPerfil='+tipoPerfil+'&nombreUsuario='+nombreUsuario+'&idUsuario='+idUsuario);
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	$("p.ejes").css("background-color","#4d4d57");
	$("p.ejes a").css("color","#fff");
	$("p.ejes a").css("font-family", "Muli-Regular");  
	$(".franja").css("height","64px");
	$(".ejesCuadricula").css({"background-color":"#a9a9ae","color":"black"});
	$(".ejesCuadriculaAsuntos").css({"background-color":"#a9a9ae"});
	
}

function indicadores(perfil,nombreUsuario,idUsuario)
{
	var tipoPerfil = perfil;
	var nombreUsuario = nombreUsuario;
	var idUsuario = idUsuario;
	$('iframe#scorm_object').attr('src','indicadores.php?tipoPerfil='+tipoPerfil+'&nombreUsuario='+nombreUsuario+'&idUsuario='+idUsuario);
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	$("p.ejes").css("background-color","#4d4d57");
	$("p.ejes a").css("color","#fff");
	$("p.ejes a").css("font-family", "Muli-Regular"); 
	$(".franja").css("height","64px");
	$(".ejesCuadricula").css({"background-color":"#a9a9ae","color":"black"});
	$(".ejesCuadriculaAsuntos").css({"background-color":"#a9a9ae"});
	
}

function asuntosRec(anio,idArea,idUsuario)
{
	var anio = anio;
	var idArea = idArea;
	var idUsuario = idUsuario;
	$('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac=1&anio='+anio+'&idArea='+idArea+'&idUsuario='+idUsuario+'&opcion=recibido&tipo=0&estatus=0');
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	
}

function asuntosEnv(anio,idArea,idUsuario)
{
	var anio = anio;
	var idArea = idArea;
	var idUsuario = idUsuario;
	$('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac=1&anio='+anio+'&idArea='+idArea+'&idUsuario='+idUsuario+'&opcion=enviado&tipo=0&estatus=0');
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	
}

function portada(anio,idAreaEje,idUsuario,idPerfil,idAreaUsuario,ejeArea,nombreUsuario)
{
	var anio = anio;
	var idAreaEje = idAreaEje;
	var idUsuario = idUsuario;
	var idPerfil = idPerfil;
	var idAreaUsuario = idAreaUsuario;
	var ejeArea = ejeArea;
	var nombreUsuario = nombreUsuario;
	$('iframe#scorm_object').attr('src','portada.php?anio='+anio+'&idAreaEje='+idAreaEje+'&idUsuario='+idUsuario+'&idPerfil='+idPerfil+'&idAreaUsuario='+idAreaUsuario+'&ejeArea='+ejeArea+'&nombreUsuario='+nombreUsuario);
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	$("p.ejes").css("background-color","#4d4d57");
	$("p.ejes a").css("color","#fff");
	$("p.ejes a").css("font-family", "Muli-Regular"); 
	$(".franja").css("height","64px");
	$(".ejesCuadriculaAsuntos").css({"background-color":"#a9a9ae"});
	$(".ejesCuadricula").css({"background-color":"#a9a9ae","color":"black"});
	
}

function abrirAsuntos(anio,idArea,idUsuario,opcion,idEje,estatus)
{
	var anio = anio;
	var idArea = idArea;
	var idUsuario = idUsuario;
	var idUsuario = idUsuario;
	var opcion = opcion;
	var idEje = idEje;
	var estatus = estatus;
	var ac='1';
	if(estatus=='4')
		ac='10';
	$('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac='+ac+'&anio='+anio+'&idArea='+idArea+'&idUsuario='+idUsuario+'&opcion='+opcion+'&tipo=0&estatus='+estatus+'&idEje='+idEje);
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	
}

function cambiarP(){
	$("#imgC").attr("src","../resources/img/interruptorVerde.png");
	$("#imgD").attr("src","../resources/img/interruptorRojo.png");
}

function cambiarG(){
	$("#imgD").attr("src","../resources/img/interruptorVerde.png");
	$("#imgC").attr("src","../resources/img/interruptorRojo.png");
}

/*function verC()
{
	
	$('iframe').attr('src','cruces.html');
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	
}
*/