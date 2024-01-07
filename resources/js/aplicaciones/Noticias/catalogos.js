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

function cambiarColorcatalogo(page){

   //console.log(page);
  pagina = page;
  //alert(pagina[0]);
  //console.log(pagina[0]);
  $("#lugarN").removeClass("sel2");
  $("#tipoN").removeClass("sel2");
  $("#soporteN").removeClass("sel2");
  $("#tipoMn").removeClass("sel2");
  $("#genero").removeClass("sel2");
  $("#medioN").removeClass("sel2");
  $("#etapaN").removeClass("sel2");
  $("#califN").removeClass("sel2");
  if(pagina === 1){
      $("#lugarN").addClass("sel2");
    }
    if(pagina === 2){
      $("#tipoN").addClass("sel2");
    }
    if(pagina === 3){
    //console.log('entra general'); 
      $("#soporteN").addClass("sel2");
    }
    if(pagina === 4){
      //console.log('entra historica'); 
      $("#tipoMn").addClass("sel2");
    }
    if(pagina === 5){
      //console.log('entra historica'); 
      $("#genero").addClass("sel2");
    }
    if(pagina === 6){
      //console.log('entra historica'); 
      $("#medioN").addClass("sel2");
    }
    if(pagina === 7){
      //console.log('entra historica'); 
      $("#etapaN").addClass("sel2");
    }
    if(pagina === 8){
      //console.log('entra historica'); 
      $("#califN").addClass("sel2");
    }
  
}