

function cambiarContenido(div, page){

  //alert(div+" "+page);
  pagina = page.split('?',4);


  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  if($('#valor').val()!=""){
    valor =$('#valor').val();
    
  }
  else{
    valor="";
  }

  var usuario = $('#usuario').val();
   // alert(div+" "+pagina[0]);
  $(div).load(pagina[0],{nombreUsuario:pagina[1],idUsuario:pagina[2], id_t:pagina[3], valor: valor, id_valor:valor }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }

  });
    
}
function cambiarColorMenu(page){
	pagina = page.split('?',1);
	$("#dispositivos").removeClass("sel");
	$("#proteccion").removeClass("sel");
	$("#indicadores").removeClass("sel");
	$("#mapa").removeClass("sel");
	$("#catalogos").removeClass("sel");
		if(pagina[0] === "Dispositivos.php"){
			$("#dispositivos").addClass("sel");
		}
    if(pagina[0] === "ProteccionCivil.php"){
     	$("#proteccion").addClass("sel");
    }
		if(pagina[0] === "Indicadores.php"){
		//console.log('entra general');	
		  $("#indicadores").addClass("sel");
		}
		if(pagina[0] === "Mapa.php"){
		  //console.log('entra historica');	
		  $("#mapa").addClass("sel");
		}
    if(pagina[0] === "catalogos.php"){
      //console.log('entra historica'); 
      $("#catalogos").addClass("sel");
    }
}

function mapa(estatus){

  if(estatus==1){
    window.open("http://caomi1.com/SIE2019/seguridad/resources/pdf/primerpiso.pdf", '_blank')
  }else{
     if(estatus==2){
      window.open("http://caomi1.com/SIE2019/seguridad/resources/pdf/segundopiso.pdf", '_blank')
     }else{
      window.open("http://caomi1.com/SIE2019/seguridad/resources/pdf/tercerpiso.pdf", '_blank')
     }
  }
}
function dispositivos(valor){
    if(valor!=0){
      cambiarContenidos('#contenidos','Dispositivos.php?nombreUsuario=<?php echo $user;?>',valor); cambiarColorMenu('Dispositivos.php?');
    }
    else{
      location.href = "Alta_Dispositivosp.php?accion=guardar&usuario=<?php echo $user; ?>";
      cambiarColorMenu('Dispositivos.php?');
    }
}

function cambiarContenidos(div, page, valor){

  //alert(valor);
  pagina = page.split('?',3);
  if (page === "") {
        //alert("Funcionalidad no implementada aún");
        alert("Pantalla no definida aún");
        return;
  }

  var usuario = $('#usuario').val();
  $(div).load(pagina[0],{nombreUsuario:pagina[1],id_valor:valor }, function (data, status, xhr) {
        if (status == "error") {
            $("#errorPrincipal").html(data + "<br/>" + xhr.status + " " + xhr.statusText);
        } else {
            //$(div).html(data);
            //finalizar();
        }
  });   
}
